FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Cambiar DocumentRoot a /car-rent-services
RUN sed -i 's|/var/www/html|/car-rent-services|g' /etc/apache2/sites-available/000-default.conf
