# ============================
# 1. Base image: PHP 8.2 + Apache
# ============================
FROM php:8.2-apache

# Install ekstensi PHP yg dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql zip

# Aktifkan mod_rewrite (Wajib untuk Laravel)
RUN a2enmod rewrite

# ============================
# 2. Set folder project
# ============================
WORKDIR /var/www/html

# Copy composer terlebih dahulu untuk cache layer
COPY composer.json composer.lock ./

# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy semua file project
COPY . .

# ============================
# 3. Install NPM & Build Vite
# ============================
RUN apt-get install -y nodejs npm

# Install dependensi front-end & build
RUN npm install
RUN npm run build

# ============================
# 4. Permission storage & cache
# ============================
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ============================
# 5. Expose port Railway (8080)
# ============================
EXPOSE 8080

# ============================
# 6. Apache sebagai web server
# ============================
CMD ["apache2-foreground"]
