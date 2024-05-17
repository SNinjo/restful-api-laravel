#!/bin/sh
# clears all caches when starting the container to ensure all environment variables are up to date

php artisan down
php artisan cache:clear

php artisan config:clear
php artisan config:cache

php artisan event:clear
php artisan event:cache

php artisan route:clear

php artisan view:clear

php artisan up
php artisan serve --host=0.0.0.0 --port 8000