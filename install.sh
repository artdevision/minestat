#!/usr/bin/env bash

sudo rm /usr/local/bin/docker-compose
curl -L https://github.com/docker/compose/releases/download/1.23.2/docker-compose-`uname -s`-`uname -m` > docker-compose
chmod +x docker-compose
sudo mv docker-compose /usr/local/bin

cp ./.env.example ./.env

cd docker

cp ./.env.example ./.env

sudo mkdir -p data/mongodb/mongodb
sudo mkdir -p data/redis
sudo chmod -R 777 data

docker-compose up -d
docker-compose logs && docker-compose run php_srv /var/www/html/init.sh
