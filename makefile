setup:
	@make build
	@make up
	@make composer-update

build:
	docker-compose build --no-cache --force-rm
down:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec chatapp2db bash -c "composer update"
data:
	docker exec chatapp2db bash -c "php artisan migrate"
	docker exec chatapp2db bash -c "php artisan db:seed"
