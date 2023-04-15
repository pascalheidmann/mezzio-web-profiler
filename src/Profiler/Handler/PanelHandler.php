<?php

namespace Profiler\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;

class PanelHandler implements RequestHandlerInterface
{
    private ProfilerController $profilerController;
    private HttpFoundationFactoryInterface $httpFoundationFactory;
    private HttpMessageFactoryInterface $psrHttpFactory;

    public function __construct(
        ProfilerController             $profilerController,
        HttpFoundationFactoryInterface $httpFoundationFactory,
        HttpMessageFactoryInterface    $psrHttpFactory
    )
    {
        $this->profilerController = $profilerController;
        $this->httpFoundationFactory = $httpFoundationFactory;
        $this->psrHttpFactory = $psrHttpFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // hacky workaround cause symfony and mezzio handle unmatched parameters in url creation different
        if ($request->getAttribute('panel')) {
            $request = $request->withQueryParams(['panel' => $request->getAttribute('panel')] + $request->getQueryParams());
        }
        $symfonyRequest = $this->httpFoundationFactory->createRequest($request);
        $response = $this->profilerController->panelAction($symfonyRequest, $request->getAttribute('token'));
        return $this->psrHttpFactory->createResponse($response);
    }
}