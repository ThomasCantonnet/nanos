<?php

namespace Nanos\Campaign\Cli\Factory;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Nanos\Campaign\Cli\CliImportController;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CliImportControllerFactory
 *
 * @package Nanos\Campaign\Cli\Factory
 */
class CliImportControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return CliImportController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): CliImportController
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return new CliImportController($entityManager);
    }
}
