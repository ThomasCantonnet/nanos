<?php

namespace Nanos\Foundation\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Campaign
 *
 * @package Nanos\Foundation\Entity
 *
 * @ORM\Entity(repositoryClass="Nanos\Foundation\Repository\CampaignRepository")
 * @ORM\Table(name="nanos_campaign")
 */
class Campaign
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $goal;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $totalBudget;

    /**
     * @var CampaignStatus
     *
     * @ORM\ManyToOne(targetEntity="CampaignStatus", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @var Platform[]
     *
     * @ORM\ManyToMany(targetEntity="Platform", cascade={"persist"})
     * @ORM\JoinTable(name="nanos_campaign_platform")
     */
    private $platforms;

    /**
     * Campaign constructor.
     */
    public function __construct()
    {
        $this->platforms = new ArrayCollection();
    }

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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getGoal(): ?string
    {
        return $this->goal;
    }

    /**
     * @param string $goal
     *
     * @return void
     */
    public function setGoal(string $goal)
    {
        $this->goal = $goal;
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
     * @return CampaignStatus|null
     */
    public function getStatus(): ?CampaignStatus
    {
        return $this->status;
    }

    /**
     * @param CampaignStatus $status
     *
     * @return void
     */
    public function setStatus(CampaignStatus $status)
    {
        $this->status = $status;
    }

    /**
     * @return Platform[]|Collection
     */
    public function getPlatforms(): ?array
    {
        return $this->platforms;
    }

    /**
     * @param Platform[] $platforms
     *
     * @return void
     */
    public function setPlatforms(array $platforms)
    {
        $this->platforms = $platforms;
    }
}
