#!/bin/sh

if [ ! -f ".env" ]; then
  echo "Tạo file .env mặc định"
  cp .env.example .env
fi

# Tạo key nếu chưa có
if ! grep -q "APP_KEY=" .env || [ -z "$(grep APP_KEY= .env | cut -d '=' -f2)" ]; then
  echo "Tạo APP_KEY..."
  php artisan key:generate
fi

# Chuẩn bị Laravel
php artisan config:clear
php artisan config:cache
php artisan migrate --force || true
php artisan storage:link || true

chmod -R 777 storage bootstrap/cache

# Chạy Apache
apache2-foreground
