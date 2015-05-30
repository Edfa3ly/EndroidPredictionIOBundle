<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\PredictionIOBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Endroid\Bundle\PredictionIOBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('endroid_prediction_io');

        $rootNode
            ->children()
                ->arrayNode('eventServer')
                    ->children()
                        ->scalarNode('url')
                            ->defaultValue('http://localhost:7070')
                            ->isRequired()
                        ->end()
                        ->scalarNode('timeout')
                            ->defaultValue(0)
                        ->end()
                        ->scalarNode('connectTimeout')
                            ->defaultValue(5)
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('apps')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('app')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('key')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->arrayNode('engines')
                                ->isRequired()
                                ->requiresAtLeastOneElement()
                                ->useAttributeAsKey('engine')
                                    ->prototype('array')
                                        ->children()
                                            ->scalarNode('url')
                                                ->defaultValue('http://localhost:8000')
                                            ->end()
                                            ->scalarNode('timeout')
                                                ->defaultValue(0)
                                            ->end()
                                            ->scalarNode('connectTimeout')
                                                ->defaultValue(5)
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}