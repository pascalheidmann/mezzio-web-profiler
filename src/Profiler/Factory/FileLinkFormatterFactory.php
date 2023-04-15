<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpKernel\Debug\FileLinkFormatter;

class FileLinkFormatterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): FileLinkFormatter
    {
        return new FileLinkFormatter(null, null, null, '/_profiler/open?file=%%f&line=%%l#line%%l');
    }
}