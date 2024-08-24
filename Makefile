# Define variables
DOCKER_COMPOSE = docker-compose
PHP = $(DOCKER_COMPOSE) exec app php
ARTISAN = $(PHP) artisan
COMPOSER = $(DOCKER_COMPOSE) exec app composer

# Default target
all: help

# Help message
help:
	@echo "Laravel Makefile"
	@echo ""
	@echo "Commands:"
	@echo "  install   - Install PHP dependencies"
	@echo "  migrate   - Run database migrations"
	@echo "  seed      - Seed the database"
	@echo "  start     - Start Docker containers"
	@echo "  stop      - Stop Docker containers"
	@echo "  test      - Run tests"

# Install PHP dependencies
install:
	$(COMPOSER) install

# Run database migrations
migrate:
	$(ARTISAN) migrate

# Seed the database
seed:
	$(ARTISAN) db:seed

# Start Docker containers
start:
	$(DOCKER_COMPOSE) up -d

# Stop Docker containers
stop:
	$(DOCKER_COMPOSE) down

# Run tests
test:
	$(PHP) vendor/bin/phpunit

.PHONY: all help install migrate seed start stop test
