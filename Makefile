
run:
	@php artisan serve

docker-up:
	@docker-compose up -d

docker-down:
	@docker-compose down -d

db-connect:
	@docker exec -it person-storage psql -U root -d laravel

migrate-up:
	@php artisan migrate

migrate-fresh:
	@php artisan migrate:fresh