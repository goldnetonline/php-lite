COMPOSER ?= composer

.PHONY: help install update validate test lint qa serve env-setup pre-commit-install pre-commit-run

help:
	@echo "Available targets:"
	@echo "  install            Install project dependencies"
	@echo "  update             Update project dependencies"
	@echo "  validate           Validate composer configuration"
	@echo "  test               Run PHPUnit tests"
	@echo "  lint               Run PHP syntax checks"
	@echo "  qa                 Run validate + lint + tests"
	@echo "  serve              Start local development server on localhost:8000"
	@echo "  env-setup          Create .env from .env.example if missing"
	@echo "  pre-commit-install Install local git hooks via pre-commit"
	@echo "  pre-commit-run     Run pre-commit checks on all files"

install:
	@$(COMPOSER) install --no-interaction --prefer-dist

update:
	@$(COMPOSER) update

validate:
	@$(COMPOSER) validate --strict

test:
	@$(COMPOSER) test

lint:
	@find app tests -type f -name "*.php" -print0 | xargs -0 -n1 php -l

qa: validate lint test

serve:
	@php -S localhost:8000 -t .

env-setup:
	@if [ ! -f .env ] && [ -f .env.example ]; then cp .env.example .env && echo ".env created from .env.example"; else echo ".env already exists or .env.example missing"; fi

pre-commit-install:
	@git config --local --unset-all core.hooksPath || true
	@pre-commit install

pre-commit-run:
	@pre-commit run --all-files
