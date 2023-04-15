<?php

declare(strict_types=1);

namespace App;

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        $config = new ConfigAggregator([
            new PhpFileProvider(__DIR__ . '/config/*.php')
        ]);
        return $config->getMergedConfig();
    }
}
