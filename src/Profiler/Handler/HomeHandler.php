<?php

namespace Profiler\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;

class HomeHandler implements RequestHandlerInterface
{
    public function __construct(
        private ProfilerController $profilerController,
        private HttpMessageFactoryInterface $psrHttpFactory
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->profilerController->homeAction();
        return $this->psrHttpFactory->createResponse($response);
    }
}
