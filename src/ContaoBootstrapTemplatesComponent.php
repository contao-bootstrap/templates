<?php

declare(strict_types=1);

namespace ContaoBootstrap\Templates;

use ContaoBootstrap\Core\ContaoBootstrapComponent;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ContaoBootstrapTemplatesComponent implements ContaoBootstrapComponent
{
    public function addBootstrapConfiguration(ArrayNodeDefinition $builder): void
    {
        $builder
            ->children()
                ->arrayNode('templates')
                    ->info('Templates component configuration')
                    ->children()
                        ->booleanNode('auto_mapping')
                            ->info('Enable or disable templates auto mapping')
                            ->defaultValue(true)
                        ->end()
                        ->arrayNode('mapping')
                            ->children()
                                ->arrayNode('mandatory')
                                    ->info('Mandatory templates mapping')
                                    ->scalarPrototype()->end()
                                ->end()
                                ->arrayNode('optional')
                                    ->info('Optional templates mapping')
                                    ->scalarPrototype()->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('gravatar')
                            ->children()
                                ->scalarNode('default')
                                    ->info('Default gravatar image')
                                    ->defaultValue('mp')
                                ->end()
                                ->scalarNode('size')
                                    ->info('Default gravatar size')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('margin')
                            ->children()
                                ->scalarNode('default')
                                    ->info('Default margin size')
                                    ->defaultValue(3)
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
