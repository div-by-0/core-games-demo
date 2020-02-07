build-backend-ci:
	composer install --no-scripts --ignore-platform-reqs

build-frontend-ci:
# 	npm i
# 	npm run dev

###> symfony/framework-bundle ###
CONSOLE := $(shell which bin/console)
sf_console:
ifndef CONSOLE
	@printf "Run \033[32mcomposer require cli\033[39m to install the Symfony console.\n"
endif

cache-clear:
ifdef CONSOLE
	@$(CONSOLE) cache:clear --no-warmup
else
	@rm -rf var/cache/*
endif
.PHONY: cache-clear

cache-warmup: cache-clear
ifdef CONSOLE
	@$(CONSOLE) cache:warmup
else
	@printf "Cannot warm up the cache (needs symfony/console)\n"
endif
.PHONY: cache-warmup

serve_as_sf: sf_console
ifndef CONSOLE
	@${MAKE} serve_as_php
endif
	@$(CONSOLE) | grep server:start > /dev/null || ${MAKE} serve_as_php
	@$(CONSOLE) server:start

	@printf "Quit the server with \033[32;49mbin/console server:stop\033[39m\n"

serve_as_php:
	@printf "\033[32;49mServer listening on http://0.0.0.0:8000\033[39m\n";
	@printf "Quit the server with CTRL-C.\n"
	@printf "Run \033[32mcomposer require symfony/web-server-bundle\033[39m for a better web server\n"
	php -S 0.0.0.0:8000 -t public

serve:
	@${MAKE} serve_as_sf
.PHONY: sf_console serve serve_as_sf serve_as_php
###< symfony/framework-bundle ###

create-admin:
	@$(CONSOLE) fos:user:create admin admin admin --super-admin --no-debug || 1

deploy-backend-ci:
	git checkout -- symfony.lock
	composer install --ignore-platform-reqs
	@$(CONSOLE) doctrine:schema:update --force

build:
	composer install --ignore-platform-reqs --no-scripts
	@$(CONSOLE) cache:clear
	@$(CONSOLE) assets:install --symlink
	@$(CONSOLE) doctrine:schema:update --force --dump-sql
	@$(CONSOLE) do:fi:lo --append --group=sonataClassification
	@$(CONSOLE) do:fi:lo --append --group=shouldAppend
	@$(CONSOLE) do:fi:lo --append --group=tenderSeed
	@$(CONSOLE) contents:index
# 	npm i
# 	npm run dev


install:
	make build
	@$(CONSOLE) ckeditor:install
	make create-admin
	#make test

run:
	@$(CONSOLE) server:run
# 	@$(CONSOLE) server:run > /dev/null & npm run hot

test:
	./bin/phpunit -c ./phpunit.xml tests/

cron-daily:
	@$(CONSOLE) tender:scheduled-due-date-check

cron-hourly:
	@$(CONSOLE) tender:scheduler

generate-entities:
	bin/console doctrine:generate:entities ApplicationCallApplicationBundle
	bin/console doctrine:generate:entities ApplicationCallBundle
	bin/console doctrine:generate:entities ApplicationCallFormsBundle
	bin/console doctrine:generate:entities ApplicationCallTypeConfigBundle

purge:
	@$(CONSOLE) doctrine:database:drop --force
	@$(CONSOLE) doctrine:database:create
	make build
	make create-admin
	make run
