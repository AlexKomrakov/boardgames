FROM php:7

RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/app

CMD ["vendor/phpunit/phpunit/phpunit"]