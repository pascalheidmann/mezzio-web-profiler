<?php

namespace Profiler\Service;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class FakeSymfonyKernel extends Kernel
{
    public function __construct(string $environment, bool $debug)
    {
        $this->startTime = microtime(true);
        parent::__construct($environment, $debug);
    }

    public function registerBundles()
    {
        // TODO: Implement registerBundles() method.
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // TODO: Implement registerContainerConfiguration() method.
    }
}