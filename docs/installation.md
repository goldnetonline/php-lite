# Installation

## Table of Contents
- [Overview](#overview)
- [System Requirements](#system-requirements)
- [Create a New Project](#create-a-new-project)
- [Configure Environment Values](#configure-environment-values)
- [Run Locally](#run-locally)
- [Understand Project Structure](#understand-project-structure)
- [First Rendered Page](#first-rendered-page)
- [Common Setup Errors](#common-setup-errors)

## Overview
This section walks you from zero to a running PHP Lite project. It covers installation, environment setup, and a first page render so you can validate your machine and runtime quickly.

## System Requirements
- PHP 8.4+
- Composer 2+
- Apache or Nginx

Recommended PHP extensions:
- mbstring
- json
- ctype
- openssl
- tokenizer

## Create a New Project
Use Composer create-project (Packagist):

```bash
composer create-project goldnetonline/php-lite my-site
cd my-site
```

Then install dependencies (if needed by your environment flow):

```bash
composer install
```

## Configure Environment Values
Create or update `.env` with at least:

```env
DEBUG=true
MAINTENANCE_MODE=false

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=example
MAIL_PASSWORD=example
MAIL_FROM=noreply@example.com
```

Notes:
- `DEBUG=true` should only be used in development.
- production environments should set `DEBUG=false`.
- mail values can be placeholders until sending is required.

## Run Locally
```bash
php -S localhost:8000 -t .
```

Open `http://localhost:8000`.

## Understand Project Structure
- `index.php`: entry point for all web requests
- `app/config.php`: application and framework settings
- `app/routes.php`: route declarations
- `app/Controllers`: controller classes
- `views`: Twig templates and static page files

## First Rendered Page
1. Create `views/pages/home.html`
2. Add content:

```html
<h1>Welcome to PHP Lite</h1>
<p>Your app is running.</p>
```

3. Confirm `view.homepage` in `app/config.php` is `home.html`
4. Refresh the browser

## Common Setup Errors
- `Class not found`: run `composer install` again
- `500` at runtime: set `DEBUG=true` temporarily and inspect output
- static assets not loading: check server root and rewrite config
