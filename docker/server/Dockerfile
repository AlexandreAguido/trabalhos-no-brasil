FROM php:7.2-apache

# Set working directory
WORKDIR /var/www/html


# Install extensions
RUN apt update; apt upgrade -y; \
    apt install curl
    
RUN docker-php-ext-install pdo_mysql

#redirect url
RUN a2enmod rewrite

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf
EXPOSE 80
