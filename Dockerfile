# ==============================================================================
# STAGE 1: Frontend Asset Compilation (Vite & Tailwind)
# ==============================================================================
FROM node:20-alpine AS frontend
WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm ci || npm install

COPY vite.config.js tailwind.config.js postcss.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

# ==============================================================================
# STAGE 2: Composer Production Dependencies
# ==============================================================================
FROM composer:2 AS composer_base
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs

COPY app ./app
COPY bootstrap ./bootstrap
COPY config ./config
COPY database ./database
COPY routes ./routes
COPY lang ./lang
COPY artisan ./artisan

RUN composer dump-autoload --optimize --no-dev --classmap-authoritative --no-scripts

# ==============================================================================
# STAGE 3: Base PHP 8.2-FPM Runtime with Extensions
# ==============================================================================
FROM php:8.2-fpm-alpine AS base
WORKDIR /var/www/html

# Install required system packages
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    linux-headers \
    $PHPIZE_DEPS

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        bcmath \
        pcntl \
        opcache \
        gd \
        zip \
        intl

# Install Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis \
    && apk del linux-headers $PHPIZE_DEPS \
    && rm -rf /tmp/pear

# ==============================================================================
# STAGE 4: Development Target (for local testing with bind mounts)
# ==============================================================================
FROM base AS development

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

# ==============================================================================
# STAGE 5: Production Target (Default, Self-Contained & Optimized for AWS EC2)
# ==============================================================================
FROM base AS production

COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Copy application source code
COPY . /var/www/html

# Copy pre-installed vendor and pre-built frontend assets from earlier stages
COPY --from=composer_base /app/vendor /var/www/html/vendor
COPY --from=frontend /app/public/build /var/www/html/public/build

# Setup entrypoint and proper directory permissions
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

