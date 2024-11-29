# Imagen base para PHP
FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif bcmath gd

# Obtener Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Crear directorios necesarios
RUN mkdir -p /var/www/storage/framework/cache && \
    mkdir -p /var/www/storage/framework/sessions && \
    mkdir -p /var/www/storage/framework/views && \
    mkdir -p /var/www/storage/logs && \
    mkdir -p /var/www/bootstrap/cache

# Establecer permisos
RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www

# Copiar archivos del proyecto
COPY --chown=www-data:www-data . .

# Instalar dependencias
USER www-data
RUN composer install --no-scripts --no-autoloader && \
    composer dump-autoload --optimize

USER root
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

USER www-data