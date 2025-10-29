# ---- Stage 1: Node / Vite build ----
FROM node:20 AS node-builder

WORKDIR /var/www/html

# Alleen package files kopiëren voor caching
COPY package*.json ./

# Installeer dependencies (incl. devDependencies voor Vite build)
RUN npm ci --silent

# Kopieer de rest van de frontend / Laravel project
COPY . .

# Bouw Vite assets voor productie
RUN npm run build

# ---- Stage 2: PHP / Laravel + Nginx ----
FROM php:8.3-fpm

WORKDIR /var/www/html

# Installeer systeem dependencies, PHP-extensies en Nginx
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev libpq-dev curl zip nginx gettext-base \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring zip bcmath gd \
    && docker-php-ext-enable pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Kopieer Laravel project
COPY . .

# Composer install productie
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction \
    && composer clear-cache

# Kopieer Vite build assets van node-builder naar public/build
RUN mkdir -p public/build
COPY --from=node-builder /var/www/html/public/build /var/www/html/public/build

# Storage / cache permissies
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Nginx config template met placeholder voor $PORT
RUN echo "server { \
    listen 0.0.0.0:\$PORT; \
    server_name _; \
    root /var/www/html/public; \
    index index.php index.html; \
    location / { try_files \$uri \$uri/ /index.php?\$query_string; } \
    location ~ \\\.php\$ { include fastcgi_params; fastcgi_pass 127.0.0.1:9000; fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name; } \
}" > /etc/nginx/conf.d/default.conf.template

# Expose HTTP
EXPOSE 80

# Start PHP-FPM, Nginx en run artisan commands zodat database correct is gemigreerd
CMD sh -c "\
    echo 'Starting Laravel Production Setup...' && \
    php artisan migrate --force && \
    php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:clear && \
    php artisan route:cache && \
    php artisan view:clear && \
    php artisan view:cache && \
    envsubst '\$PORT' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf && \
    php-fpm -D && nginx -g 'daemon off;' \
"
