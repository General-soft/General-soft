.PHONY: setup
setup:
	bash ./composer.sh install
	docker-compose up -d --build
	sleep 5
	docker-compose exec php-fpm php artisan key:gen
	docker-compose exec -it php-fpm php artisan migrate:fresh
	docker-compose exec php-fpm php artisan passport:keys --force
	docker-compose exec php-fpm php artisan passport:client --personal --name="Laravel Personal Access Client"
	docker-compose exec php-fpm php artisan db:seed
	make ide

.PHONY: down
down:
	docker-compose down

.PHONY: up
up:
	docker-compose up -d

.PHONY: restart
restart:
	docker-compose down
	sleep 1
	docker-compose up -d

.PHONY: migrate
migrate:
	docker-compose exec -it php-fpm php artisan migrate

.PHONY: ide
ide:
	docker-compose exec php-fpm php artisan ide-helper:generate
	docker-compose exec php-fpm php artisan ide-helper:meta
	docker-compose exec php-fpm php artisan ide-helper:models -N

.PHONY: pint
pint:
	docker-compose exec php-fpm vendor/bin/pint

.PHONY: test
test:
	docker-compose exec php-fpm php artisan test

.PHONY: coverage
coverage:
	docker-compose exec php-fpm php artisan test --coverage

.PHONY: coverage-report
coverage-report:
	rm -rf ./coverage
	docker-compose exec php-fpm php vendor/bin/phpunit --coverage-html /application/coverage

.PHONY: coverage
api-docs:
	docker-compose exec php-fpm php artisan l5-swagger:generate
