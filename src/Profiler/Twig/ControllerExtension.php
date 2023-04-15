<?php

namespace Profiler\Twig;

use Profiler\Service\RequestRendererService;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ControllerExtension extends AbstractExtension
{
    private RequestRendererService $renderer;

    public function __construct(RequestRendererService $renderer)
    {
        $this->renderer = $renderer;
    }

    public static function controller(string $controller, array $attributes = [], array $query = []): ControllerReference
    {
        return new ControllerReference($controller, $attributes, $query);
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('render', [$this, 'renderFragment'], ['is_safe' => ['html']]),
            new TwigFunction('controller', static::class . '::controller'),
        ];
    }

    public function renderFragment(ControllerReference $controllerReference): string
    {
        return $this->renderer->renderFragment($controllerReference);
    }
}