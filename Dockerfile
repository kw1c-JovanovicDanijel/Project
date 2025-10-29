# ---- Stage 1: Build Node/Vite assets ----
FROM node:20 AS node-builder

WORKDIR /var/www/html

# Kopieer enkel package files voor snelle layer-caching
COPY package*.json ./

ENV NODE_ENV=production
RUN npm ci --silent --no-audit --progress=false

# Kopieer de rest van de frontend
COPY . .
RUN npm run build

# ---- Stage 2: PHP/Laravel ----
FROM php:8.3-fpm

WORKDIR /var/www/html

# Install system dependencies en PHP-extensies (voeg gd toe als je afbeeldingen verwerkt)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    curl \
    zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer vanaf officiele image
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Kopieer de applicatie
COPY . .

# Composer install (productie)
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction \
    && composer clear-cache

# Kopieer Vite build assets van Node stage
COPY --from=node-builder /var/www/html/public/build /var/www/html/public/build

# Zorg voor juiste permissies voor storage en cache
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
