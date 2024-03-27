FROM php:8.2-fpm-alpine3.16
ENV SSL_CERT_DIR=/dev/null
ENV PATH="${PATH}:/usr/local/bin"

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN apk add --no-cache libpng-dev \
    && docker-php-ext-install gd

RUN apk --update add curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apk --no-cache update
USER root
# Tip from https://github.com/chrootLogin/docker-nextcloud/issues/3#issuecomment-271626117
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow \
    && usermod -u 1000 www-data
COPY . /var/www/beeping
WORKDIR /var/www/beeping
RUN chown -R www-data:www-data /var/www/beeping
# Cambiar al usuario www-data
USER www-data

CMD ["php-fpm"]

EXPOSE 9000