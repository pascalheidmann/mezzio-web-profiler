<?php

namespace Profiler\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;

class XdebugHandler implements RequestHandlerInterface
{
    public function __construct(
        private ProfilerController $profilerController,
        private HttpMessageFactoryInterface $psrHttpFactory
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->profilerController->xdebugAction();
        $psrResponse = $this->psrHttpFactory->createResponse($response);

        $psrResponse->getBody()->rewind();

        return $psrResponse;
    }
}
