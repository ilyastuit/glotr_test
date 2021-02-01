up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down-clear clear docker-pull docker-build docker-up app-init

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

app-init: composer-install wait-db migrations fixtures ready
	docker-compose exec web chmod -R 755 /var/www/html
	sudo chmod -R 777 $PWD

clear:
	docker run --rm -v ${PWD}:/var/www/html --workdir=/var/www/html alpine rm -f .ready

composer-install:
	docker-compose run --rm composer composer install

wait-db:
	until docker-compose exec -T db pg_isready --timeout=0 --dbname=glotr ; do sleep 1 ; done

migrations:
	docker-compose run --rm --workdir=/var/www/html php-cli php yii migrate --interactive=0

fixtures:
	docker-compose run --rm --workdir=/var/www/html php-cli php yii fixture/load "*" --interactive=0

ready:
	docker run --rm -v ${PWD}:/var/www/html --workdir=/var/www/html alpine touch .ready

test:
	docker-compose run --rm php-cli php bin/phpunit

test-coverage:
	docker-compose run --rm php-cli php bin/phpunit --coverage-clover var/clover.xml --coverage-html var/coverage

test-unit:
	docker-compose run --rm php-cli php bin/phpunit --testsuite=unit

test-unit-coverage:
	docker-compose run --rm php-cli php bin/phpunit --testsuite=unit --coverage-clover var/clover.xml --coverage-html var/coverage