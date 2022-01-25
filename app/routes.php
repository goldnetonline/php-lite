<?php
/*
 * File: routes.php
 * Project: app
 * File Created: Tuesday, 15th September 2020 2:02:18 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 1st June 2021 11:44:06 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

/**
 * All routes can return an array, a closure
 * or an array of controller and method to call
 * All controllers must be instance of App\Core\BaseController
 */

return [
    'closure' => function ($request, $response) {
        return $response->json([
            "status" => true,
            "message" => "Orage is the new black",
        ]);
    },
    'post,get|array' => [
        "status" => false,
        "issue" => "Server fault",
    ],
    'post,get|controller' => [\App\Controllers\MainController::class, 'controller'],
    'post|contact' => [\App\Controllers\MainController::class, 'contact'],
];
