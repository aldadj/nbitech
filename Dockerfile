# --- Étape 1 : Compilation des assets (Vite) ---
FROM node:20 AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM php:8.3-apache

# 1. Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev libicu-dev zip unzip git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql zip intl bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Écriture de la config Apache
RUN a2enmod rewrite

COPY <<EOF /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# 3. Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 4. Installation des dépendances PHP (Optimisation du cache Docker)
COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts

# 5. Copie du reste du projet
COPY . .

# Copie des assets compilés depuis l'étape Node
COPY --from=node-builder /app/public/build ./public/build

# 6. Finalisation de l'autoload et permissions
RUN composer dump-autoload --optimize --no-dev --no-scripts
RUN mkdir -p storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

EXPOSE 80

# On utilise un script ou on s'assure que la DB est prête. 
CMD php artisan config:cache && php artisan route:cache && php artisan view:cache && apache2-foreground