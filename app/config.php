<?php
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
        'view_dir' => BASE_DIR . DIRECTORY_SEPARATOR . 'views',

        // Where all the route pagea are autoloaded
        // Relative to view_dir
        'pages_dir' => 'pages',

        // These are extra data attached to all views
        'global_context' => [
            'year' => date('Y'),
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
