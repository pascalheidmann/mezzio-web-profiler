<?php

use Reinfi\DependencyInjection\Factory\AutoWiringFactory;

return [
    'dependencies' => [
        'aliases' => [
            \Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface::class => \Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory::class,
            \Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface::class => \Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory::class,
            \Symfony\Component\Routing\Generator\UrlGeneratorInterface::class => \Profiler\Service\UrlGenerator::class,
            \Symfony\Component\HttpKernel\Profiler\ProfilerStorageInterface::class => Symfony\Component\HttpKernel\Profiler\FileProfilerStorage::class,
            \Symfony\Component\HttpKernel\KernelInterface::class => \Profiler\Service\FakeSymfonyKernel::class,
        ],
        'invokables' => [
            \Symfony\Bundle\WebProfilerBundle\Csp\NonceGenerator::class => \Symfony\Bundle\WebProfilerBundle\Csp\NonceGenerator::class,
            \Symfony\Component\VarDumper\Dumper\HtmlDumper::class => \Symfony\Component\VarDumper\Dumper\HtmlDumper::class,
        ],
        'factories' => [
            \Profiler\ProfilerPipeline::class => \Profiler\Factory\ProfilerPipelineFactory::class,
            \Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener::class => AutoWiringFactory::class,
            \Profiler\Handler\ToolbarHandler::class => AutoWiringFactory::class,
            \Profiler\Handler\PanelHandler::class => AutoWiringFactory::class,
            \Profiler\Handler\RouterHandler::class => AutoWiringFactory::class,
            \Profiler\Handler\PhpInfoHandler::class => AutoWiringFactory::class,
            \Profiler\Handler\SearchResultsHandler::class => AutoWiringFactory::class,
            \Profiler\Handler\SearchHandler::class => AutoWiringFactory::class,
            \Profiler\Handler\SearchBarHandler::class => AutoWiringFactory::class,
            \Profiler\Handler\XdebugHandler::class => AutoWiringFactory::class,
            \Profiler\Service\RequestRendererService::class => AutoWiringFactory::class,
            \Profiler\Twig\ControllerExtension::class => AutoWiringFactory::class,
            \Profiler\Service\UrlGenerator::class => AutoWiringFactory::class,

            \Profiler\Service\FakeSymfonyKernel::class => \Profiler\Factory\FakeSymfonyKernelFactory::class,

            \Symfony\Component\HttpKernel\Debug\FileLinkFormatter::class => \Profiler\Factory\FileLinkFormatterFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\TimeDataCollector::class => \Profiler\Factory\TimeDataCollectorFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\MemoryDataCollector::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\RouterDataCollector::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\RequestDataCollector::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\ExceptionDataCollector::class => AutoWiringFactory::class,
            \Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector::class => AutoWiringFactory::class,
            \Symfony\Bridge\Twig\DataCollector\TwigDataCollector::class => AutoWiringFactory::class,
            \Twig\Profiler\Profile::class => AutoWiringFactory::class,

            \Symfony\Bridge\Twig\Extension\CodeExtension::class => \Profiler\Factory\TwigCodeExtensionFactory::class,
            \Symfony\Component\HttpFoundation\RequestStack::class => \Profiler\Factory\RequestStackFactory::class,

            \Symfony\Component\HttpKernel\Profiler\FileProfilerStorage::class => \Profiler\Factory\FileProviderStorageFactory::class,
            \Symfony\Bundle\WebProfilerBundle\Twig\WebProfilerExtension::class => AutoWiringFactory::class,
            \Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController::class => \Profiler\Factory\ProfileControllerFactory::class,
            \Symfony\Bundle\WebProfilerBundle\Controller\RouterController::class => AutoWiringFactory::class,
            \Symfony\Bundle\WebProfilerBundle\Csp\ContentSecurityPolicyHandler::class => AutoWiringFactory::class,
            \Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory::class => AutoWiringFactory::class,
            \Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory::class => AutoWiringFactory::class,
            \Symfony\Component\Routing\Generator\UrlGenerator::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\DataCollector\DumpDataCollector::class => \Profiler\Factory\DumpDataCollectorFactory::class,
            \Symfony\Component\Routing\RouteCollection::class => AutoWiringFactory::class,
            \Symfony\Component\Routing\RequestContext::class => AutoWiringFactory::class,
            \Symfony\Component\HttpKernel\Profiler\Profiler::class => \Profiler\Factory\ProfilerFactory::class,
        ],
    ]
];
