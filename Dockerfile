FROM php:8.2-fpm

# Cài các dependency cần thiết
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    sqlite3 libsqlite3-dev \
    nginx \
    && docker-php-ext-install pdo pdo_sqlite

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ project vào container
COPY . .

# Tạo file SQLite nếu chưa có
RUN mkdir -p database && touch database/database.sqlite

# Cài đặt PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Cấp quyền cho Laravel
RUN chmod -R 775 storage bootstrap/cache database
RUN chown -R www-data:www-data storage bootstrap/cache database

# Cấu hình Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Expose cổng Render yêu cầu
EXPOSE 8080

# Clear cache, chạy migrations, seeder và khởi động Nginx + PHP-FPM
CMD php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear && \
    php artisan migrate --force && php artisan db:seed --force && \
    service nginx start && php-fpm
