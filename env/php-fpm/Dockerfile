FROM laradock/php-fpm:7.0--1.2

MAINTAINER Mahmoud Zalt <mahmoud@zalt.me>

# Install the bcmath extension
RUN docker-php-ext-install bcmath

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

ADD ./laradock.ini /usr/local/etc/php/conf.d
ADD ./laradock.pool.conf /usr/local/etc/php-fpm.d/

RUN rm -r /var/lib/apt/lists/*

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
