FROM php:7.4-apache
RUN a2enmod rewrite && docker-php-ext-install pdo_mysql
RUN service apache2 restart