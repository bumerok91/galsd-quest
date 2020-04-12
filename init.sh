docker-compose up -d --build \
&& docker-compose exec php php artisan migrate:fresh \
&& docker-compose exec php php artisan db:seed \
&& docker-compose exec php ./vendor/bin/phpunit