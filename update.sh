#!/bin/bash
git pull
php artisan migrate
php artisan config:cache
composer dumpautoload -o
