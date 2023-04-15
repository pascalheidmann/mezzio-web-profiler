<?php

namespace App;

return [
    'dependencies' => [
        'invokables' => [
            Handler\PingHandler::class => Handler\PingHandler::class,
        ],
        'factories'  => [
            Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
        ]
    ]
];