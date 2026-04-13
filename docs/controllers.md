# Controllers

## Table of Contents
- [Overview](#overview)
- [Controller Role](#controller-role)
- [BaseController](#basecontroller)
- [Request and Response Usage](#request-and-response-usage)
- [Returning Views](#returning-views)
- [Returning JSON](#returning-json)
- [Error Handling Patterns](#error-handling-patterns)
- [Controller Design Guidelines](#controller-design-guidelines)

## Overview
Controllers organize request handling into reusable classes. They keep route files clean and centralize HTTP logic.

## Controller Role
A controller should:
- validate and normalize input
- coordinate domain/service calls
- return a response payload or rendered view

It should not contain heavy business logic directly.

## BaseController
Extend `App\Core\BaseController` to inherit shared behavior and convenience methods.

Example:

```php
namespace App\Controllers;

use App\Core\BaseController;

class MainController extends BaseController
{
    public function about($request, $response)
    {
        return $this->view('pages/about.html', [
            'title' => 'About',
        ]);
    }
}
```

## Request and Response Usage
Typical action signature:

```php
public function submit($request, $response)
```

Use request object to read:
- method
- query values
- body values
- headers

Use response object to return:
- HTML
- JSON
- redirects
- status codes

## Returning Views
```php
return $this->view('pages/home.html', [
    'name' => 'Ada',
]);
```

`$this->view()` delegates template rendering through the framework view layer.

## Returning JSON
```php
return $response->json([
    'ok' => true,
    'message' => 'Saved',
]);
```

Use JSON for APIs and asynchronous frontend interactions.

## Error Handling Patterns
Recommended pattern:
1. wrap risky operations in `try/catch`
2. return explicit status code
3. include user-safe message
4. keep debug detail internal in production

## Controller Design Guidelines
- one controller per concern (page, auth, admin, etc.)
- keep actions short and purpose-driven
- avoid static state in controllers
- pass only required data to templates
