FROM php:8.2-cli
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

WORKDIR /app

RUN apt-get update && \
    apt-get install -y apt-transport-https lsb-release ca-certificates curl git unzip yamllint

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN echo "xdebug.client_host=host.docker.internal" >> "$PHP_INI_DIR/conf.d/xdebug.ini" \
        && echo "xdebug.mode=develop,debug" >> "$PHP_INI_DIR/conf.d/xdebug.ini" \
        && echo "xdebug.client_port=9003" >> "$PHP_INI_DIR/conf.d/xdebug.ini" \
        && echo "error_reporting=E_ALL" >> "$PHP_INI_DIR/conf.d/xdebug.ini"

EXPOSE 80

CMD cd /app && composer i && php -S 0.0.0.0:80 -t public/