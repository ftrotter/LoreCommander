# Plan: Dockerizing the LoreCommander Legacy Application

This document outlines the steps to create a stable, reproducible Docker environment for the LoreCommander application. The goal is to containerize the application, its database, and all dependencies without upgrading the legacy versions of PHP, MariaDB, or Ubuntu, ensuring the application runs as it did on its original server.

## Part 1: Core Infrastructure (`docker-compose.yml`)

We will use `docker-compose` to define and manage the application (`app`) and database (`db`) services. This file should be created in the project root directory.

__`docker-compose.yml`:__

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: LoreCommander/docker/Dockerfile
    container_name: lorecommander_app
    ports:
      - "8080:80"
    volumes:
      - ./LoreCommander:/var/www/html/LoreCommander
      - ./Zermelo:/var/www/html/Zermelo
      - ./DURC:/var/www/html/DURC
      # Mount a volume for the local image cache
      - lorecommander_imgdata:/var/www/html/LoreCommander/public/imgdata
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_PORT=3306
      - DB_DATABASE=${DB_DATABASE}
      - DB_USERNAME=${DB_USERNAME}
      - DB_PASSWORD=${DB_PASSWORD}

  db:
    image: mariadb:10.5
    container_name: lorecommander_db
    restart: unless-stopped
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_USER: ${DB_USERNAME}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    volumes:
      - lorecommander_db_data:/var/lib/mysql

volumes:
  lorecommander_db_data:
  lorecommander_imgdata:
```

## Part 2: Application Environment (`Dockerfile` and Configurations)

These files define the application's container environment. They should be placed inside a new `LoreCommander/docker/` directory.

### `LoreCommander/docker/Dockerfile`

```dockerfile
# Use Ubuntu 20.04 as the base image for PHP 7.4 compatibility
FROM ubuntu:20.04

# Avoid interactive prompts during installation
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    software-properties-common \
    apache2 \
    php7.4 \
    php7.4-mysql \
    php7.4-mbstring \
    php7.4-xml \
    php7.4-curl \
    composer \
    git \
    netcat-openbsd \
    && apt-get clean

# Copy custom PHP configuration
COPY LoreCommander/docker/custom.ini /etc/php/7.4/apache2/conf.d/custom.ini

# Copy custom Apache configuration
COPY LoreCommander/docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set up working directory and permissions
RUN mkdir -p /var/www/html/LoreCommander/public/imgdata
WORKDIR /var/www/html/LoreCommander

# Copy the entrypoint script and make it executable
COPY LoreCommander/docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80 and set the entrypoint
EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
```

### `LoreCommander/docker/custom.ini`

```ini
; Custom PHP settings for LoreCommander
post_max_size = 8000M
upload_max_filesize = 5000M
upload_max_files = 1000
memory_limit = 2G
```

### `LoreCommander/docker/000-default.conf`

```apacheconf
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/LoreCommander/public

    <Directory /var/www/html/LoreCommander/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

## Part 3: Automation (`entrypoint.sh`)

This script automates the entire setup process inside the container. It should be placed at `LoreCommander/docker/entrypoint.sh`.

### `LoreCommander/docker/entrypoint.sh`

```bash
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

# 4. Run the custom composer installation.
echo "Running composer install via lore.php..."
php lore.php --install --dev

# 5. Run the core Laravel and DURC setup commands.
echo "Running initial application setup..."
php artisan key:generate
php artisan vendor:publish --provider='CareSet\DURC\DURCServiceProvider'

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
apache2-foreground
```

## Part 4: Final Setup and Execution

1. __Create a `.env` file__ in the project root by copying `LoreCommander/.env.example`. Fill in the database credentials. These must match the `MYSQL_` variables in the `docker-compose.yml` file.

   ```javascript
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=lorecommander
   DB_USERNAME=loreuser
   DB_PASSWORD=secret
   DB_ROOT_PASSWORD=rootsecret
   ```

2. __Build and Run:__ From the project root directory, run the following command:

   ```bash
   docker-compose up --build
   ```

3. __Access the Application:__ Once the build and setup process is complete, the application will be available at `http://localhost:8080`.
