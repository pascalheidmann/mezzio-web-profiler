<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpKernel\DataCollector\TimeDataCollector;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class TimeDataCollectorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $kernel = $container->has(KernelInterface::class) ? $container->get(KernelInterface::class) : null;
        $stopWatch = $container->has(Stopwatch::class) ? $container->get(Stopwatch::class) : null;

        return new TimeDataCollector($kernel, $stopWatch);
    }
}