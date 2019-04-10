#!/usr/bin/env bash

cp ./.env.example ./.env

cd docker

cp ./.env.example ./.env

docker-compose up -d

docker-compose run php_srv /var/app/minestat/init.sh
