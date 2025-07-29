#!/bin/bash

# Exit on any error
set -e

# Create storage link if it doesn't exist
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

# Check if database needs to be set up
if ! php artisan migrate:status > /dev/null 2>&1; then
    echo "Setting up database for the first time..."
    php artisan migrate --force
    php artisan db:seed --force
else
    echo "Database already exists, running pending migrations only..."
    php artisan migrate --force
fi

# Start Laravel dev server
exec php artisan serve --host=0.0.0.0 --port=8081
