FROM php:8.2-cli

# Cài các dependency cần thiết
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ project vào container
COPY . .

# Tạo file SQLite nếu chưa có (đề phòng trường hợp quên push)
RUN mkdir -p database && touch database/database.sqlite

# Cài đặt PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Cấp quyền cho Laravel
RUN chmod -R 777 storage bootstrap/cache database

# Expose cổng Render yêu cầu
EXPOSE 8080

# Chạy Laravel bằng server tích hợp
CMD php artisan serve --host=0.0.0.0 --port=8080
