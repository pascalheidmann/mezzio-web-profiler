<?php

namespace Profiler\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\WebProfilerBundle\Controller\RouterController;

class RouterHandler implements RequestHandlerInterface
{
    public function __construct(
        private RouterController $routerController,
        private HttpMessageFactoryInterface $psrHttpFactory
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->psrHttpFactory->createResponse($this->routerController->panelAction($request->getAttribute('token')));
    }
}
