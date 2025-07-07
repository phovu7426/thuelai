FROM php:8.2-cli

# Cài tiện ích
RUN apt-get update && apt-get install -y \
    unzip zip git libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ project
COPY . .

# Cài Laravel
RUN composer install --no-dev --optimize-autoloader

# Laravel cache
RUN php artisan config:clear && php artisan config:cache

# Mở cổng port
EXPOSE 8000

# Chạy Laravel
CMD sh -c "php artisan serve --host=0.0.0.0 --port=\${PORT:-8000}"

