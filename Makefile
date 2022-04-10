.PHONY: build
build:
	composer install
	vendor/bin/php-scoper add-prefix
