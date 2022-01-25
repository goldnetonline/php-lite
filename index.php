<?php
/*
 * File: index.php
 * Project: lite-framework
 * File Created: Tuesday, 7th May 2019 7:35:37 am
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 25th January 2022 10:52:44 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2022, CamelCase Technologies Ltd
 */

define('BA_START', microtime(true));

require_once "vendor/autoload.php";

(Dotenv\Dotenv::createImmutable(__DIR__))->load(true);
// $dotenv->load(__DIR__ . '/.env');

define('BASE_DIR', dirname(__FILE__));

require BASE_DIR . '/app/app.php';
