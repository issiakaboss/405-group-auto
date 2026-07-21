FROM php:8.3-fpm

# Installation des dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring gd

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Permissions pour Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000

# 1. Installation de Node.js et NPM dans l'image
RUN apt-get update && apt-get install -y nodejs npm

# 2. Copie du projet et installation des dépendances PHP et JS
COPY . /var/www
WORKDIR /var/www

RUN composer install --no-dev --optimize-autoloader
RUN npm install

# 3. Compilation des assets Vite
RUN npm run build

COPY entrypoint.sh /var/www/entrypoint.sh

# 2. Rendre le script exécutable
RUN chmod +x /var/www/entrypoint.sh

# 3. Définir le point d'entrée
CMD ["/var/www/entrypoint.sh"]