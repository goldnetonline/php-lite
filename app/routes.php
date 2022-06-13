<?php
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
