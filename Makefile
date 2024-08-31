setup:
	docker-compose up -d --build

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
