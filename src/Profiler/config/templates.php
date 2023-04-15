<?php

$twigExtensions = [
    \Profiler\Twig\ControllerExtension::class,
];

if (class_exists(\Symfony\Bridge\Twig\Extension\CodeExtension::class)) {
    $twigExtensions[] = \Symfony\Bridge\Twig\Extension\CodeExtension::class;
}

return [
    'templates' => [
        'paths' => [
            'WebProfiler' => [__DIR__ . '/../../../vendor/symfony/web-profiler-bundle/Resources/views/'],
            'MezzioProfiler' => [__DIR__ . '/../templates/']
        ],
    ],
    'twig' => [
        'extensions' => $twigExtensions
    ],
];