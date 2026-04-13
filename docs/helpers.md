# Helpers

## Table of Contents
- [Overview](#overview)
- [Why Helpers Exist](#why-helpers-exist)
- [Common Helper Patterns](#common-helper-patterns)
- [Global Function Safety](#global-function-safety)
- [Creating a New Helper](#creating-a-new-helper)
- [Testing Helpers](#testing-helpers)
- [When Not to Use Helpers](#when-not-to-use-helpers)

## Overview
Helpers provide concise, reusable utility functions available across the application. They reduce repetitive boilerplate for frequent framework-level tasks.

## Why Helpers Exist
Good helper use cases:
- path and URL generation
- response shortcuts
- safe environment access
- common formatting utilities

Helpers should stay thin and predictable.

## Common Helper Patterns
Typical categories:
- configuration/environment access
- rendering convenience wrappers
- mail or logging entrypoints
- small string/array normalization utilities

## Global Function Safety
To avoid collisions:
- guard function declarations with `function_exists`
- use clear names tied to framework intent
- avoid generic names like `format()` or `render()`

Example:

```php
if (!function_exists('app_env')) {
    function app_env(string $key, $default = null)
    {
        return env($key, $default);
    }
}
```

## Creating a New Helper
1. add function in `app/helpers.php` (or project helper entry)
2. ensure file is autoloaded via Composer
3. add concise docblock and return contract
4. test behavior and edge cases

## Testing Helpers
Test for:
- null and empty input
- fallback/default behavior
- type consistency
- deterministic outputs

Keep helpers pure where possible to simplify tests.

## When Not to Use Helpers
Avoid helpers when logic:
- is domain-specific and belongs in a service
- requires heavy dependencies/state
- needs polymorphism/interface-based design
