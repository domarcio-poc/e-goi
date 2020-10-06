.PHONY: all

SHELL = /bin/bash

build:
	podman build --no-cache -t e-goi-api -f ${PWD}/container/php/Dockerfile ${PWD}/app/api
	podman build --no-cache -t e-goi-website -f ${PWD}/container/node/Dockerfile ${PWD}/app/website/categories

up:
	podman run -d --rm --name e-goi-api \
		-p 8080:80 \
		-v ${PWD}/app/api:/app \
		-v ${PWD}/container/php/php-ini-overrides.ini:/etc/php/7.4/fpm/conf.d/99-overrides.ini \
		-e PHP_INI_SCAN_DIR=/usr/local/etc/php/conf.d/:/etc/php/7.4/fpm/conf.d/ \
		e-goi-api

	podman run -d --rm --name e-goi-website -p 4200:80/tcp e-goi-website
	echo "[]" > ./app/api/data/storage/categories.json

stop:
	podman stop e-goi-api
	podman stop e-goi-website

remove:
	podman rmi e-goi-api
	podman rmi e-goi-website
	echo "[]" > ./app/api/data/storage/categories.json
