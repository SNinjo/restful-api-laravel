FROM php:8.0-fpm
WORKDIR /var/www
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN docker-php-ext-install pdo pdo_mysql

COPY . .
RUN composer install
RUN chmod -R 777 .
CMD php-fpm