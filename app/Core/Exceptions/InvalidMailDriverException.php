<?php
namespace App\Core\Exceptions;

class InvalidMailDriverException extends \Exception
{

    public function __construct(string $driver)
    {
        $this->message = "Mail Driver $driver not supported";
    }
}
