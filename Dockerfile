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

# Copy only composer files first (for better caching)
COPY composer.json composer.lock ./

# Install PHP dependencies via Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Copy Laravel project files (excluding broken symlinks)
COPY --chown=www-data:www-data . .

# Create storage link and set permissions
RUN mkdir -p public && \
    ln -sf ../storage/app/public public/storage 2>/dev/null || true && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/storage/logs && \
    chmod -R 755 /var/www/vendor

# Switch to www-data user for runtime
USER www-data
