<?php
/*
 * File: InvalidMailDriverException.php
 * Project: Exceptions
 * File Created: Tuesday, 1st June 2021 10:25:46 am
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 1st June 2021 11:45:16 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

namespace App\Core\Exceptions;

class InvalidMailDriverException extends \Exception
{

    public function __construct(string $driver)
    {
        $this->message = "Mail Driver $driver not supported";
    }
}
