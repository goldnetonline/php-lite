<?php
/*
 * File: index.php
 * Project: php-lite
 * File Created: Tuesday, 7th May 2019 7:35:37 am
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Thursday, 3rd March 2022 6:05:54 pm
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2022, CamelCase Technologies Ltd
 */

define('BA_START', microtime(true));

require_once "vendor/autoload.php";

(Dotenv\Dotenv::createImmutable(__DIR__))->safeLoad(true);
// $dotenv->load(__DIR__ . '/.env');

define('BASE_DIR', dirname(__FILE__));

require BASE_DIR . '/app/app.php';
