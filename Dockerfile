FROM php:8.2-cli

# Cài các extension cần thiết
RUN apt-get update && apt-get install -y \
    unzip zip git libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ mã nguồn
COPY . .

# Cài đặt Composer
RUN composer install --no-dev --optimize-autoloader

# Laravel cache config
RUN php artisan config:clear && php artisan config:cache

# Chmod để Laravel không lỗi quyền
RUN chmod -R 777 storage bootstrap/cache

# Mở port 8000
EXPOSE 8000

# ⚠️ ⚠️ ⚠️ CHẠY PORT CỐ ĐỊNH (KHÔNG DÙNG ${PORT})
CMD php artisan serve --host=0.0.0.0 --port=8000
