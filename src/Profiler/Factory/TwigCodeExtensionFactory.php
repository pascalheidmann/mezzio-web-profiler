<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bridge\Twig\Extension\CodeExtension;

class TwigCodeExtensionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): CodeExtension
    {
        return new CodeExtension('', __DIR__ . '/../../../', 'UTF-8');
    }
}