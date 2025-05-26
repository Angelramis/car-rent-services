# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias (puedes agregar más si las usas)
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Habilita mod_rewrite si usas URLs limpias
RUN a2enmod rewrite

# Establece la carpeta raíz del proyecto
WORKDIR /var/www/html/car-rent-services

# Copia todo el código del repo al contenedor
COPY . /var/www/html

# Expone el puerto por defecto de Apache
EXPOSE 80
