#!/bin/bash
set -e

# 1. Wait for the database to be ready.
echo "Waiting for database connection..."
until mysqladmin ping -h db --silent; do
  echo "MariaDB is unavailable - sleeping"
  sleep 1
done
echo "Database is ready."

# 2. Navigate to the application directory.
cd /var/www/html/LoreCommander

# 3. Create the .env file from the docker-specific environment file.
echo "Creating .env file from .env.docker..."
cp .env.docker .env

# 4. Clear the configuration cache.
php artisan config:clear

# 5. Run composer install.
echo "Running composer install..."
if [ -n "${GITHUB_TOKEN}" ]; then
    composer config -g github-oauth.github.com ${GITHUB_TOKEN}
    COMPOSER=composer-dev.json composer install --no-interaction --ignore-platform-reqs
else
    # Without GitHub token, use standard composer.json with packagist packages
    composer install --no-interaction --ignore-platform-reqs
fi

# 6. Run the core Laravel and DURC setup commands.
echo "Running initial application setup..."
php artisan key:generate
php artisan vendor:publish --provider='ftrotter\DURCC\DURCCServiceProvider'
php artisan migrate:fresh --seed

# 7. Run the Zermelo installation non-interactively.
echo "Installing ZZermelo (non-interactive)..."
php artisan zzermelo:install --force

# 8. Set final permissions for storage and the image cache.
echo "Setting final permissions..."
chown -R www-data:www-data /var/www/html/LoreCommander/storage
chown -R www-data:www-data /var/www/html/LoreCommander/public/imgdata

# 9. Start the Apache server.
echo "Setup complete. Starting Apache server..."
echo "The application is now running. You can run 'docker-compose exec app php artisan scry:sync' to populate the database."
exec apache2ctl -D FOREGROUND
