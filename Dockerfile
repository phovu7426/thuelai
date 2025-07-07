# Base PHP + Apache image
FROM php:8.2-apache

# Cài các extension Laravel cần
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Bật rewrite module cho Apache (Laravel cần)
RUN a2enmod rewrite

# Set Apache DocumentRoot thành public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Thay đổi cấu hình Apache để phục vụ từ public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy toàn bộ project vào container
COPY . /var/www/html

# Composer (copy từ image chính thức)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Làm việc trong thư mục Laravel
WORKDIR /var/www/html

# Cài dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Generate APP_KEY nếu có .env
RUN if [ -f .env ]; then php artisan key:generate --force; fi

# Cấp quyền ghi cho Laravel
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# (Tùy chọn) In log ra nếu có lỗi sau deploy
RUN if [ -f storage/logs/laravel.log ]; then cat storage/logs/laravel.log; fi

# Mở cổng 80
EXPOSE 80

# Chạy Apache
CMD ["apache2-foreground"]
