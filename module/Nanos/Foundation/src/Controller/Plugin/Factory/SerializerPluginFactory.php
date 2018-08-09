<?php

namespace Nanos\Foundation\Factory\Controller\Plugin;

use Nanos\Foundation\Controller\Plugin\SerializerPlugin;
use Nanos\Foundation\Service\SerializerService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SerializerPluginFactory
 *
 * @package Nanos\Foundation\Factory\Controller\Plugin
 */
class SerializerPluginFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param mixed              $requestedName
     * @param null|array         $options
     *
     * @return SerializerPlugin
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : SerializerPlugin
    {
        /** @var SerializerService $serializer */
        $serializer = $container->get(SerializerService::class);

        return new SerializerPlugin($serializer);
    }
}
