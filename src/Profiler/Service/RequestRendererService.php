<?php

namespace Profiler\Service;

use Fig\Http\Message\RequestMethodInterface;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\Router\RouterInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

class RequestRendererService
{
    private RouterInterface $router;
    private NotFoundHandler $notFoundHandler;
    private ServerRequestFactoryInterface $serverRequestFactory;

    public function __construct(
        ServerRequestFactoryInterface $serverRequestFactory,
        RouterInterface               $router,
        NotFoundHandler               $notFoundHandler
    )
    {
        $this->serverRequestFactory = $serverRequestFactory;
        $this->router = $router;
        $this->notFoundHandler = $notFoundHandler;
    }

    public function renderFragment(ControllerReference $controllerReference): string
    {
        $uri = $this->router->generateUri($controllerReference->controller, $controllerReference->attributes, ['query_params' => $controllerReference->query]);

        $request = $this->serverRequestFactory->createServerRequest(RequestMethodInterface::METHOD_GET, $uri);
        $routeResult = $this->router->match($request);
        $response = $routeResult->process($request, $this->notFoundHandler);

        return $response->getBody()->getContents();
    }
}