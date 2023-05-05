<?php

namespace Profiler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Stopwatch\Stopwatch;

class ProfilerPipeline implements MiddlewareInterface
{
    public function __construct(
        private Profiler $profiler,
        private WebDebugToolbarListener $debugToolbarListener,
        private HttpFoundationFactoryInterface $httpFoundationFactory,
        private HttpMessageFactoryInterface $psrHttpFactory,
        private ?Stopwatch $stopwatch = null,
        private string $pathToIgnore = '#^/_wdt/|^/_profiler/#'
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (preg_match($this->pathToIgnore, $request->getUri()->getPath()) === 1) {
            return $handler->handle($request);
        }

        $stopWatchToken = substr(hash('sha256', uniqid(random_int(0, mt_getrandmax()), true)), 0, 6);
        if ($this->stopwatch !== null) {
            $request = $request->withAttribute('_stopwatch_token', $stopWatchToken);
            $this->stopwatch->openSection();
        }

        $response = $handler->handle($request);

        $symfonyResponse = $this->httpFoundationFactory->createResponse($response);
        $symfonyRequest = $this->httpFoundationFactory->createRequest($request);

        $dummyHttpKernel = new class() implements HttpKernelInterface {
            public function handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): Response
            {
                // TODO: Implement handle() method.
            }
        };

        if ($this->stopwatch !== null) {
            $this->stopwatch->stopSection($stopWatchToken);
        }
        $profile = $this->profiler->collect($symfonyRequest, $symfonyResponse);

        $this->profiler->saveProfile($profile);
        $this->debugToolbarListener->onKernelResponse(new ResponseEvent($dummyHttpKernel, $symfonyRequest, HttpKernelInterface::MAIN_REQUEST, $symfonyResponse));

        return $this->psrHttpFactory->createResponse($symfonyResponse);
    }
}
