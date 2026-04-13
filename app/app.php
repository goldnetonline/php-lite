<?php
use Goldnetonline\PhpLiteCore\App;

if (!defined('BASE_DIR')) {
    die("Race condition ");
}

// Instantiate the application
$app = App::getInstance([
    'base_dir' => BASE_DIR,
    'config_path' => BASE_DIR . '/app/config.php',
]);

// Run the app
$app->run();
