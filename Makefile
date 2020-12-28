.PHONY: install start stop

help: ## Display available commands
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install all deps
	cd back && composer install
	cd front && yarn

start: db-start ## start dev environment en daemon mode
	cd back && symfony server:start -d

stop: db-stop ## stop dev environment
	cd back && symfony server:stop

logs: ## Display dev server logs
	cd back && symfony server:log

docker-logs: ## Display pg logs from Docker Compose
	docker-compose logs -f

db-start: ## start PostgreSQL in Docker Compose
	docker-compose up -d

db-stop: ## stop Docker Compose PG
	docker-compose down

