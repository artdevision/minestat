#!/usr/bin/env bash

sudo rm /usr/local/bin/docker-compose
curl -L https://github.com/docker/compose/releases/download/1.23.2/docker-compose-`uname -s`-`uname -m` > docker-compose
chmod +x docker-compose
sudo mv docker-compose /usr/local/bin

cp ./.env.example ./.env

cd docker

cp ./.env.example ./.env

docker-compose up -d && docker-compose run php_srv /var/www/html/init.sh
