# Sử dụng image PHP có Apache
FROM php:8.2-apache

# Cài đặt các extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Bật module rewrite để Laravel hoạt động
RUN a2enmod rewrite

# Trỏ Apache vào thư mục public (Laravel's entrypoint)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Thay đổi cấu hình Apache để trỏ đúng public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy toàn bộ mã nguồn Laravel vào container
COPY . /var/www/html

# Cài Composer (lấy từ image chính thức của Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Làm việc trong thư mục Laravel
WORKDIR /var/www/html

# Cài đặt thư viện PHP bằng Composer
RUN composer install --no-dev --optimize-autoloader

# Generate APP_KEY nếu cần
RUN if [ -f .env ]; then php artisan key:generate --force; fi

# Cấp quyền ghi cho Laravel
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# Mở cổng 80 cho Apache
EXPOSE 80

# Chạy Apache
CMD ["apache2-foreground"]
