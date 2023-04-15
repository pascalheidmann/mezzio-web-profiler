<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpKernel\DataCollector\DumpDataCollector;

class DumpDataCollectorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): DumpDataCollector
    {
        return new DumpDataCollector();
    }
}