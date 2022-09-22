<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoBootstrap\Core\ContaoBootstrapCoreBundle;
use ContaoBootstrap\Form\ContaoBootstrapFormBundle;
use ContaoBootstrap\Templates\ContaoBootstrapTemplatesBundle;
use Netzmacht\Contao\FormDesigner\NetzmachtContaoFormDesignerBundle;

final class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoBootstrapTemplatesBundle::class)
                ->setLoadAfter(
                    [
                        ContaoBootstrapCoreBundle::class,
                        ContaoBootstrapFormBundle::class,
                        NetzmachtContaoFormDesignerBundle::class,
                    ]
                ),
        ];
    }
}
