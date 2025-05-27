# Usa la imagen oficial de PHP 8.2 con Apache
FROM php:8.2-apache
 
# Instala extensiones comunes de PHP (ajusta según tus necesidades)
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
 
# Habilita el módulo de reescritura de Apache (útil para URLs amigables)
RUN a2enmod rewrite
 
# Copia los archivos de tu proyecto al directorio raíz de Apache
COPY . /var/www/html/
 
# Establece los permisos adecuados (opcional pero recomendable)
RUN chown -R www-data:www-data /var/www/html
 
# Exposición del puerto 80
EXPOSE 80