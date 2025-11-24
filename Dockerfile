# --- Build Vite Assets ---
FROM node:18 AS vite-build
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources ./resources
COPY vite.config.js ./

RUN npm run build

# --- PHP & Apache ---
FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN a2enmod rewrite

# ---- FIX DOCUMENT ROOT FULLY ----
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot ${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/sites-available/000-default.conf
RUN sed -i "s|/var/www/html|${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY . .

# Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

RUN composer install --no-dev --optimize-autoloader

# Copy Vite build result
COPY --from=vite-build /app/public/build ./public/build

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080

# ---- FIX PORT + VIRTUALHOST (SUPER IMPORTANT) ----
CMD sh -c ' \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    echo "Listen ${PORT:-8080}" > /etc/apache2/ports.conf && \
    sed -i "s|<VirtualHost .*|<VirtualHost *:${PORT:-8080}>|g" /etc/apache2/sites-available/000-default.conf && \
    apache2-foreground \
'
