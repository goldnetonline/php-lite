<?php
/*
 * File: helpers.php
 * Project: app
 * File Created: Sunday, 23rd May 2021 7:45:39 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Monday, 24th May 2021 2:29:07 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

use App\Core\App;

$app = App::getInstance();

/**
 * Read from env variable
 */
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $env = $_ENV[$key] ?? $default;
        if (in_array($env, ['true', 'false'])) {
            if ($env === 'true') {
                $env = true;
            } else {
                $env = false;
            }

        }
        return $env;
    }
}

/**
 * Read from the config file
 */
if (!function_exists('config')) {
    function config($conf, $default = null)
    {
        return $app->getConfig($conf, $default = null);
    }
}

/**
 * Read from request input or query string
 */
if (!function_exists('input')) {
    function input($key = null, $default = null)
    {
        return $app->request->input($key, $default);
    }
}

/**
 * Die and dump
 */
if (!function_exists('dd')) {
    function dd($dump)
    {
        if (is_array($dump) || $dump instanceof \Object) {
            echo json_encode($dump);
        } else {
            echo "<tt><pre>";
            echo @var_export($dump);
            echo "</pre></tt>";
        }

        die();
    }
}
