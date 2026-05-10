FROM php:8.3-apache

# 1. Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Écriture de la config Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

# 3. Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 4. Copie du projet
COPY . .

# 5. Permissions Laravel (On les met AVANT composer pour éviter les soucis de cache)
RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

# 6. Installation des dépendances PHP (Version 8.3 maintenant !)
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader --no-interaction --no-progress

EXPOSE 80
CMD ["apache2-foreground"]