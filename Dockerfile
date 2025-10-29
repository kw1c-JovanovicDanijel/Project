# ---- Stage 1: Node / Vite build ----
FROM node:20 AS node-builder

WORKDIR /var/www/html

# Alleen package files kopiëren voor caching
COPY package*.json ./

# Installeer alle dependencies (incl. devDependencies voor build)
RUN npm ci --silent

# Kopieer frontend / Laravel project
COPY . .

# Bouw Vite assets voor productie
RUN npm run build

# ---- Stage 2: PHP / Laravel ----
FROM php:8.3-fpm

WORKDIR /var/www/html

# Systeem dependencies + PHP extensies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev curl zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Laravel project kopiëren
COPY . .

# Composer install voor productie
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction \
    && composer clear-cache

# Kopieer Vite build assets van node-builder
COPY --from=node-builder /var/www/html/public/build /var/www/html/public/build

# Storage / cache permissies
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
