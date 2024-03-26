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
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install 

# Expose port 8000 for the Laravel application
EXPOSE 8081

# Run the Laravel application
CMD php artisan serve --host=0.0.0.0 --port=8081