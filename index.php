<?php
define('BA_START', microtime(true));

require_once "vendor/autoload.php";

(Dotenv\Dotenv::createImmutable(__DIR__))->safeLoad(true);

define('BASE_DIR', dirname(__FILE__));

require BASE_DIR . '/app/app.php';
