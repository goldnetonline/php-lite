# Configuration

## Table of Contents
- [Overview](#overview)
- [Configuration File Layout](#configuration-file-layout)
- [App Settings](#app-settings)
- [View Settings](#view-settings)
- [Mail Settings](#mail-settings)
- [Environment Strategy](#environment-strategy)
- [Configuration Validation Checklist](#configuration-validation-checklist)

## Overview
PHP Lite configuration lives in `app/config.php`. Values are grouped by subsystem and typically sourced from `.env` for environment-specific behavior.

## Configuration File Layout
Main sections:
- `app`: runtime behavior
- `view`: rendering and template lookup
- `mail`: outgoing email driver and credentials

## App Settings
Key options:
- `app.debug`
- `app.maintenance_mode`
- `app.route_file`

Example:

```php
'app' => [
    'debug' => (bool) env('DEBUG', false),
    'maintenance_mode' => (bool) env('MAINTENANCE_MODE', false),
    'route_file' => BASE_DIR . '/app/routes.php',
],
```

Behavior:
- `debug=true` enables detailed error output
- `maintenance_mode=true` serves maintenance page responses

## View Settings
Common keys:
- `view.homepage`
- `view.view_dir`
- `view.cache_dir`
- `view.pages_dir`
- `view.global_context`

Example:

```php
'view' => [
    'homepage' => 'home.html',
    'view_dir' => BASE_DIR . '/views',
    'cache_dir' => BASE_DIR . '/.cache/view',
    'pages_dir' => 'pages',
    'global_context' => [
        'year' => date('Y'),
        'site_name' => 'Acme Inc',
    ],
],
```

`global_context` values are injected into all templates.

## Mail Settings
Supported drivers:
- `smtp`
- `mailgun`

Top-level keys:
- `mail.driver`
- `mail.default_from`

Driver blocks:
- `mail.smtp`
- `mail.mailgun`

Set only one active driver per environment.

## Environment Strategy
Suggested split:
- local: `DEBUG=true`, sandbox mail credentials
- staging: `DEBUG=false`, non-production credentials
- production: `DEBUG=false`, production credentials

Never commit real production secrets.

## Configuration Validation Checklist
1. `app.route_file` points to an existing file
2. `view.view_dir` and `view.pages_dir` are correct
3. `mail.driver` matches a configured driver block
4. `MAIL_FROM` is set for outgoing messages
