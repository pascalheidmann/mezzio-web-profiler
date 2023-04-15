<?php

namespace Profiler\Twig;

use Profiler\Service\RequestRendererService;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ControllerExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('render', [RequestRendererService::class, 'renderFragment'], ['is_safe' => ['html']]),
            new TwigFunction('controller', static::class.'::controller'),
        ];
    }

    public static function controller(string $controller, array $attributes = [], array $query = []): ControllerReference
    {
        return new ControllerReference($controller, $attributes, $query);
    }
}