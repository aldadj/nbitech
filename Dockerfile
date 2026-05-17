# --- Étape 1 : Compilation des assets (Vite) ---
    FROM node:20 AS node-builder
    WORKDIR /app
    COPY package*.json ./
    RUN npm install
    COPY . .
    RUN npm run build
    
    # --- Étape 2 : Serveur PHP / Apache ---
    FROM php:8.3-apache
    
    # 1. Installation des dépendances système (PostgreSQL, Zip, Intl, Bcmath)
    RUN apt-get update && apt-get install -y \
        libpq-dev libzip-dev libicu-dev zip unzip git \
        && docker-php-ext-configure intl \
        && docker-php-ext-install pdo pdo_pgsql zip intl bcmath \
        && apt-get clean && rm -rf /var/lib/apt/lists/*
    
    # 2. Écriture de la config Apache (Remplacement sécurisé pour Render)
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
    
    # 3. Récupération de Composer
    COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
    
    WORKDIR /var/www/html
    
    # 4. Installation des dépendances PHP (Optimisation du cache Docker)
    COPY composer.json composer.lock* ./
    RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts
    
    # 5. Copie du reste du projet
    COPY . .
    
    # Copie des assets compilés depuis l'étape Node
    COPY --from=node-builder /app/public/build ./public/build
    
    # 6. Création forcée de TOUTE l'arborescence Laravel et permissions
    RUN mkdir -p bootstrap/cache \
                 storage/framework/cache/data \
                 storage/framework/sessions \
                 storage/framework/views \
                 storage/logs \
        && chown -R www-data:www-data storage bootstrap/cache \
        && chmod -R 775 storage bootstrap/cache
    
    # 7. Finalisation de l'autoload
    RUN composer dump-autoload --optimize --no-dev --no-scripts
    
    EXPOSE 80
    
    # Exécution des migrations PostgreSQL + Mise en cache au démarrage
    CMD php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && apache2-foreground