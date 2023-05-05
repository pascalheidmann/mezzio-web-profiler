<?php

namespace App;

use Monolog\Logger;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'aliases' => [
            \Psr\Log\LoggerInterface::class => \Monolog\Logger::class,
        ],
        'invokables' => [
            Handler\PingHandler::class => Handler\PingHandler::class,
        ],
        'factories'  => [
            Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            \Monolog\Logger::class => static fn(ContainerInterface $container) => new Logger('default'),
        ],
    ]
];
