#!/usr/bin/env bash

cd /var/www/html

composer install

php artisan key:generate

php artisan migrate
