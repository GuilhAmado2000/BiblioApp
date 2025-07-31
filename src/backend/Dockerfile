# Use the official PHP image as the base image
FROM php:8.2

# Set the working directory inside the container
WORKDIR /app

# Install PHP extensions and dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    libsodium-dev \
    libldap2-dev \
    netcat-openbsd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip sodium mysqli pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/  \
    && docker-php-ext-install ldap

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the code of the application code to the container
COPY . .

# Install project dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Run all Laravel setup commands during build
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan key:generate && \
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider" && \
    php artisan jwt:secret

# Copy entrypoint script
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose port 8000 for the Laravel application
EXPOSE 8082

ENTRYPOINT ["/entrypoint.sh"]
