<?php

namespace Profiler\Service;

use Mezzio\Twig\TwigExtension;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;

class UrlGenerator implements UrlGeneratorInterface
{
    public function __construct(private TwigExtension $twigExtension)
    {
    }

    public function setContext(RequestContext $context)
    {
        // TODO: Implement setContext() method.
    }

    public function getContext(): RequestContext
    {
        // TODO: Implement getContext() method.
    }

    public function generate(string $name, array $parameters = [], int $referenceType = self::ABSOLUTE_PATH): string
    {
        return $this->twigExtension->renderUri($name, $parameters);
    }
}
