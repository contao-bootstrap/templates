<?php

/**
 * Contao Bootstrap templates.
 *
 * @package    contao-bootstrap
 * @subpackage Templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2018 netzmacht David Molineus. All rights reserved.
 * @license    https://github.com/contao-bootstrap/templates/blob/master/LICENSE LGPL 3.0-or-later
 * @filesource
 */

declare(strict_types=1);

namespace ContaoBootstrap\Templates\DependencyInjection;

use function in_array;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class ContaoBootstrapTemplatesExtension
 *
 * @package ContaoBootstrap\Templates\DependencyInjection
 */
final class ContaoBootstrapTemplatesExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.xml');
        $loader->load('listener.xml');

        $modules = (array) $container->getParameter('netzmacht.contao_form_designer.form_designer.modules');
        if (!in_array('subscribe', $modules, true)) {
            $modules[] = 'subscribe';
            $container->setParameter('netzmacht.contao_form_designer.form_designer.modules', $modules);
        }
    }
}
