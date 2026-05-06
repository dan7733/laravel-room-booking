# Sử dụng PHP 8.3 FPM chuẩn theo đúng composer.json
FROM php:8.3-fpm

# Cài đặt các thư viện hệ thống cơ bản
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# CÀI ĐẶT NODE.JS (Bắt buộc để chạy lệnh npm install và Vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Xóa cache để làm nhẹ image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài đặt các extension PHP bắt buộc cho Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài đặt Composer phiên bản mới nhất
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc mặc định
WORKDIR /var/www

# Phân quyền cho www-data
RUN chown -R www-data:www-data /var/www