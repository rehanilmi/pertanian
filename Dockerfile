# Gunakan image resmi PHP yang sudah lengkap
FROM php:8.2-apache

# Install ekstensi yang dibutuhkan Laravel (pdo_mysql, zip, dll)
RUN docker-php-ext-install pdo pdo_mysql

# Copy semua file Laravel ke dalam container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer (untuk dependency Laravel)
RUN apt-get update && apt-get install -y git unzip libzip-dev \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Expose port 8080 (port yang digunakan Railway)
EXPOSE 8080

# Jalankan Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
