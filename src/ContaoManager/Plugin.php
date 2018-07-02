<?php

/**
 * cotnao-bootstrap-templates.
 *
 * @package    cotnao-bootstrap-templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2018 netzmacht David Molineus. All rights reserved.
 * @license    LGPL-3.0
 * @filesource
 */

declare(strict_types=1);

namespace ContaoBootstrap\Templates\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoBootstrap\Core\ContaoBootstrapCoreBundle;
use ContaoBootstrap\Form\ContaoBootstrapFormBundle;
use ContaoBootstrap\Templates\ContaoBootstrapTemplatesBundle;

/**
 * Contao manager plugin.
 */
final class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoBootstrapTemplatesBundle::class)
                ->setLoadAfter([ContaoBootstrapCoreBundle::class, ContaoBootstrapFormBundle::class])
        ];
    }
}
