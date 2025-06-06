<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use ContaoBootstrap\Core\ContaoBootstrapCoreBundle;
use ContaoBootstrap\Form\ContaoBootstrapFormBundle;
use ContaoBootstrap\Templates\ContaoBootstrapTemplatesBundle;
use Netzmacht\Contao\FormDesigner\NetzmachtContaoFormDesignerBundle;
use Override;
use Symfony\Component\Config\Loader\LoaderInterface;

final class Plugin implements BundlePluginInterface, ConfigPluginInterface
{
    /**
     * {@inheritDoc}
     */
    #[Override]
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoBootstrapTemplatesBundle::class)
                ->setLoadAfter(
                    [
                        ContaoBootstrapCoreBundle::class,
                        ContaoBootstrapFormBundle::class,
                        NetzmachtContaoFormDesignerBundle::class,
                    ],
                ),
        ];
    }

    /**
     * {@inheritDoc}
     */
    #[Override]
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig): void
    {
        $loader->load(__DIR__ . '/../Resources/config/contao_bootstrap.yaml');
    }
}
