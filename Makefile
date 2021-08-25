include .env

MOUNT_PATH=/tmp/client
DOCKER_IMAGE=ghcr.io/mallgroup/mpapi-client-php/php-74-composer:1.0
DOCKER_RUN=docker run -it --rm -w $(MOUNT_PATH) -v ${PWD}:$(MOUNT_PATH) $(DOCKER_IMAGE)

help:
	@echo "General"
	@echo "  init  - Initialize client"
	@echo "  shell - Run interactive shell"
	@echo ""
	@echo "Composer"
	@echo "  composer [args]   - Run custom composer command"
	@echo "  composer-install  - Install composer dependencies"
	@echo "  composer-update   - Update composer dependencies"
	@echo "  composer-validate - Validate composer json and lock files"
	@echo ""
	@echo "Code style and quality"
	@echo "  fix           - Run all automatic code fixers"
	@echo "  lint          - Run all linters"
	@echo "  lint-full     - Run all linters and code coverage"
	@echo "  phpcs [args]  - Run PHP Code Sniffer"
	@echo "  phpcbf [args] - Run PHP Code Beautifier and Fixer"
	@echo "  phpmd         - Run PHP Mess Detector"
	@echo "  phpstan       - Run PHPStan"
	@echo "  psalm         - Run Psalm"
	@echo "  coverage      - Get php code coverage"
	@echo ""
	@echo "Tests"
	@echo "  test [args]            - Run all tests (default, or custom test using ARGS=\"tests/unit/FilterTest.php\")"
	@echo "  test-unit [args]       - Run unit tests"
	@echo "  test-functional [args] - Run functional tests"

.env:
	cat .env.dist >> .env;

init: composer-install codecept-build

shell:
	$(DOCKER_RUN) bash

composer:
	$(DOCKER_RUN) composer $(ARGS)

composer-install:
	make composer ARGS="install"

composer-update:
	make composer ARGS="update"

composer-validate:
	make composer ARGS="validate --strict"

codecept-build:
	$(DOCKER_RUN) ./vendor/bin/codecept build

fix: phpcbf

lint: composer-validate phpcs phpmd phpstan psalm

lint-full: init lint coverage

phpcbf:
	$(DOCKER_RUN) ./vendor/bin/phpcbf --standard=./phpcs-ruleset.xml -d memory_limit=-1 --extensions=php --colors $(ARGS) -sp ./src

phpcs:
	$(DOCKER_RUN) ./vendor/bin/phpcs --standard=./phpcs-ruleset.xml -d memory_limit=-1 --extensions=php --colors $(ARGS) -sp ./src

phpmd:
	$(DOCKER_RUN) ./vendor/bin/phpmd ./src text ./phpmd.xml

phpstan:
	$(DOCKER_RUN) ./vendor/bin/phpstan analyse -c ./phpstan.neon --memory-limit=-1

psalm:
	$(DOCKER_RUN) ./vendor/bin/psalm

coverage:
	$(DOCKER_RUN) php -d pcov.exclude="~vendor~" ./vendor/bin/codecept run --coverage-text --coverage-html --phpunit-xml

test:
	$(DOCKER_RUN) ./vendor/bin/codecept run $(ARGS) --env local

test-unit:
	$(DOCKER_RUN) ./vendor/bin/codecept run unit $(ARGS) --env local

test-functional:
	$(DOCKER_RUN) ./vendor/bin/codecept run functional $(ARGS) --env local
