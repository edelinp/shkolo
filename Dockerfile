FROM php:8.2-fpm-alpine as php

RUN apk add --no-cache unzip libpq-dev gnutls-dev autoconf build-base \
    curl-dev nginx supervisor shadow bash nodejs npm yaml-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install pcov && docker-php-ext-enable pcov
RUN pecl install yaml && docker-php-ext-enable yaml

COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Setup PHP-FPM.
COPY docker/php/php.ini $PHP_INI_DIR/
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php/conf.d/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini

RUN addgroup --system --gid 1000 customgroup
RUN adduser --system --ingroup customgroup --uid 1000 customuser

# Setup nginx.
COPY docker/nginx/nginx.conf docker/nginx/fastcgi_params docker/nginx/fastcgi_fpm docker/nginx/gzip_params /etc/nginx/
RUN mkdir -p /var/lib/nginx/tmp /var/log/nginx
RUN /usr/sbin/nginx -t -c /etc/nginx/nginx.conf

# setup nginx user permissions
RUN chown -R customuser:customgroup /var/lib/nginx /var/log/nginx
RUN chown -R customuser:customgroup /usr/local/etc/php-fpm.d

# Setup supervisor.
COPY docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# Copy application sources into the container.
COPY --chown=customuser:customgroup . .
RUN chown -R customuser:customgroup /app
RUN chmod +w /app/public
RUN chown -R customuser:customgroup /var /run
# Set correct permissions on public files
RUN find /app/public -type f -exec chmod 644 {} \;
RUN find /app/public -type d -exec chmod 755 {} \;

# disable root user
RUN passwd -l root
RUN usermod -s /usr/sbin/nologin root

USER customuser

ENTRYPOINT ["docker/entrypoint.sh"]

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
