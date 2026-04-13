<picture>
  <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/goldnetonline/php-lite/main/assets/logo.svg">
  <source media="(prefers-color-scheme: light)" srcset="https://raw.githubusercontent.com/goldnetonline/php-lite/main/assets/logo.svg">
  <img alt="PHP Lite" src="https://raw.githubusercontent.com/goldnetonline/php-lite/main/assets/logo.svg" height="200">
</picture>

# PHP Lite

<a href="https://github.com/goldnetonline/php-lite/actions/workflows/tests.yml"><img src="https://github.com/goldnetonline/php-lite/actions/workflows/tests.yml/badge.svg" alt="Tests Passing"></a>
<a href="https://packagist.org/packages/goldnetonline/php-lite"><img src="https://img.shields.io/packagist/v/goldnetonline/php-lite" alt="Packagist"></a>
<a href="https://github.com/goldnetonline/php-lite/blob/main/LICENSE"><img src="https://img.shields.io/badge/license-MIT-green" alt="License"></a>

Lightweight PHP web framework for building fast, elegant applications.

## Quick Start

### Option 1: From Packagist (Recommended)

```bash
composer create-project goldnetonline/php-lite my-site
cd my-site
make env-setup
make install
php -S localhost:8000
```

### Option 2: From GitHub

Clone the repository directly:

```bash
git clone https://github.com/goldnetonline/php-lite.git my-site
cd my-site
make env-setup
make install
php -S localhost:8000
```

## Features

- **⚡ Blazing Fast** - Minimal overhead, pure PHP performance
- **🎯 Simple & Clean** - Intuitive routing and clear request/response lifecycle  
- **🛠️ Modern PHP** - Built for PHP 8.4+ with latest language features
- **📧 Mail Ready** - SMTP and Mailgun drivers included
- **🎨 Twig Templates** - Powerful template engine for beautiful views
- **🚀 Production Ready** - Error handling, debugging tools, and maintenance mode

## Documentation

For detailed installation, configuration, and usage guides, see the [complete documentation](https://github.com/goldnetonline/php-lite/blob/main/docs/index.md).

## Getting Help

- **Issues**: Report bugs on [GitHub Issues](https://github.com/goldnetonline/php-lite/issues)
- **Framework**: Learn more about the core framework at [`goldnetonline/php-lite-core`](https://github.com/goldnetonline/php-lite-core)

## License

The PHP Lite framework is open-sourced software licensed under the [MIT license](LICENSE).
