# ---- Stage 1: Build Node/Vite assets ----
FROM node:20 AS node-builder

WORKDIR /var/www/html

# Kopieer package.json en package-lock.json
COPY package*.json ./

# Installeer Node dependencies
RUN npm install

# Kopieer de rest van de frontend
COPY . .

# Bouw de productie assets (optioneel: voor dev kun je 'npm run dev')
RUN npm run build

# ---- Stage 2: PHP/Laravel ----
FROM php:8.3-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    curl \
    zip \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Kopieer Laravel project
COPY . .

# Installeer PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Kopieer Vite build assets van Node stage
COPY --from=node-builder /var/www/html/public/build /var/www/html/public/build

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
