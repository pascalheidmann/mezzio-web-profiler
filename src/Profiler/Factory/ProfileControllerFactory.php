<?php

namespace Profiler\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Profiler\ConfigProvider;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\DataCollector\TemplateAwareDataCollectorInterface;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;
use Symfony\Bundle\WebProfilerBundle\Csp\ContentSecurityPolicyHandler;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ProfileControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ProfilerController
    {
        $dataCollectors = $container->get('config')[ConfigProvider::class]['data_collector'];
        $templates = $this->getTemplates($container, $dataCollectors);

        return new ProfilerController(
            $container->get(UrlGeneratorInterface::class),
            $container->get(Profiler::class),
            $container->get(Environment::class),
            $templates,
            $container->get(ContentSecurityPolicyHandler::class)
        );
    }

    private function getTemplates(ContainerInterface $container, array $dataCollectors): array
    {
        $collectors = new \SplPriorityQueue();
        $order = \PHP_INT_MAX;
        foreach ($dataCollectors as $id => $attributes) {
            if (is_string($attributes)) {
                $id = $attributes;
                $attributes = [];
            }

            $priority = $attributes['priority'] ?? 0;
            $template = null;

            $collectorClass = $container->get($id);
            $isTemplateAware = is_subclass_of($collectorClass, TemplateAwareDataCollectorInterface::class);

            if (isset($attributes['template']) || $isTemplateAware) {
                $idForTemplate = $attributes['id'] ?? $collectorClass;
                if (!$idForTemplate) {
                    throw new InvalidArgumentException(sprintf('Data collector service "%s" must have an id attribute in order to specify a template.', $id));
                }
                $template = [$idForTemplate, $attributes['template'] ?? $collectorClass::getTemplate()];
            }

            $collectors->insert([$id, $template], [$priority, --$order]);
        }

        $templates = [];
        foreach ($collectors as $collector) {
            $templates[$collector[0]] = $collector[1];
        }
        return $templates;
    }
}