<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestStackFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): RequestStack
    {
        $requestStack = new RequestStack();
        //$requestStack->push($container->get(Request::class));
        return $requestStack;
    }
}