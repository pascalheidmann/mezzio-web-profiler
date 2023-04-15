<?php

return [
    'routes' => [
        'home' => [
            'name' => 'home',
            'path' => '/',
            'middleware' => \App\Handler\HomePageHandler::class,
        ],
        'api.ping' => [
            'name' => 'api.ping',
            'path' => '/ping',
            'middleware' => \App\Handler\PingHandler::class,
        ]
    ],
];

