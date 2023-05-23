#!/bin/sh

docker build -t my-php-app .

docker run --rm -p 8080:80 my-php-app