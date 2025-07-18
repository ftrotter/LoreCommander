# Use Ubuntu 22.04 as the base image for PHP 8.1 compatibility
FROM ubuntu:22.04

# Avoid interactive prompts during installation
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    software-properties-common \
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
    && apt-get clean

# Copy custom PHP configuration
COPY docker/custom.ini /etc/php/8.1/apache2/conf.d/custom.ini

# Copy custom Apache configuration
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set up working directory and permissions
RUN mkdir -p /var/www/html/LoreCommander/public/imgdata
WORKDIR /var/www/html/LoreCommander

# Copy the entrypoint script and make it executable
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80 and set the entrypoint
EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
