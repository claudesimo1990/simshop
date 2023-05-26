.PHONY: rights
rights:
	sudo chown www-data:www-data -R /srv/colissend/data/www
	sudo chmod 775 -R /srv/colissend/data/www

	sudo chown www-data:www-data -R /var/docker/colissend
	sudo chmod 775 -R /var/docker/colissend

.PHONY: a
a:
	docker exec -it claude_colissend_php-fpm php

.PHONY: tests
tests:
	docker exec -it claude_colissend_php-fpm ./vendor/bin/phpunit

.PHONY: ide
ide:
	docker exec -it claude_colissend_php-fpm php artisan ide-helper:generate
	docker exec -it claude_colissend_php-fpm php artisan ide-helper:models -F ide/ModelHelpers.php -M
	docker exec -it claude_colissend_php-fpm php artisan ide-helper:meta
