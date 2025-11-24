# --- Build Vite Assets ---
FROM node:18 AS vite-build
WORKDIR /app

# Copy only package files first (faster cache)
COPY package*.json ./
RUN npm install

# Copy the rest of the project files needed for Vite
COPY resources ./resources
COPY vite.config.js ./

# Run Vite production build
RUN npm run build

# --- Main PHP Apache Image ---
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy Laravel project
COPY . /var/www/html

WORKDIR /var/www/html

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

RUN composer install --no-dev --optimize-autoloader

# Copy Vite build output into public/build
COPY --from=vite-build /app/public/build /var/www/html/public/build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose default port for Railway
EXPOSE 8080

# Fix Railway PORT auto-binding
CMD sh -c 'echo "Listen ${PORT:-8080}" > /etc/apache2/ports.conf && apache2-foreground'
