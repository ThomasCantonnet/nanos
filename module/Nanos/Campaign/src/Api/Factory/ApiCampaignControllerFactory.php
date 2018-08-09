<?php
namespace Nanos\Campaign\Api\Factory;

use Doctrine\ORM\EntityManager;
use Nanos\Campaign\Api\ApiCampaignController;
use Interop\Container\ContainerInterface;
use Nanos\Foundation\Entity\Campaign;
use Nanos\Foundation\Repository\CampaignRepository;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ApiCampaignControllerFactory
 *
 * @package Nanos\Home\Controller\Factory
 */
class ApiCampaignControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return ApiCampaignController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ApiCampaignController
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        /** @var CampaignRepository $campaignRepository */
        $campaignRepository = $entityManager->getRepository(Campaign::class);

        return new ApiCampaignController($campaignRepository);
    }
}
