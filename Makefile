.PHONY: install start stop

help: ## Display available commands
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install all deps
	cd back && composer install

start: db-start ## start dev environment en daemon mode
	cd back && symfony server:start -d

stop: db-stop ## stop dev environment
	cd back && symfony server:stop

logs: ## Display dev server logs
	cd back && symfony server:log

test: ## Start tests
	cd back && php bin/phpunit

update_openapi-contract: ## Extract OpenAPI contract in yaml and json
	cd back && php bin/console api:openapi:export --yaml --output=public/openapi.yaml
	cd back && php bin/console api:openapi:export --output=public/openapi.json

db-start: ## start PostgreSQL in Docker Compose
	cd back && docker-compose up -d

db-stop: ## stop Docker Compose PG
	cd back && docker-compose down

db-logs: ## Display pg logs from Docker Compose
	cd back && docker-compose logs -f

db-init: ## Play all migration and import data from legacy markdown files
	cd back && php bin/console doctrine:migrations:migrate -n
	cd back && php bin/console doctrine:fixtures:load -n
