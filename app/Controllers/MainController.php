<?php
/*
 * File: MainController.php
 * Project: Controllers
 * File Created: Monday, 24th May 2021 12:12:31 am
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Monday, 24th May 2021 1:56:56 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

namespace App\Controllers;

use App\Core\BaseController;

class MainController extends BaseController
{
    public function controller()
    {
        return $this->view->make('about.htm');
    }
}
