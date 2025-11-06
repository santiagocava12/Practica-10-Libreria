# Usar la imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar el driver de PostgreSQL (pdo_pgsql)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql