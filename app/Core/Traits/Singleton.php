<?php
/*
 * File: Singleton.php
 * Project: Traits
 * File Created: Sunday, 23rd May 2021 11:39:00 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Sunday, 23rd May 2021 11:42:19 pm
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

namespace App\Core\Traits;

trait Singleton
{
    private static $instance;

    /**
     * Make this application a single instance app
     * return the main instance of the app
     */
    public static function getInstance($app = null)
    {
        if (!Self::$instance) {
            Self::$instance = new Self($app);
        }

        return Self::$instance;
    }
}
