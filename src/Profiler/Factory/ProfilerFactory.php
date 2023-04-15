<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Profiler\ConfigProvider;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\HttpKernel\Profiler\ProfilerStorageInterface;

class ProfilerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Profiler
    {
        $profiler = new Profiler(
            $container->get(ProfilerStorageInterface::class),
            $container->get(LoggerInterface::class)
        );

        $dataCollectors = $container->get('config')[ConfigProvider::class]['data_collector'];
        foreach ($dataCollectors as $id => $attributes) {
            if ($attributes instanceof DataCollectorInterface){
                $id = $attributes;
            }
            $profiler->add($container->get($id));
        }

        return $profiler;
    }
}