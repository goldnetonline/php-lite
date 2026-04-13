# php lite starter

Starter project repository for `goldnetonline/php-lite`.

Core framework package is maintained separately as `goldnetonline/php-lite-core`.

## maintainer setup

```bash
make install
make validate
make test
```

## create a new project

Use Composer create-project from Packagist:

```bash
composer create-project goldnetonline/php-lite my-site
cd my-site
composer install
```

This starter now consumes `goldnetonline/php-lite-core` from Packagist using a tagged stable version constraint.

## release flow

1. Merge changes to `main`
2. Create and push a semantic tag (example: `v1.0.0`)
3. Wait for `release-packages` workflow to finish
4. Download the starter tarball from the GitHub release
5. If configured, Packagist is refreshed via `PHP_LITE_PACKAGIST_WEBHOOK_URL`

## Packagist CI/CD notes

- `tests.yml` runs install, validation, audit, and test checks on pushes and pull requests.
- `release-packages.yml` runs verification on tags, builds archive artifacts, creates a GitHub release, and triggers optional Packagist webhook refresh.

## distribution behavior

Project docs are retained in this repository for maintainers and contributors, but excluded from exported distribution archives using `.gitattributes` `export-ignore` rules.

## local development with sibling core repository (optional)

For framework contributors only, you can still temporarily link a local sibling core checkout:

```bash
make link-local-core
composer update
```

To restore normal Packagist consumption:

```bash
make unlink-local-core
composer update
```
