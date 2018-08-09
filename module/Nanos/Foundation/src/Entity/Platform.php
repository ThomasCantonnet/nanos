<?php

namespace Nanos\Foundation\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;

/**
 * Class Platform
 *
 * @package Nanos\Foundation\Entity
 *
 * @ORM\Entity(repositoryClass="Nanos\Foundation\Repository\PlatformRepository")
 * @ORM\Table(name="nanos_platform")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap(Platform::TYPES)
 *
 * @Serialize\Discriminator(field="type", map=Platform::TYPES)
 * @Serialize\AccessType("public_method")
 */
abstract class Platform
{
    const FACEBOOK_PLATFORM_TYPE = 'facebook';

    const ADWORDS_PLATFORM_TYPE = 'google';

    const INSTAGRAM_PLATFORM_TYPE = 'instagram';

    const TYPES = [
        self::FACEBOOK_PLATFORM_TYPE  => FacebookPlatform::class,
        self::ADWORDS_PLATFORM_TYPE   => AdwordsPlatform::class,
        self::INSTAGRAM_PLATFORM_TYPE => InstagramPlatform::class,
    ];

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var PlatformStatus
     *
     * @ORM\ManyToOne(targetEntity="PlatformStatus", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $totalBudget;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $remainingBudget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var TargetAudience
     *
     * @ORM\ManyToOne(targetEntity="TargetAudience", cascade={"persist"})
     */
    private $targetAudience;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $creatives;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $insights;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return PlatformStatus|null
     */
    public function getStatus(): ?PlatformStatus
    {
        return $this->status;
    }

    /**
     * @param PlatformStatus $status
     *
     * @return void
     */
    public function setStatus(PlatformStatus $status)
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getTotalBudget(): ?int
    {
        return $this->totalBudget;
    }

    /**
     * @param int $totalBudget
     *
     * @return void
     */
    public function setTotalBudget(int $totalBudget)
    {
        $this->totalBudget = $totalBudget;
    }

    /**
     * @return int|null
     */
    public function getRemainingBudget(): ?int
    {
        return $this->remainingBudget;
    }

    /**
     * @param int $remainingBudget
     *
     * @return void
     */
    public function setRemainingBudget(int $remainingBudget)
    {
        $this->remainingBudget = $remainingBudget;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     *
     * @return void
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     *
     * @return void
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return TargetAudience|null
     */
    public function getTargetAudience(): ?TargetAudience
    {
        return $this->targetAudience;
    }

    /**
     * @param TargetAudience $targetAudience
     *
     * @return void
     */
    public function setTargetAudience(TargetAudience $targetAudience)
    {
        $this->targetAudience = $targetAudience;
    }

    /**
     * @return array|null
     */
    public function getCreatives(): ?array
    {
        return $this->creatives;
    }

    /**
     * @param array $creatives
     *
     * @return void
     */
    public function setCreatives(array $creatives)
    {
        $this->creatives = $creatives;
    }

    /**
     * @return array|null
     */
    public function getInsights(): ?array
    {
        return $this->insights;
    }

    /**
     * @param array $insights
     *
     * @return void
     */
    public function setInsights(array $insights)
    {
        $this->insights = $insights;
    }
}
