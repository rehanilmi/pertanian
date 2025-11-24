# --- Build Vite Assets ---
FROM node:18 AS vite-build
WORKDIR /app

# Copy package files
COPY package*.json ./
RUN npm install

# Copy resources and vite config
COPY resources ./resources
COPY vite.config.js ./

# Build assets
RUN npm run build

# --- PHP + Apache Server ---
FROM php:8.2-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache Rewrite
RUN a2enmod rewrite

# Fix DocumentRoot to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -i "s|/var/www/html|/var/www/html/public|g" /etc/apache2/sites-available/000-default.conf
RUN sed -i "s|/var/www/html|/var/www/html/public|g" /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY . .

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

RUN composer install --no-dev --optimize-autoloader \
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan config:cache

RUN php artisan vendor:publish
RUN php artisan migrate:fresh


# Copy compiled Vite build from build stage
COPY --from=vite-build /app/public/build ./public/build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080

# Start Apache with Railway PORT
CMD sh -c ' \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    echo "Listen ${PORT:-8080}" > /etc/apache2/ports.conf && \
    sed -i "s|<VirtualHost .*|<VirtualHost *:${PORT:-8080}>|g" /etc/apache2/sites-available/000-default.conf && \
    apache2-foreground \
'
