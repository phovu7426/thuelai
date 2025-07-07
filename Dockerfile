FROM php:8.2-apache

# Cài extension Laravel cần
RUN apt-get update && apt-get install -y \
    unzip zip git libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
WORKDIR /var/www/html
COPY . .

# Cài Composer
RUN composer install --no-dev --optimize-autoloader

# Laravel config + quyền
RUN php artisan config:clear && php artisan config:cache && \
    chmod -R 777 storage bootstrap/cache

# Cấu hình Apache dùng thư mục public/
RUN a2enmod rewrite
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Mở cổng Apache
EXPOSE 80

# Chạy Apache
CMD ["apache2-foreground"]
