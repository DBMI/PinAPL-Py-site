#!/bin/bash

# Change directory to where the script is stored, not run from
scriptPath=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
cd $scriptPath

git pull
php artisan migrate
php artisan config:cache
composer dumpautoload -o
