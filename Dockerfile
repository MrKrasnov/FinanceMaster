FROM php:8.1.0

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "/"]