<?php

return [
    'routes' => [
        '_profiler_home' => [
            'path' => '/_profiler/home',
            'middleware' => \Profiler\Handler\HomeHandler::class,
        ],
        '_wdt' => [
            'path' => '/_wdt/{token}',
            'middleware' => \Profiler\Handler\ToolbarHandler::class,
        ],
        '_profiler_router' => [
            'path' => '/_profiler/{token}/router',
            'middleware' => \Profiler\Handler\RouterHandler::class,
        ],
        '_profiler' => [
            'path' => '/_profiler/{token}',
            'middleware' => \Profiler\Handler\PanelHandler::class,
        ],
    ],
];

