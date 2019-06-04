#!/usr/bin/env bash
cd /var/www

/usr/local/bin/composer install

php artisan migrate

php-fpm
