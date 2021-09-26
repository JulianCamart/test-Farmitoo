.PHONY: help
.DEFAULT_GOAL = help
DOCKER_COMPOSE=docker-compose -p test_farmitoo
DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE) exec
PHP_DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE_EXEC) php
NODE_DOCKER_COMPOSE_RUN=$(DOCKER_COMPOSE) run --rm node
COMPOSER=$(PHP_DOCKER_COMPOSE_EXEC) php -d memory_limit=-1 /usr/local/bin/composer
SYMFONY_CONSOLE=$(PHP_DOCKER_COMPOSE_EXEC) bin/console

## —— Docker 🐳  ———————————————————————————————————————————————————————————————
install: start node-install node-build vendor-install create-db ## Installation du projet

uninstall: clean-vendor clean-node rm ## Désinstallation du projet
	sudo rm -Rf ./data/
	rm -Rf ./var/

start:	## Lancer les containers docker
	$(DOCKER_COMPOSE) up -d

stop:	## Arréter les containers docker
	$(DOCKER_COMPOSE) stop

rm:	stop ## Supprimer les containers docker
	$(DOCKER_COMPOSE) rm -f

restart: rm start	## redémarrer les containers

ssh-php:	## Connexion au container php
	$(PHP_DOCKER_COMPOSE_EXEC) bash

## —— Symfony 🎶 ———————————————————————————————————————————————————————————————
vendor-install:	## Installation des vendors
	$(COMPOSER) install

vendor-update:	## Mise à jour des vendors
	$(COMPOSER) update

clean-vendor: cc-hard ## Suppression du répertoire vendor puis un réinstall
	$(PHP_DOCKER_COMPOSE_EXEC) rm -Rf vendor
	sudo rm -Rf ./vendor

node-install: ## installation des modules node
	$(NODE_DOCKER_COMPOSE_RUN)

node-build-dev: ## Build assets with node container
	$(NODE_DOCKER_COMPOSE_RUN) npm run dev

node-watch: ## Run Webpack in watch mode
	$(NODE_DOCKER_COMPOSE_RUN) npm run watch

clean-node: cc-hard ## Suppression du répertoire node_module puis un réinstall
	$(NODE_DOCKER_COMPOSE_RUN) rm -Rf ./node_modules/
	sudo rm -Rf ./node_modules/
	sudo rm -Rf ./public/build/

cc:	## Vider le cache
	$(SYMFONY_CONSOLE) c:c

cc-test: ## Vider le cache de l'environnement de test
	$(SYMFONY_CONSOLE) c:c --env=test

cc-hard: ## Supprimer le répertoire cache
	$(PHP_DOCKER_COMPOSE_EXEC) rm -fR var/cache/*

migration: ## Supprimer le répertoire cache
	$(SYMFONY_CONSOLE) make:migration

migrate:
	$(SYMFONY_CONSOLE) d:m:m --no-interaction --no-interaction

create-db: ## Créer la base de donnée et charger les fixtures
	$(SYMFONY_CONSOLE) d:d:c
	$(SYMFONY_CONSOLE) d:m:m --no-interaction
	$(SYMFONY_CONSOLE) d:f:l --no-interaction

clean-db: ## Réinitialiser la base de donnée
	- $(SYMFONY_CONSOLE) d:d:d --force --connection
	$(SYMFONY_CONSOLE) d:d:c
	$(SYMFONY_CONSOLE) d:m:m --no-interaction
	$(SYMFONY_CONSOLE) d:f:l --no-interaction

clean-db-test: cc-hard cc-test ## Réinitialiser la base de donnée en environnement de test
	- $(SYMFONY_CONSOLE) d:d:d --force --env=test
	$(SYMFONY_CONSOLE) d:d:c --env=test
	$(SYMFONY_CONSOLE) d:m:m --no-interaction --env=test
	$(SYMFONY_CONSOLE) d:f:l --no-interaction --env=test

test-unit: ## Lancement des tests unitaire
	$(PHP_DOCKER_COMPOSE_EXEC) bin/phpunit tests/Unit/

test-func: clean-db-test	## Lancement des tests fonctionnel
	$(PHP_DOCKER_COMPOSE_EXEC) bin/phpunit tests/Func/

tests: test-func test-unit	## Lancement de tous tests

cs: ## Lancement du php cs
	$(PHP_DOCKER_COMPOSE_EXEC) vendor/bin/phpcs -n

## —— Others 🛠️️ ———————————————————————————————————————————————————————————————
help: ## Liste des commandes
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'