#!/usr/bin/env bash

sudo docker run --rm \
    -v `pwd`:/var/www \
    dvapelnik/docker-lap:debian.wheezy.php54 \
    /bin/bash -c 'cd /var/www;  php composer.phar run tests'