<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

use function in_array;

final class ContaoBootstrapTemplatesExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config'),
        );

        $loader->load('services.xml');
        $loader->load('listener.xml');

        $modules = (array) $container->getParameter('netzmacht.contao_form_designer.form_designer.modules');
        if (in_array('subscribe', $modules, true)) {
            return;
        }

        $modules[] = 'subscribe';
        $container->setParameter('netzmacht.contao_form_designer.form_designer.modules', $modules);
    }
}
