<?php

namespace Profiler\Service;

use Fig\Http\Message\RequestMethodInterface;
use Mezzio\Router\RouterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

class RequestRendererService
{
    public function __construct(
        private ServerRequestFactoryInterface $serverRequestFactory,
        private RouterInterface $router
    ) {
    }

    public function renderFragment(ControllerReference $controllerReference): string
    {
        $uri = $this->router->generateUri($controllerReference->controller, $controllerReference->attributes, ['query_params' => $controllerReference->query]);

        $request = $this->serverRequestFactory->createServerRequest(RequestMethodInterface::METHOD_GET, $uri);
        $routeResult = $this->router->match($request);
        $response = $routeResult->process($request, new class () implements RequestHandlerInterface {
            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                throw new \Exception('Unsupported!');
            }
        });

        return $response->getBody()->getContents();
    }
}
