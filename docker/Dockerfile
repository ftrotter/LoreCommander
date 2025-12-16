# Use Ubuntu 22.04 as the base image for PHP 8.1 compatibility
FROM ubuntu:22.04

# Avoid interactive prompts during installation
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    software-properties-common \
    ca-certificates \
    apache2 \
    php8.1 \
    php8.1-mysql \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-curl \
    php8.1-gd \
    php8.1-zip \
    composer \
    git \
    netcat-openbsd \
    mysql-client \
    sudo \
    phpmyadmin \
    openssl \
    && update-ca-certificates \
    && apt-get clean

# Generate self-signed SSL certificate for HTTPS
RUN mkdir -p /etc/apache2/ssl && \
    openssl req -x509 -nodes -days 3650 -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/apache-selfsigned.key \
    -out /etc/apache2/ssl/apache-selfsigned.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/CN=localhost"

# Copy custom PHP configuration
COPY docker/custom.ini /etc/php/8.1/apache2/conf.d/custom.ini

# Copy custom Apache configuration
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY docker/phpmyadmin.conf /etc/apache2/conf-available/phpmyadmin.conf
COPY docker/config.inc.php /etc/phpmyadmin/config.inc.php

# Enable Apache modules and sites for SSL
RUN a2enmod rewrite ssl headers
RUN a2enconf phpmyadmin
RUN a2ensite default-ssl

# Set up working directory and permissions
RUN mkdir -p /var/www/html/LoreCommander/public/imgdata
WORKDIR /var/www/html/LoreCommander

# Copy the entrypoint script and database setup script, make them executable
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/setup_databases.sh /usr/local/bin/setup_databases.sh
RUN chmod +x /usr/local/bin/entrypoint.sh /usr/local/bin/setup_databases.sh

# Expose ports 80 (HTTP) and 443 (HTTPS) and set the entrypoint
EXPOSE 80 443
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
