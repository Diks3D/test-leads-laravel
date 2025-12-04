# define node image
FROM node:22.18.0-alpine3.22 AS node

# Use an official PHP runtime as a parent image
FROM php:8.4-fpm-alpine3.22

#args
ARG WWW_USER_ID=33
ARG WWW_GROUP_ID=33

# Set working directory
WORKDIR /var/www/html

# Install system dependencies for PHP and Node.js
RUN apk --update add --no-cache $PHPIZE_DEPS \
    mariadb-client \
    supervisor \
    su-exec \
    git

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli pcntl

# Install and enable PHP extension
RUN pecl install redis && docker-php-ext-enable redis

# Enable PHP extension
RUN docker-php-ext-enable opcache

# Install Node.js
COPY --from=node /usr/lib /usr/lib
COPY --from=node /usr/local/lib /usr/local/lib
COPY --from=node /usr/local/include /usr/local/include
COPY --from=node /usr/local/bin /usr/local/bin

# Get composer from the web
RUN curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Add custom php.ini settings
COPY php.ini "$PHP_INI_DIR/conf.d/app.ini"

# Add user for Ubuntu www-data
RUN addgroup -S -g $WWW_GROUP_ID php-app
RUN adduser -S -D -H -u $WWW_USER_ID -s /sbin/nologin -h /home/www-data -G php-app php-app
RUN adduser php-app www-data
RUN chmod 0775 /home/www-data

# Add scheduler setting
COPY scheduler /etc/cron.d/scheduler 
RUN crontab -u php-app /etc/cron.d/scheduler

# Add supervisor custom cinfig
COPY supervisord.conf /etc/supervisord.conf

# Add working directory as safe for git
RUN git config --global --add safe.directory /var/www/html

# Expose port 9000 to the outside world
EXPOSE 9000

USER php-app
