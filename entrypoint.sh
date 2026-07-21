#!/bin/sh

# Nettoyage du cache
php artisan config:clear
php artisan cache:clear

# Execution des migrations et seeders
php artisan migrate:fresh --seed --force

# Démarrage du serveur Laravel
php artisan serve --host=0.0.0.0 --port=8000