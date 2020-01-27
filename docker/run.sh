#!/bin/bash

composer install
composer dumpautoload
#bash docker/wait_db.sh
php artisan migrate
php artisan db:seed
php-fpm  &  php artisan queue:work --queue=high,default --tries=3
