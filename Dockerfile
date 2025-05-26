FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita mod_rewrite si lo necesitas
RUN a2enmod rewrite

# Creamos la carpeta dentro del contenedor donde irá tu app
RUN mkdir -p /var/www/html/car-rent-services

# Copiamos el contenido actual (la carpeta completa) a la ruta deseada
COPY . /var/www/html/car-rent-services

# Establecemos index.php como entrada principal
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-enabled/directoryindex.conf
