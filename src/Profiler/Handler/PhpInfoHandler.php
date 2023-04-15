<?php

namespace Profiler\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;

class PhpInfoHandler implements RequestHandlerInterface
{
    private ProfilerController $profilerController;
    private HttpMessageFactoryInterface $psrHttpFactory;

    public function __construct(
        ProfilerController             $profilerController,
        HttpMessageFactoryInterface    $psrHttpFactory
    )
    {
        $this->profilerController = $profilerController;
        $this->psrHttpFactory = $psrHttpFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->psrHttpFactory->createResponse($this->profilerController->phpinfoAction());
    }
}