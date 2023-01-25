<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('luckyseven_tags');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('tag_entity')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
