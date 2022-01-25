<?php
/*
 * File: routes.php
 * Project: arcinteriordesigns
 * File Created: Tuesday, 15th September 2020 2:02:18 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Monday, 24th May 2021 12:26:04 am
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
    'array' => [
        "status" => false,
        "issue" => "Server fault",
    ],
    'controller' => [\App\Controllers\MainController::class, 'controller'],
];
