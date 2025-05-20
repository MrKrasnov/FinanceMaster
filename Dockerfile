FROM php:8.1.0

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php", "-S", "0.0.0.0:80", "-t", "/"]