<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Profiler\ProfilerPipeline;
use Psr\Container\ContainerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Stopwatch\Stopwatch;

class ProfilerPipelineFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ProfilerPipeline
    {
        $stopwatch = $container->has(Stopwatch::class) ? $container->get(Stopwatch::class) : null;
        return new ProfilerPipeline(
            $container->get(Profiler::class),
            $container->get(WebDebugToolbarListener::class),
            $container->get(HttpFoundationFactoryInterface::class),
            $container->get(HttpMessageFactoryInterface::class),
            $stopwatch,
            '#^/_wdt/|^/_profiler/#'
        );
    }
}