FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json ./
COPY composer.lock* ./

RUN composer install \
    --prefer-dist \
    --no-interaction

RUN composer install \
    --prefer-dist \
    --no-interaction

COPY . .

EXPOSE 8000

CMD ["php-fpm"]