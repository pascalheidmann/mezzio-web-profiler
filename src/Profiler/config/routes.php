<?php

return [
    'routes' => [
        '_wdt' => [
            'path' => '/_wdt/{token}',
            'middleware' => \Profiler\Handler\ToolbarHandler::class,
        ],
        '_profiler_phpinfo' => [
            'path' => '/_profiler/phpinfo',
            'middleware' => \Profiler\Handler\PhpInfoHandler::class,
        ],
        '_profiler_home' => [
            'path' => '/_profiler/home',
            'middleware' => \Profiler\Handler\HomeHandler::class,
        ],
        '_profiler_router' => [
            'path' => '/_profiler/{token}/router',
            'middleware' => \Profiler\Handler\RouterHandler::class,
        ],
        '_profiler_search_results' => [
            'path' => '/_profiler/{token}/search/results',
            'middleware' => \Profiler\Handler\SearchResultsHandler::class,
        ],
        '_profiler_search' => [
            'path' => '/_profiler/search',
            'middleware' => \Profiler\Handler\SearchHandler::class,
        ],
        '_profiler_search_bar' => [
            'path' => '/_profiler/search_bar',
            'middleware' => \Profiler\Handler\SearchBarHandler::class,
        ],
        'web_profiler.controller.profiler::searchBarAction' => [
            'path' => 'web_profiler.controller.profiler::searchBarAction',
            'middleware' => \Profiler\Handler\SearchBarHandler::class,
        ],
        '_profiler' => [
            'path' => '/_profiler/{token}',
            'middleware' => \Profiler\Handler\PanelHandler::class,
        ],
    ],
];

