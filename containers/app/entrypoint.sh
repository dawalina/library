#!/bin/bash

if [ ! -d vendor ]
then
    echo "There is no vendor directory"
    composer install --prefer-dist --no-interaction
    composer dump-autoload
    php artisan key:generate
    php artisan migrate --seed
else
    echo "Vendor directory exists"
    composer update --prefer-dist --no-interaction
fi

php artisan optimize

chown -R www-data:www-data /var/www

php-fpm -F
