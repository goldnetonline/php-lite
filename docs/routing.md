# Routing

## Table of Contents
- [Overview](#overview)
- [How Requests Resolve](#how-requests-resolve)
- [Route File Format](#route-file-format)
- [Closure Routes](#closure-routes)
- [Controller Routes](#controller-routes)
- [HTTP Method Routing](#http-method-routing)
- [Static Page Fallback](#static-page-fallback)
- [Troubleshooting Routing](#troubleshooting-routing)

## Overview
Routing maps an incoming URL and HTTP method to a handler. In PHP Lite, route definitions are declared in `app/routes.php`.

## How Requests Resolve
Request resolution order:
1. static page check under `views/pages`
2. dynamic route lookup from `app/routes.php`
3. 404 response if no match

This ordering means a static page can override a dynamic route with the same slug.

## Route File Format
`app/routes.php` returns an associative array where each key is a route declaration and each value is a handler.

## Closure Routes
```php
return [
    'hello' => function ($request, $response) {
        return $response->json(['message' => 'hello']);
    },
];
```

Use this for small endpoints and quick prototypes.

## Controller Routes
```php
'get|dashboard' => [\App\Controllers\DashboardController::class, 'index']
```

If method name is missing, `__invoke()` is expected.

## HTTP Method Routing
Method-aware key format:

```php
'post,get|contact' => [\App\Controllers\MainController::class, 'contact']
```

Supported methods:
- GET
- POST
- PUT
- PATCH
- DELETE
- OPTION

## Static Page Fallback
Examples:
- `/` maps to `view.homepage`
- `/about` maps to `views/pages/about.*`
- `/company/team` maps to `views/pages/company/team.*`

## Troubleshooting Routing
1. verify `app.route_file` path
2. confirm URL slug normalization
3. confirm HTTP method matches route declaration
4. check for static-page conflicts
