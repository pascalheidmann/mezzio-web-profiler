FROM php:8.2-fpm
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
RUN apt-get update -y && \
    apt-get install -y zip && \
    docker-php-ext-install pdo pdo_mysql
WORKDIR /app
