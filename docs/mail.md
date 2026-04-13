# Mail

## Table of Contents
- [Overview](#overview)
- [Mail Architecture](#mail-architecture)
- [Supported Drivers](#supported-drivers)
- [SMTP Configuration](#smtp-configuration)
- [Mailgun Configuration](#mailgun-configuration)
- [Sending Mail](#sending-mail)
- [Using Templates for Mail](#using-templates-for-mail)
- [Mail Delivery Troubleshooting](#mail-delivery-troubleshooting)

## Overview
PHP Lite provides a pluggable mail subsystem with a unified interface so your app code can send mail without coupling to a specific provider.

## Mail Architecture
Core concepts:
- `Mailer` contract
- driver implementations (`Smtp`, `Mailgun`)
- facade/service entrypoint (`Mail`)

This architecture allows provider swaps via configuration rather than controller rewrites.

## Supported Drivers
- `smtp`
- `mailgun`

Choose through `MAIL_DRIVER` in `.env`.

## SMTP Configuration
Required values:

```env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=example
MAIL_PASSWORD=example
MAIL_FROM=noreply@example.com
```

## Mailgun Configuration
Required values:

```env
MAIL_DRIVER=mailgun
MAILGUN_DOMAIN=mg.example.com
MAILGUN_SECRET=key-xxxx
MAILGUN_ENDPOINT=https://api.mailgun.net
MAIL_FROM=noreply@example.com
```

## Sending Mail
Typical flow:
1. resolve mail service
2. build recipient/subject/body
3. send and handle result

Pseudo-example:

```php
$mail = mailer();
$mail->to('user@example.com')->subject('Welcome')->send('Hello!');
```

Use the project-specific helper/service names available in your app bootstrap.

## Using Templates for Mail
Keep mail HTML/text bodies in `views/mail`.
Render with data, then pass final output to mail sender.

Benefits:
- maintainable branding
- reusable snippets
- easier testing and preview

## Mail Delivery Troubleshooting
1. verify active driver and credentials
2. check TLS/port combination
3. test provider credentials independently
4. log provider responses in non-production
