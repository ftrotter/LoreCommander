#!/bin/bash
set -e

# 1. Wait for the database to be ready.
echo "Waiting for database connection..."
while ! nc -z db 3306; do
  sleep 1
done
echo "Database is ready."

# 2. Navigate to the application directory.
cd /var/www/html/LoreCommander

# 3. Create the .env file from the example if it doesn't exist.
if [ ! -f ".env" ]; then
    echo "Creating .env file from example..."
    cp .env.example .env
fi

# 4. Run composer install.
echo "Running composer install..."
if [ -f ".env" ]; then
    export $(grep -v '^#' .env | xargs)
fi
composer config -g github-oauth.github.com ${GITHUB_TOKEN}
COMPOSER=composer-dev.json composer install --no-interaction --ignore-platform-reqs

# 5. Run the core Laravel and DURC setup commands.
echo "Running initial application setup..."
php artisan key:generate
php artisan vendor:publish --provider='ftrotter\DURC\DURCServiceProvider'
php artisan migrate:fresh --seed

# 6. Run the Zermelo installation non-interactively.
echo "Installing Zermelo (non-interactive)..."
php artisan zermelo:install --force

# 7. Set final permissions for storage and the image cache.
echo "Setting final permissions..."
chown -R www-data:www-data /var/www/html/LoreCommander/storage
chown -R www-data:www-data /var/www/html/LoreCommander/public/imgdata

# 8. Start the Apache server.
echo "Setup complete. Starting Apache server..."
echo "The application is now running. You can run 'docker-compose exec app php artisan scry:sync' to populate the database."
exec apache2ctl -D FOREGROUND
