#!/bin/sh

# Nettoyage du cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Execution des migrations et seeders
php artisan migrate:refresh --seed --force

# Démarrage du serveur Laravel
php artisan serve --host=0.0.0.0 --port=8000