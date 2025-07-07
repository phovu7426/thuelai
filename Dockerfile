# Dùng PHP + Apache image chính thức
FROM php:8.2-apache

# Cài các extension cần thiết
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libonig-dev curl libxml2-dev && \
    docker-php-ext-install pdo pdo_mysql zip

# Kích hoạt mod_rewrite cho Laravel
RUN a2enmod rewrite

# Đặt document root là thư mục public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Sửa lại cấu hình Apache để trỏ đúng public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy toàn bộ source code vào container
COPY . /var/www/html

# Cấp quyền (nếu cần)
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html/storage

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài Laravel dependencies
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Tạo APP_KEY nếu có .env (bỏ qua nếu chưa có)
RUN if [ -f .env ]; then php artisan key:generate; fi

# Expose cổng 80 cho Render
EXPOSE 80

# Chạy Apache ở foreground
CMD ["apache2-foreground"]
