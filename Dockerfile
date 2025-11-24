FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable mod_rewrite
RUN a2enmod rewrite

# Set document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy project
COPY . /var/www/html

WORKDIR /var/www/html

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

RUN composer install --no-dev --optimize-autoloader
# Copy semua file project
COPY . .

# ============================
# 3. Install NPM & Build Vite
# ============================
RUN apt-get install -y nodejs npm

# Install dependensi front-end & build
RUN npm install
RUN npm run build


# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose default
EXPOSE 8080

# FIX PORT RAILWAY AUTO
CMD sh -c 'echo "Listen ${PORT:-8080}" > /etc/apache2/ports.conf && apache2-foreground'
