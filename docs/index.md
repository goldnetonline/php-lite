# PHP Lite Documentation

## Table of Contents
- [What PHP Lite Is](#what-php-lite-is)
- [Who This Guide Is For](#who-this-guide-is-for)
- [Recommended Reading Path](#recommended-reading-path)
- [Documentation Map](#documentation-map)
- [Getting Help](#getting-help)

## What PHP Lite Is
PHP Lite is a lightweight PHP starter and framework combination for building small websites and simple API endpoints with minimal setup overhead.

It focuses on:
- straightforward routing and controllers
- Twig-based server-rendered views
- pragmatic mail support (SMTP and Mailgun)
- easy deployment to standard shared hosting and VPS setups

## Who This Guide Is For
This documentation is written for:
- developers starting a new PHP Lite project
- maintainers upgrading or extending existing PHP Lite projects
- teams onboarding new developers who need context and conventions

This guide intentionally explains concepts from first principles and avoids hidden assumptions.

## Recommended Reading Path
1. Start with [installation](installation.md)
2. Continue to [configuration](configuration.md)
3. Define behavior with [routing](routing.md)
4. Implement logic using [controllers](controllers.md)
5. Build UI with [views](views.md)
6. Add notifications via [mail](mail.md)
7. Use convenience helpers in [helpers](helpers.md)
8. Add confidence with [TESTING](TESTING.md)
9. Prepare production in [deployment](deployment.md)

## Documentation Map
- [installation](installation.md): prerequisites, project bootstrap, local run
- [configuration](configuration.md): app/view/mail settings and environment strategy
- [routing](routing.md): URL mapping, HTTP methods, static page resolution
- [controllers](controllers.md): action structure, response patterns, validation style
- [views](views.md): Twig templates, layouts, partials, shared context
- [mail](mail.md): SMTP/Mailgun setup and safe send patterns
- [helpers](helpers.md): global helper functions and usage guidance
- [TESTING](TESTING.md): unit/feature testing and test workflow
- [deployment](deployment.md): hosting checklist, rollout, rollback

## Getting Help
When troubleshooting:
1. confirm environment values in `.env`
2. run `composer validate --strict`
3. run `composer test`
4. re-check relevant section in this docs directory
