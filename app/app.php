<?php
/*
 * File: app.php
 * Project: app
 * File Created: Sunday, 23rd May 2021 7:48:06 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Monday, 24th May 2021 2:01:32 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

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
