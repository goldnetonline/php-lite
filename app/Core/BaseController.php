<?php
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
