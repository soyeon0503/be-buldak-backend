#!/bin/bash

cd src

cp .env.example .env

cd ../

docker-compose up -d

docker-compose exec buldak-app npm install

docker-compose exec buldak-app composer install

docker-compose exec buldak-app php artisan key:generate

docker-compose exec buldak-app php artisan migrate --seed
