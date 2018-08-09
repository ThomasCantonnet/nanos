<?php

namespace Nanos\Foundation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TargetAudience
 *
 * @package Nanos\Foundation\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="nanos_target_audience")
 */
class TargetAudience
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
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $languages;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $genders;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $ageRange;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $locations;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $interests;

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
     * @return array|null
     */
    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     *
     * @return void
     */
    public function setLanguages(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return array|null
     */
    public function getGenders(): ?array
    {
        return $this->genders;
    }

    /**
     * @param array $genders
     *
     * @return void
     */
    public function setGenders(array $genders)
    {
        $this->genders = $genders;
    }

    /**
     * @return array|null
     */
    public function getAgeRange(): ?array
    {
        return $this->ageRange;
    }

    /**
     * @param array $ageRange
     *
     * @return void
     */
    public function setAgeRange(array $ageRange)
    {
        $this->ageRange = $ageRange;
    }

    /**
     * @return array|null
     */
    public function getLocations(): ?array
    {
        return $this->locations;
    }

    /**
     * @param array $locations
     *
     * @return void
     */
    public function setLocations(array $locations)
    {
        $this->locations = $locations;
    }

    /**
     * @return array|null
     */
    public function getInterests(): ?array
    {
        return $this->interests;
    }

    /**
     * @param array $interests
     *
     * @return void
     */
    public function setInterests(array $interests)
    {
        $this->interests = $interests;
    }
}
