#!/bin/bash
# Don't use set -e since we want to continue even if some commands fail

# 1. Wait for the database to be ready.
echo "Waiting for database connection..."
while ! nc -z db 3306; do
  sleep 1
done
echo "Database is ready."

# 1b. Load databases from setup_db if they are missing or empty.
echo "Checking setup databases..."
if [ -f "/usr/local/bin/setup_databases.sh" ]; then
    /usr/local/bin/setup_databases.sh
elif [ -f "/var/www/html/LoreCommander/docker/setup_databases.sh" ]; then
    # Fallback to mounted volume location during development
    chmod +x /var/www/html/LoreCommander/docker/setup_databases.sh
    /var/www/html/LoreCommander/docker/setup_databases.sh
else
    echo "Warning: setup_databases.sh not found, skipping database initialization."
fi

# 2. Navigate to the application directory.
cd /var/www/html/LoreCommander

# 3. Create the .env file from the Docker example if it doesn't exist.
if [ ! -f ".env" ]; then
    if [ -f ".env.docker.example" ]; then
        echo "Creating .env file from .env.docker.example..."
        cp .env.docker.example .env
    elif [ -f ".env.example" ]; then
        echo "Warning: .env.docker.example not found, using .env.example..."
        cp .env.example .env
    else
        echo "Error: No .env.example file found!"
    fi
fi

# 4. Run composer install.
echo "Running composer install..."
if [ -f ".env" ]; then
    export $(grep -v '^#' .env | grep '=' | xargs)
fi

# Set GitHub token only if it's a valid token (not a placeholder)
if [ -n "${GITHUB_TOKEN}" ] && [ "${GITHUB_TOKEN}" != "NEED_THIS_FOR_COMPOSER" ] && [ "${GITHUB_TOKEN}" != "your_github_personal_access_token_here" ]; then
    echo "Configuring GitHub OAuth token..."
    composer config -g github-oauth.github.com ${GITHUB_TOKEN}
else
    echo "Warning: No valid GITHUB_TOKEN provided. Using local path repositories instead."
fi

# Remove the lock file to ensure fresh compatible packages are installed
if [ -f "composer-dev.lock" ]; then
    echo "Removing existing composer-dev.lock for fresh install..."
    rm composer-dev.lock
fi

# Disable TLS for Composer (required for environments with SSL inspection/firewall issues)
# Both the config and environment variable are needed for curl error 60 issues
echo "Configuring Composer to disable TLS..."
composer config --global disable-tls true
composer config --global secure-http false
export COMPOSER_DISABLE_TLS=1

echo "Running composer update with local package symlinks..."
COMPOSER=composer-dev.json composer update --no-interaction --prefer-stable --no-cache

# 5. Run the core Laravel setup commands.
echo "Running initial application setup..."
php artisan key:generate --force
php artisan vendor:publish --provider='CareSet\DURC\DURCServiceProvider' --force

# 6. Run database-dependent commands (these may fail if database isn't configured)
echo "Running database migrations..."
if php artisan migrate:fresh --seed 2>&1; then
    echo "Database migrations completed successfully."
else
    echo "Warning: Database migrations failed. You may need to run 'docker-compose exec app php artisan migrate:fresh --seed' manually."
fi

# 7. Run the Zermelo installation non-interactively.
echo "Installing Zermelo..."
if php artisan zermelo:install --force 2>&1; then
    echo "Zermelo installation completed successfully."
else
    echo "Warning: Zermelo installation failed. You may need to run 'docker-compose exec app php artisan zermelo:install --force' manually."
fi

# 8. Set final permissions for storage and the image cache.
echo "Setting final permissions..."
chown -R www-data:www-data /var/www/html/LoreCommander/storage
chown -R www-data:www-data /var/www/html/LoreCommander/public/imgdata

# 9. Start the Apache server.
echo "=============================================="
echo "Setup complete. Starting Apache server..."
echo "The application is now running at:"
echo "  HTTP:  http://localhost:8080"
echo "  HTTPS: https://localhost:8443"
echo ""
echo "phpMyAdmin is available at:"
echo "  HTTP:  http://localhost:8080/pma4414"
echo "  HTTPS: https://localhost:8443/pma4414 (recommended)"
echo ""
echo "Note: The HTTPS certificate is self-signed. Your browser will"
echo "show a security warning - this is expected for development."
echo "=============================================="
exec apache2ctl -D FOREGROUND
