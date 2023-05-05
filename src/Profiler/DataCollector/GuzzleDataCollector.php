<?php

declare(strict_types=1);

namespace Profiler\DataCollector;

use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class GuzzleDataCollector extends DataCollector
{
    public function __construct(protected array $loggers = [])
    {
        $this->reset();
    }

    public function collect(Request $request, Response $response, \Throwable $exception = null): void
    {
        $messages = [];
        foreach ($this->loggers as $logger) {
            $messages = array_merge($messages, $logger->getMessages());
        }

        $requestId = $request->getUri();

        // clear log to have only messages related to Symfony request context
        foreach ($this->loggers as $logger) {
            $logger->clear();
        }
    }

    public function getName(): string
    {
        return 'guzzle';
    }

    public function reset(): void
    {
        $this->data = [
            'requests' => [],
            'logs' => [],
            'callCount' => 0,
            'requestCount' => 0,
            'totalTime' => 0,
        ];
    }

    public function getLogs(): array
    {
        return array_key_exists('logs', $this->data) ? $this->data['logs'] : [];
    }

    public function getMessages(): array
    {
        $messages = [];

        foreach ($this->getLogs() as $log) {
            foreach ($log->getMessages() as $message) {
                $messages[] = $message;
            }
        }

        return $messages;
    }

    public function getCallCount(): int
    {
        return count($this->getMessages());
    }

    public function getRequestCount(): int
    {
        return $this->data['requestCount'] ?? 0;
    }

    public function getTotalTime(): float
    {
        return $this->data['totalTime'];
    }

    public function addTotalTime(float $time): void
    {
        $this->data['totalTime'] += $time;
    }

    public function addRequest(RequestInterface $request, ?string $requestId = null): void
    {
        $requestId ??= uniqid(__CLASS__);
        $this->data['requests'][$requestId] = $request;
        $this->data['requestCount']++;
    }

    public function getRequests(): iterable {
        yield from $this->data['requests'];
    }
}
