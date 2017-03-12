#!/bin/bash
git pull
composer dumpautoload -o
php artisan config:cache
