# Deployment

## Table of Contents
- [Overview](#overview)
- [Deployment Checklist](#deployment-checklist)
- [Environment Hardening](#environment-hardening)
- [Web Server Configuration Notes](#web-server-configuration-notes)
- [Release Process](#release-process)
- [Packagist and Distribution](#packagist-and-distribution)
- [Post-Deploy Verification](#post-deploy-verification)
- [Rollback Strategy](#rollback-strategy)

## Overview
Deployment turns your tested application into a stable production runtime. This guide emphasizes repeatability, safe defaults, and quick verification.

## Deployment Checklist
Before deploy:
1. all tests pass
2. release notes prepared
3. environment variables set
4. debug disabled
5. maintenance plan defined

## Environment Hardening
Production minimums:
- `DEBUG=false`
- secure secret management
- restricted file permissions
- HTTPS termination enabled
- error output disabled to end users

## Web Server Configuration Notes
General practices:
- route all requests through `index.php`
- deny direct access to sensitive files (`.env`, internal config)
- configure caching headers for static assets
- enable gzip/brotli where possible

## Release Process
Recommended flow:
1. merge approved changes to default branch
2. create semantic tag (`v1.2.3`)
3. CI runs tests/build/release workflow
4. publish release artifacts
5. trigger Packagist refresh webhook (if configured)

## Packagist and Distribution
- starter project is installable via `composer create-project`
- dependency updates should rely on tagged versions
- docs can be excluded from dist archive using `.gitattributes` export-ignore

## Post-Deploy Verification
Verify immediately:
- homepage load
- key route health
- form submit/API endpoint
- mail send in target environment
- error logs free of new critical events

## Rollback Strategy
Prepare rollback before deployment:
- keep previous release reference
- use reversible migration strategy for data changes
- automate rollback steps where possible
- communicate rollback criteria and ownership
