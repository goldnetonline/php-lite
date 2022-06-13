<?php
use App\Core\App;

if (!defined('BASE_DIR')) {
    die("Race condition ");
}

// Instantiate the application
$app = App::getInstance();

// All Helper functions
require dirname(__FILE__) . '/helpers.php';

// Run the app
$app->run();
