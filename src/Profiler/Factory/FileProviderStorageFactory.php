<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Profiler\ConfigProvider;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpKernel\Profiler\FileProfilerStorage;

class FileProviderStorageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): FileProfilerStorage
    {
        $path = $container->get('config')[ConfigProvider::class]['storagePath'];
        return new FileProfilerStorage('file:' . $path);
    }
}