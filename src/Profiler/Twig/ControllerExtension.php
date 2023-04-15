<?php

namespace Profiler\Twig;

use Symfony\Bridge\Twig\Extension\HttpKernelRuntime;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ControllerExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('render', [HttpKernelRuntime::class, 'renderFragment'], ['is_safe' => ['html']]),
            //new TwigFunction('render_*', [HttpKernelRuntime::class, 'renderFragmentStrategy'], ['is_safe' => ['html']]),
            //new TwigFunction('fragment_uri', [HttpKernelRuntime::class, 'generateFragmentUri']),
            new TwigFunction('controller', static::class.'::controller'),
        ];
    }

    public static function controller(string $controller, array $attributes = [], array $query = []): ControllerReference
    {
        return new ControllerReference($controller, $attributes, $query);
    }
}