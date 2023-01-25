<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Bundle\MakerBundle\DependencyInjection\Configuration;

class LuckysevenTagsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $containerBuilder)
    {
        $loader = new YamlFileLoader(
            $containerBuilder,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yaml');

        $containerBuilder->setParameter('luckyseven_tags.tag_entity', $configs[0]['tag_entity']);
    }
}
