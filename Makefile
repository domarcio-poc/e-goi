.PHONY: all

SHELL = /bin/bash

build:
	docker build --network=host --no-cache -t e-goi-api -f ./container/php/Dockerfile ./app/api
	docker build --network=host --no-cache -t e-goi-website -f ./container/node/Dockerfile ./app/website/categories

up:
	docker run -d --rm --name e-goi-api \
		-p 8080:80 \
		-v ${PWD}/container/php/php-ini-overrides.ini:/etc/php/7.4/fpm/conf.d/99-overrides.ini \
		-e PHP_INI_SCAN_DIR=/usr/local/etc/php/conf.d/:/etc/php/7.4/fpm/conf.d/ \
		e-goi-api

	docker run -d --rm --name e-goi-website \
		-p 4242:80 \
		-v ${PWD}/container/node/nginx.conf:/etc/nginx/conf.d/default.conf \
		e-goi-website

stop:
	docker stop e-goi-api
	docker stop e-goi-website

remove:
	docker rmi e-goi-api
	docker rmi e-goi-website
