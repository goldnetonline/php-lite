<?php
/*
 * File: Response.php
 * Project: core
 * File Created: Sunday, 23rd May 2021 10:25:33 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Sunday, 23rd May 2021 11:51:11 pm
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

namespace App\Core;

use App\Core\Traits\Singleton;

class Response
{
    use Singleton;

    public $app;
    public $code = 200;
    public $responseText;
    private $contentType;
    public $responseBuffer;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Make arbitrary Response
     * @param string $sresponseText
     * @param int $code    The response code
     */
    public function make($responseText = null, int $code = 200): Self
    {

        if (is_array($responseText)) {
            return $this->json($responseText, $code);
        }

        return $this->html($responseText, $code);

    }

    /**
     * HTML Response
     * @param string $sresponseText
     * @param int $code    The response code
     */
    public function html(string $responseText = null, int $code = 200): Self
    {
        $this->responseText = $responseText;
        $this->code = $code;
        $this->contentType = 'text/html';

        return $this;
    }

    /**
     * JSON Response
     * @param array $object
     * @param int $code    The response code
     */
    public function json(array $object = null, int $code = 200): Self
    {
        $this->responseText = \json_encode($object);
        $this->code = $code;
        $this->contentType = 'application/json';

        return $this;
    }

    /**
     * Send the response
     */
    public function send()
    {
        http_response_code($this->code);
        header("Content-Type: " . $this->contentType);
        $this->responseBuffer = ob_start();
        echo $this->responseText;
        ob_end_flush();
        exit();
    }
}
