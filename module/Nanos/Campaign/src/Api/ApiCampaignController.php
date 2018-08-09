<?php
namespace Nanos\Campaign\Api;

use JMS\Serializer\SerializationContext;
use Nanos\Foundation\Entity\Campaign;
use Nanos\Foundation\Repository\CampaignRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 * Class ApiCampaignController
 *
 * @package Nanos\Home\Controller
 *
 * @method \Nanos\Foundation\Service\SerializerService serializer
 */
class ApiCampaignController extends AbstractActionController
{
    /**
     * @var CampaignRepository
     */
    private $campaignRepository;

    /**
     * IndexController constructor.
     *
     * @param CampaignRepository $campaignRepository
     */
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * @return JsonModel
     */
    public function listAction(): JsonModel
    {
        $campaigns = $this->campaignRepository->findAll();

        return new JsonModel([
            'campaigns' => $this->serializer()->serialize($campaigns)
        ]);
    }

    /**
     * @return JsonModel
     */
    public function viewAction(): JsonModel
    {
        $id = $this->params()->fromRoute('id');

        /** @var Campaign $campaign */
        if (!$campaign = $this->campaignRepository->findOneById($id)) {
            throw new \Exception('Campaign not found.');
        }

        return new JsonModel([
            'campaign' => $this->serializer()->serialize($campaign)
        ]);
    }
}
