FROM php:8.4-fpm-alpine

WORKDIR /var/www

# Install system dependencies (Alpine Linux)
RUN apk add --no-cache \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    icu-dev \
    postgresql-dev 

# Install PHP extensions required by Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel project files
COPY . .

# Install PHP dependencies via Composer
RUN composer install --no-interaction --prefer-dist

# Set permissions for Laravel storage and bootstrap cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
