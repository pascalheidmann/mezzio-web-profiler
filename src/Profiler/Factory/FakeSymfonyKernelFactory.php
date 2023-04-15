<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Profiler\Service\FakeSymfonyKernel;
use Psr\Container\ContainerInterface;

class FakeSymfonyKernelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): FakeSymfonyKernel
    {
        $debug = $container->get('config')['debug'];
        return new FakeSymfonyKernel($debug ? 'dev' : 'prod', $debug);
    }
}