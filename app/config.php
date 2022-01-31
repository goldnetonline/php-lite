<?php
/*
 * File: config.php
 * Project: app
 * File Created: Sunday, 23rd May 2021 8:00:46 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Monday, 31st January 2022 1:36:18 pm
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2022, CamelCase Technologies Ltd
 */

return [

    'app' => [

        // If debug mode is on
        'debug' => (bool) env('DEBUG', false),

        // If maintenance mode is on
        'maintenance_mode' => (bool) env('MAINTENANCE_MODE', false),

        // Where all routes are loaded from
        'route_file' => BASE_DIR . "/app/routes.php",

    ],

    'view' => [
        // View to load for homepage
        'homepage' => 'home.html',

        // Where all custom twig views are loaded from
        'view_dir' => BASE_DIR . '/views/pages',

        // Where all the route pagea are autoloaded
        // Relative to view_dir
        'pages_dir' => 'pages',

        // These are extra data attached to all views
        'global_context' => [
            'year' => date('Y'),
            'team' => [
                'Arch. Anu Adeosun' => 'Lead Design Architect',
                'Arch. Bolaji Olowolabayaki' => 'Deputy Lead Design Architect',
                'Yewande Afinowi' => 'Human Resources Supervisor',
                'Kazeem Lawal' => 'Chief Financial Officer',
                'Arch. Shittu Ade' => 'Project Manager (Lagos)',
                'Henry Ofori ' => 'Project Manager (Ghana)',
            ],
        ],
    ],

    'mail' => [
        // mail driver, default to smtp
        // Support for smtp and mailgun at the moment
        'driver' => env('MAIL_DRIVER', 'smtp'),
        'default_from' => env('MAIL_FROM', 'someone@somewhere.com'),

        // Smtp driver configuration
        'smtp' => [
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        ],

        //Mailgun driver configuration
        'mailgun' => [
            'api_key' => env('MAILGUN_API_KEY'),
            'domain_name' => env('MAILGUN_DOMAIN_NAME'),
            'mail_from' => env('MAILGUN_MAIL_FROM'),
        ],
    ],

];
