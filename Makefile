#!/bin/bash

UID := $(shell id -u)
DOCKER_BE := docker-symfony-be
DB_CONTAINER := docker-symfony-db
NETWORK_NAME := docker-symfony-network

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | while read -r l; do printf "\033[1;32m$$(echo $$l | cut -f 1 -d':')\033[00m:$$(echo $$l | cut -f 2- -d'#')\n"; done | column -t -c 2 -s ':#'

start: ## Start the containers
	@if [ -z "$$(docker network ls --filter name=^${NETWORK_NAME}$$ --format={{.Name}})" ]; then \
	  docker network create ${NETWORK_NAME}; \
	fi
	@if [ ! -z "$$(docker ps -a -q -f name=${DB_CONTAINER})" ]; then \
	  docker rm -f ${DB_CONTAINER}; \
	fi
	@if [ ! -z "$$(docker ps -a -q -f name=${DOCKER_BE})" ]; then \
	  docker rm -f ${DOCKER_BE}; \
	fi
	U_ID=${UID} docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker-compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) start

build: ## Rebuilds all the containers
	@if [ -z "$$(docker network ls --filter name=^${NETWORK_NAME}$$ --format={{.Name}})" ]; then \
	  docker network create ${NETWORK_NAME}; \
	fi
	U_ID=${UID} docker-compose build

prepare: ## Runs backend commands
	$(MAKE) composer-install

run: ## starts the Symfony development server in detached mode
	@if [ ! -z "$$(docker ps -a -q -f name=${DB_CONTAINER})" ]; then \
	  docker rm -f ${DB_CONTAINER}; \
	fi
	@if [ ! -z "$$(docker ps -a -q -f name=${DOCKER_BE})" ]; then \
	  docker rm -f ${DOCKER_BE}; \
	fi
	U_ID=${UID} docker-compose up -d
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} symfony serve -d

logs: ## Show Symfony logs in real time
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} symfony server:log

# Backend commands
composer-install: ## Installs composer dependencies
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} composer install --no-interaction
# End backend commands

ssh: ## bash into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bash
