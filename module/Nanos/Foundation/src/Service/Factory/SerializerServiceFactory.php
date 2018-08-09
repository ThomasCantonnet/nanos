<?php

namespace Nanos\Foundation\Service\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\JsonSerializationVisitor;
use Nanos\Foundation\Service\ArrayCollectionHandler;
use Nanos\Foundation\Service\SerializerService;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\Naming\CamelCaseNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SerializerFactory
 *
 * @package Nanos\Foundation\Factory\Service
 */
class SerializerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param mixed              $requestedName
     * @param null|array         $options
     *
     * @return SerializerService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : SerializerService
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        $reader = new CachedReader(
            new AnnotationReader(),
            $entityManager->getConfiguration()->getMetadataCacheImpl()
        );

        $propertyNamingStrategy = new SerializedNameAnnotationStrategy(new CamelCaseNamingStrategy());

        $delegate = SerializerBuilder::create()
            ->addDefaultHandlers()
            ->configureHandlers(function (HandlerRegistryInterface $handlerRegistry) {
                // Override the default handler for Doctrine Collections
                // This handler use the Collection::getValues() instead of Collection::toArray()
                // So if an element is removed, the collection keys are not changed and the collection is not serialized as an object
                $handlerRegistry->registerSubscribingHandler(new ArrayCollectionHandler());
            })
            ->setAnnotationReader($reader)
            ->setPropertyNamingStrategy($propertyNamingStrategy)
            ->setSerializationVisitor('json', new JsonSerializationVisitor($propertyNamingStrategy))
            ->addDefaultDeserializationVisitors()
            ->build();

        return new SerializerService($delegate);
    }
}
