FROM php:8.1.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl

# xdebug
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions xdebug
COPY xdebug.ini "${PHP_INI_DIR}/conf.d"

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]