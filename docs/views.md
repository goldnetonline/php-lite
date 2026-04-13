# Views

## Table of Contents
- [Overview](#overview)
- [View Directory Structure](#view-directory-structure)
- [Rendering a Template](#rendering-a-template)
- [Layouts and Partials](#layouts-and-partials)
- [Global Context](#global-context)
- [Escaping and Safety](#escaping-and-safety)
- [Static Pages](#static-pages)
- [Template Troubleshooting](#template-troubleshooting)

## Overview
The view layer is responsible for final output generation (HTML/text). PHP Lite uses Twig for template rendering and supports static page lookup.

## View Directory Structure
Common directories:
- `views/pages`: user-facing pages
- `views/layouts`: reusable page shells
- `views/partials`: reusable fragments
- `views/mail`: email templates

## Rendering a Template
From a controller:

```php
return $this->view('pages/home.html', [
    'title' => 'Home',
]);
```

From a closure route (if view helper is available in your setup):

```php
return view('pages/home.html', ['title' => 'Home']);
```

## Layouts and Partials
Twig supports includes and inheritance.

Example include:

```twig
{% include 'partials/header.html' %}
```

Example inheritance:

```twig
{% extends 'layouts/base.html' %}
{% block content %}
  <h1>{{ title }}</h1>
{% endblock %}
```

## Global Context
Define values in `app/config.php` under `view.global_context` for site-wide data.

Use cases:
- site name
- current year
- environment indicator

## Escaping and Safety
Twig escapes output by default in HTML contexts.

Good practice:
- keep auto-escaping enabled
- sanitize/validate user content before persistence
- avoid rendering raw HTML from untrusted sources

## Static Pages
A URL can map directly to a file under `views/pages`.
Example: `/about` resolves to `views/pages/about.*` when route fallback allows it.

## Template Troubleshooting
1. check template path spelling
2. verify `view.view_dir`
3. confirm file extension matches loader expectations
4. clear cached templates if using cache
