<?php

namespace Nanos\Campaign\Cli;

use Doctrine\ORM\EntityManager;
use Nanos\Foundation\Entity\AdwordsPlatform;
use Nanos\Foundation\Entity\Campaign;
use Nanos\Foundation\Entity\CampaignStatus;
use Nanos\Foundation\Entity\FacebookPlatform;
use Nanos\Foundation\Entity\InstagramPlatform;
use Nanos\Foundation\Entity\Platform;
use Nanos\Foundation\Entity\PlatformStatus;
use Nanos\Foundation\Entity\TargetAudience;
use Zend\Mvc\Console\Controller\AbstractConsoleController;

/**
 * Class CliImportController
 *
 * @package Nanos\Campaign\Cli
 */
class CliImportController extends AbstractConsoleController
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function importAction()
    {
        $data = file_get_contents('data/import/campaigns.json');

        $campaigns = json_decode($data, true);

        $campaignStatusRepository = $this->entityManager->getRepository(CampaignStatus::class);
        $platformStatusRepository = $this->entityManager->getRepository(PlatformStatus::class);

        // We should replace this by a proper hydration strategy
        foreach ($campaigns as $campaign) {
            $campaignEntity = new Campaign();
            $campaignEntity->setId($campaign['id']);
            $campaignEntity->setName($campaign['name']);
            $campaignEntity->setGoal($campaign['goal']);
            $campaignEntity->setTotalBudget($campaign['total_budget']);

            if (!$campaignStatus = $campaignStatusRepository->findOneByCode($campaign['status'])) {
                $campaignStatus = new CampaignStatus();
                $campaignStatus->setCode($campaign['status']);

                $this->entityManager->persist($campaignStatus);
                $this->entityManager->flush();
            }

            $campaignEntity->setStatus($campaignStatus);

            $platforms = [];
            foreach ($campaign['platforms'] as $platformType => $platformData) {
                switch ($platformType) {
                    case Platform::FACEBOOK_PLATFORM_TYPE:
                        $platformEntity = new FacebookPlatform();
                        break;

                    case Platform::INSTAGRAM_PLATFORM_TYPE:
                        $platformEntity = new InstagramPlatform();
                        break;

                    case Platform::ADWORDS_PLATFORM_TYPE:
                        $platformEntity = new AdwordsPlatform();
                        break;
                    default:
                        throw new \Exception(sprintf('Platform type "%s" unknown', $platformType));
                }

                if (!$platformStatus = $platformStatusRepository->findOneByCode($platformData['status'])) {
                    $platformStatus = new PlatformStatus();
                    $platformStatus->setCode($platformData['status']);

                    $this->entityManager->persist($platformStatus);
                    $this->entityManager->flush();
                }

                $platformEntity->setStatus($platformStatus);
                $platformEntity->setTotalBudget($platformData['total_budget']);
                $platformEntity->setRemainingBudget($platformData['remaining_budget']);
                $platformEntity->setStartDate(\DateTime::createFromFormat('U', $platformData['start_date']));
                $platformEntity->setEndDate(\DateTime::createFromFormat('U', $platformData['end_date']));

                $targetAudienceEntity = new TargetAudience();
                $targetAudienceEntity->setLanguages($platformData['target_audiance']['languages']);
                $targetAudienceEntity->setGenders($platformData['target_audiance']['genders']);
                $targetAudienceEntity->setAgeRange($platformData['target_audiance']['age_range']);
                $targetAudienceEntity->setLocations($platformData['target_audiance']['locations']);
                $targetAudienceEntity->setInterests($platformData['target_audiance']['interests'] ?? []);

                $platformEntity->setTargetAudience($targetAudienceEntity);
                $platformEntity->setCreatives($platformData['creatives'] ?? []);
                $platformEntity->setInsights($platformData['insights'] ?? []);

                $platforms[] = $platformEntity;
            }

            $campaignEntity->setPlatforms($platforms);

            $this->entityManager->persist($campaignEntity);
            $this->entityManager->flush();
        }
    }
}
