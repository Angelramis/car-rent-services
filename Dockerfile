# Usa la imagen oficial de PHP 8.2 con Apache
FROM php:8.2-apache

# Instala dependencias necesarias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    gnupg \
    ca-certificates \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Instala extensiones comunes de PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql zip && docker-php-ext-enable pdo_mysql

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Instala Node.js v22.15.0
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

# Copia los archivos del proyecto
COPY . /var/www/html/

# Establece los permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Ejecuta composer install, npm install y npm run build
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expone el puerto 80
EXPOSE 80
