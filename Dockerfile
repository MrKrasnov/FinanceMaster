FROM php:8.1.0

RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "/"]