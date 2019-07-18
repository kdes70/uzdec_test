docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

test:
	docker-compose exec php-fpm vendor/bin/phpunit

artisan:
	docker-compose exec php-fpm php artisan

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache