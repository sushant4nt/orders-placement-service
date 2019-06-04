FROM php:7.1-fpm

COPY ./php.ini /usr/local/etc/php/

RUN chmod o+r /etc/resolv.conf

RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    git \
    zip \
    unzip

# Install extensions using the helper script provided by the base image
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql

# Install composer	
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN usermod -u 1000 www-data

WORKDIR /var/www

ADD init.sh /sbin/init.sh
RUN chmod +x /sbin/init.sh

CMD ["php-fpm"]

CMD ["/sbin/init.sh"]

EXPOSE 9000
