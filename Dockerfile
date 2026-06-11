FROM php:8.3-apache-bookworm

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
    gnupg \
    ca-certificates \
    netcat-openbsd

# Install Node.js 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        bcmath \
        gd \
        zip \
        intl

# Completely remove conflicting MPM modules and ensure only prefork is available
RUN a2dismod -f mpm_event mpm_worker 2>/dev/null || true && \
    a2enmod mpm_prefork rewrite && \
    rm -f /etc/apache2/mods-available/mpm_event.load /etc/apache2/mods-available/mpm_worker.load

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy source code
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Install Node dependencies
RUN npm install

# Build Vite assets
RUN npm run build

# Laravel permissions
RUN chown -R www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Set Apache document root to public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/sites-available/default-ssl.conf 2>/dev/null || true

EXPOSE 8080

# Start Apache with clean environment
CMD ["/bin/bash", "-c", "export APACHE_RUN_USER=www-data && export APACHE_RUN_GROUP=www-data && export APACHE_PID_FILE=/var/run/apache2/apache2.pid && sed -i 's/Listen 80/Listen ${PORT:-8080}/' /etc/apache2/ports.conf && apache2-foreground"]