<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Monolog\Logger;
use Profiler\Guzzle\GuzzleSubscriber;
use Profiler\Integrations\Guzzle\ProfilerMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\Stopwatch\Stopwatch;

return [
    'dependencies' => [
        'aliases' => [
            \Psr\Log\LoggerInterface::class => Logger::class,
            ClientInterface::class => Client::class,
        ],
        'invokables' => [
            Handler\PingHandler::class => Handler\PingHandler::class,
            Stopwatch::class => Stopwatch::class,
        ],
        'factories' => [
            Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            Logger::class => static fn(ContainerInterface $container) => new Logger('default'),
            Client::class => static fn(ContainerInterface $container) => new Client(
                ['handler' => $container->get(HandlerStack::class)]
            ),
            HandlerStack::class => static function (ContainerInterface $container): HandlerStack {
                $handlerStack = HandlerStack::create();
                $handlerStack->push($container->get(ProfilerMiddleware::class));
                return $handlerStack;
            },
        ],
    ],
];
