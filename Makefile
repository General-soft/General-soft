setup:
	bash ./composer.sh install
	docker-compose up -d --build
	sleep 5
	docker-compose exec php-fpm php artisan key:gen
	docker-compose exec -it php-fpm php artisan migrate:fresh
	docker-compose exec php-fpm php artisan passport:keys
	docker-compose exec php-fpm php artisan passport:client --personal
	make ide


down:
	docker-compose down

up:
	docker-compose up -d

restart:
	docker-compose down
	sleep 1
	docker-compose up -d

migrate:
	docker-compose exec -it php-fpm php artisan migrate

ide:
	docker-compose exec php-fpm php artisan ide-helper:generate
	docker-compose exec php-fpm php artisan ide-helper:meta
	docker-compose exec php-fpm php artisan ide-helper:models -N

pint:
	docker-compose exec php-fpm vendor/bin/pint
