<?php

return [
    \Profiler\ConfigProvider::class => [
        'data_collector' => [
            \Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector::class => [
                'template' => '@WebProfiler/Collector/config.html.twig',
                'id' => 'config',
                'priority' => -255
            ],
            \Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector::class => [
                'template' => '@WebProfiler/Collector/ajax.html.twig',
                'id' => 'ajax',
                'priority' => 315
            ],
            \Symfony\Component\HttpKernel\DataCollector\ExceptionDataCollector::class => [
                'template' => '@WebProfiler/Collector/exception.html.twig',
                'id' => 'exception',
                'priority' => 305
            ],
            \Symfony\Component\HttpKernel\DataCollector\TimeDataCollector::class => [
                'template' => '@WebProfiler/Collector/time.html.twig',
                'id' => 'time',
                'priority' => 330
            ],
            \Symfony\Component\HttpKernel\DataCollector\MemoryDataCollector::class => [
                'template' => '@WebProfiler/Collector/memory.html.twig',
                'id' => 'memory',
                'priority' => 300
            ],
            \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector::class => [
                'template' => '@WebProfiler/Collector/logger.html.twig',
                'id' => 'logger',
                'priority' => 300
            ],
            \Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector::class => [
                'template' => '@MezzioProfiler/Collector/router.html.twig',
                'id' => 'router',
                'priority' => 285
            ],
            \Symfony\Component\HttpKernel\DataCollector\RequestDataCollector::class => [
                'template' => '@WebProfiler/Collector/request.html.twig',
                'id' => 'request',
                'priority' => 335,
            ],
            \Symfony\Bridge\Twig\DataCollector\TwigDataCollector::class => [
                'template' => '@WebProfiler/Collector/twig.html.twig',
                'id' => 'twig',
                'priority' => 257,
            ],
            \Profiler\DataCollector\GuzzleDataCollector::class => [
                'template' => '@MezzioProfiler/Collector/guzzle.html.twig',
                'id' => 'guzzle',
                'priority' => 298,
            ],
        ],
    ],
];
