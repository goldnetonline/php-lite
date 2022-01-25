<?php
/*
 * File: BaseController.php
 * Project: core
 * File Created: Sunday, 23rd May 2021 11:57:45 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Monday, 24th May 2021 1:57:18 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

namespace App\Core;

/**
 * Controller can return anything from array to string to numbers
 * It can also return \App\Core\Response
 */
abstract class BaseController
{
    public $app;
    public $request;
    public $response;
    public $view;

    public function __construct($app)
    {
        $this->app = $app;
        $this->request = $app->request;
        $this->response = $app->response;
        $this->view = $app->view;
    }
}
