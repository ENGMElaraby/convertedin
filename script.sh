#!/bin/sh

docker-compose up -d --build --force-recreate
docker-compose run --rm composer install
docker-compose run --rm artisan config:clear
docker-compose run --rm artisan config:cache
docker-compose run --rm artisan optimize:clear
docker-compose run --rm artisan migrate
docker-compose run --rm artisan db:seed
open http://localhost:8800