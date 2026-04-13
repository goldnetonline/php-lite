# Testing

## Table of Contents
- [Overview](#overview)
- [Testing Goals](#testing-goals)
- [What to Test First](#what-to-test-first)
- [Running Tests](#running-tests)
- [Useful Test Commands](#useful-test-commands)
- [CI Expectations](#ci-expectations)
- [Troubleshooting Failing Tests](#troubleshooting-failing-tests)

## Overview
Testing verifies framework behavior, guards against regressions, and provides confidence for upgrades. Treat tests as release safety rails, not optional extras.

## Testing Goals
Primary goals:
- verify route dispatch behavior
- validate response contracts (status/body/headers)
- confirm view rendering paths
- protect helper and config behavior
- assert mail abstraction behavior (without sending real mail in unit tests)

## What to Test First
Recommended priority:
1. smoke test for application boot
2. route resolution and 404 behavior
3. controller actions for HTML + JSON
4. critical helpers/utilities
5. configuration edge cases

## Running Tests
From project root:

```bash
composer test
```

If your setup includes PHPUnit directly:

```bash
vendor/bin/phpunit
```

## Useful Test Commands
Run with verbose output:

```bash
vendor/bin/phpunit --testdox
```

Run a specific test file:

```bash
vendor/bin/phpunit tests/Feature/RoutingTest.php
```

## CI Expectations
CI should:
- execute tests on push and pull request
- fail builds on test failures
- run lint/static checks as separate jobs when available

A release tag should only be created after a green pipeline.

## Troubleshooting Failing Tests
1. run the failing test in isolation
2. compare local `.env` and CI assumptions
3. clear caches and re-install dependencies
4. inspect recent changes to routes/config/bootstrap
5. fix root cause before updating assertions
