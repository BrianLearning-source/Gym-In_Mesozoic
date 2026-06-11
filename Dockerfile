FROM php:8.3-cli-bookworm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    nginx \
    && apt-get clean

# Install Node.js 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo pdo_mysql mbstring exif bcmath gd zip intl opcache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy source code
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

# Configure Nginx
RUN mkdir -p /var/log/nginx && \
    echo 'server { \
    listen 8080; \
    server_name _; \
    root /app/public; \
    index index.php; \
    location / { \
        try_files $uri $uri/ /index.php?$query_string; \
    } \
    location ~ \.php$ { \
        include fastcgi_params; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock; \
    } \
}' > /etc/nginx/sites-enabled/default

# Setup PHP-FPM
RUN apt-get install -y php8.3-fpm && \
    sed -i 's/listen = \/run\/php\/php8.3-fpm.sock/listen = \/var\/run\/php\/php8.3-fpm.sock/' /etc/php/8.3/fpm/pool.d/www.conf && \
    mkdir -p /var/run/php

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache && \
    chmod -R 775 /app/storage /app/bootstrap/cache

# Start script
RUN echo '#!/bin/bash\n\
php-fpm8.3 -D\n\
nginx -g "daemon off;"' > /start.sh && chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]