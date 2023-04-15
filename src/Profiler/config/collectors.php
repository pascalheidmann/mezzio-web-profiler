<?php

return [
    \Profiler\ConfigProvider::class => [
        'data_collector' => [
            \Symfony\Component\HttpKernel\DataCollector\MemoryDataCollector::class => [
                'template' => '@WebProfiler/Collector/memory.html.twig',
                'id' => 'memory',
                'priority' => 300
            ],
            /*
            \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector::class => [
                'template' => '@WebProfiler/Collector/logger.html.twig',
                'id' => 'logger',
                'priority' => 300
            ],
            */
            \Symfony\Component\HttpKernel\DataCollector\RouterDataCollector::class => [
                'template' => '@MezzioProfiler/Collector/router.html.twig',
                'id' => 'router',
                'priority' => 285
            ],

            \Symfony\Bridge\Twig\DataCollector\TwigDataCollector::class => [
                'template' => '@WebProfiler/Collector/twig.html.twig',
                'id' => 'twig',
                'priority' => 257
            ],
        ],
    ],
];
