.PHONY: help ps build build-prod start fresh fresh-prod stop restart destroy \
	cache cache-clear migrate migrate migrate-fresh tests tests-html

CONTAINER_PHP=shkolo

help: ## Print help.
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
ps: ## Show containers.
	@docker compose ps
build: ## Build all containers
	@docker compose build --no-cache
stop: ## Stop all containers
	@docker compose stop
start: ## Start all containers
	@docker compose up --force-recreate -d
fresh: stop destroy build start  ## Destroy & recreate all containers.
restart: stop start ## Restart all containers
ssh: ## SSH into PHP container
	docker exec -it ${CONTAINER_PHP} sh
migrate: ## Run migration files
	docker exec ${CONTAINER_PHP} php artisan migrate
migrate-fresh: ## Clear database and run all migrations
	docker exec ${CONTAINER_PHP} php artisan migrate:fresh
migrate-fresh-seed: ## Clear database and run all migrations and seed
	docker exec ${CONTAINER_PHP} php artisan migrate:fresh --seed
tests: ## Run all tests
	docker exec ${CONTAINER_PHP} ./vendor/bin/phpunit
