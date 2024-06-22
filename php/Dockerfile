FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    libicu-dev \
    libxml2-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

RUN chown -R www-data:www-data /var/www/symfony

# Expose the port nginx is reachable on
EXPOSE 9000

# Uruchomienie PHP-FPM
CMD ["php-fpm"]

RUN composer install

#RUN composer require symfony/orm-pack
#
#RUN composer require --dev symfony/maker-bundle
#
#RUN composer require doctrine/annotations
#
#RUN composer require symfony/validator
