<?php

declare(strict_types=1);

namespace Profiler\Integrations\Guzzle;

use Closure;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\TransferStats;
use Profiler\DataCollector\GuzzleDataCollector;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class ProfilerMiddleware
{
    public function __construct(
        private Stopwatch $stopwatch,
        private GuzzleDataCollector $guzzleDataCollector,
    ) {
    }

    public function __invoke(callable $handler): Closure
    {
        $stopwatch = $this->stopwatch;

        return function (RequestInterface $request, array $options) use ($handler, $stopwatch) {
            $event = $stopwatch->start(
                sprintf('%s %s', $request->getMethod(), $request->getUri()),
                'guzzle_request'
            );

            $options['on_stats'] = $this->getOnStatsCallback(
                $options['on_stats'] ?? null,
                $options['request_id'] ?? null
            );

            $this->guzzleDataCollector->addRequest($request, $options['request_id'] ?? null);
            return $handler($request, $options)->then(
                function ($response) use ($event) {
                    $event->stop();

                    return $response;
                },

                function ($reason) use ($event) {
                    $event->stop();

                    return Create::rejectionFor($reason);
                }
            );
        };
    }

    protected function getOnStatsCallback(?callable $initialOnStats, ?string $requestId) : \Closure
    {
        return function (TransferStats $stats) use ($initialOnStats, $requestId) {
            if (is_callable($initialOnStats)) {
                call_user_func($initialOnStats, $stats);
            }

            $this->guzzleDataCollector->addTotalTime((float)$stats->getTransferTime());
        };
    }
}
