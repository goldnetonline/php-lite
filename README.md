# PHP Lite Starter

![Tests](https://github.com/goldnetonline/php-lite/actions/workflows/tests.yml/badge.svg)
![Release](https://github.com/goldnetonline/php-lite/actions/workflows/release-packages.yml/badge.svg)

Starter project repository for creating new PHP Lite applications.

## Overview

- **Starter Repository**: This repository
- **Core Framework**: Maintained in [`goldnetonline/php-lite-core`](https://github.com/goldnetonline/php-lite-core)
- **Package Distribution**: Available on [Packagist](https://packagist.org/packages/goldnetonline/php-lite)

## Quick Start

Create a new project using Composer:

```bash
composer create-project goldnetonline/php-lite my-site
cd my-site
make env-setup
make install
php -S localhost:8000
```

## Project Setup

### Installation

```bash
make install
make env-setup
```

### Development

```bash
make install
make validate
make test
```

### Serve Locally

```bash
make serve
```

## Using Components from GitHub Packages

If the core package is published to GitHub Packages, configure authentication in your `composer.json`:

```json
{
    "repositories": {
        "github-packages": {
            "type": "composer",
            "url": "https://composer.github.com/goldnetonline"
        }
    }
}
```

Then update your dependency constraints accordingly.

## Release Process

### Creating a Release

1. Ensure all tests pass: `make qa`
2. Merge changes to `main`
3. Create and push a semantic version tag:
    ```bash
    git tag v1.0.0
    git push origin v1.0.0
    ```
4. Wait for the `release-packages` workflow to complete

### Release Artifacts

- **GitHub Releases**: Downloadable starter archives are available at [Releases](https://github.com/goldnetonline/php-lite/releases)
- **Packagist**: Package updates are published to [Packagist](https://packagist.org/packages/goldnetonline/php-lite) (requires webhook configuration)
- **GitHub Packages**: Available at `composer.github.com/goldnetonline`

### Configuring Packagist Webhook

To enable automatic Packagist updates on release:

1. Generate a Packagist API token at [api.packagist.org](https://packagist.org/profile/edit)
2. Add as GitHub secret `PHP_LITE_PACKAGIST_WEBHOOK_URL`:
    ```
    https://packagist.org/api/update-package?username=YOUR_USERNAME&apiToken=YOUR_TOKEN
    ```
3. Releases will trigger automatic updates

## Distribution & Exclusions

Project documentation and development files are excluded from distribution archives:

- `/docs` - Developer guides
- `/.github/workflows/release*` - Release workflows

These are available in the GitHub repository but not in exported `composer create-project` installs.

## Dependencies

The starter depends on:

- [`goldnetonline/php-lite-core`](https://github.com/goldnetonline/php-lite-core) - Core framework
- Standard PHP extensions: mbstring, json, ctype, openssl

## Maintainer Development

```bash
make pre-commit-install
make pre-commit-run
```

For detailed installation and configuration instructions, see [docs/installation.md](docs/installation.md).

## Contributing

See [docs/TESTING.md](docs/TESTING.md) for testing guidelines.

## License

MIT License - see LICENSE file
