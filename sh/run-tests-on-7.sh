#!/usr/bin/env bash

sudo docker run --rm \
    -v `pwd`:/var/www \
    -e COMPOSER_HOME="/tmp" \
    dvapelnik/docker-lap:ubuntu.trusty.php7 \
    /bin/bash -c 'cd /var/www;  php composer.phar run tests'