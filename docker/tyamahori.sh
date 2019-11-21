#!/bin/sh

case "$1" in
"up")
  docker-compose up -d --build
  docker exec -it tyamahori-php-fpm cp .env.local .env
  docker exec -it tyamahori-php-fpm php artisan key:generate
  docker exec -it tyamahori-php-fpm composer install
  docker exec -it tyamahori-php-fpm chmod -R 777 storage
  docker exec -it tyamahori-node yarn install
  docker exec -it tyamahori-node yarn run build
  docker exec -it tyamahori-php-fpm php artisan migrate:reset
  docker exec -it tyamahori-php-fpm php artisan migrate --seed
  docker exec -it tyamahori-php-fpm ./vendor/bin/phpunit
  docker-compose down
  docker-compose up
  ;;
"test")
  docker-compose up -d --build
  docker exec -it tyamahori-php-fpm cp .env.local .env
  docker exec -it tyamahori-php-fpm php artisan key:generate
  docker exec -it tyamahori-php-fpm composer install
  docker exec -it tyamahori-php-fpm chmod -R 777 storage
  docker exec -it tyamahori-node yarn install
  docker exec -it tyamahori-node yarn run build
  docker exec -it tyamahori-php-fpm php artisan migrate:reset
  docker exec -it tyamahori-php-fpm php artisan migrate --seed
  docker exec -it tyamahori-php-fpm ./vendor/bin/phpunit
  ;;
"watch")
  docker exec -it tyamahori-node yarn install && yarn run watch
  ;;
"down")
  docker-compose down
  ;;
esac