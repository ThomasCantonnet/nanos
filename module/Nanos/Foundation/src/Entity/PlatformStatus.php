<?php

namespace Nanos\Foundation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PlatformStatus
 *
 * @package Nanos\Foundation\Entity
 *
 * @ORM\Entity(repositoryClass="Nanos\Foundation\Repository\PlatformStatusRepository")
 * @ORM\Table(name="nanos_platform_status")
 */
class PlatformStatus
{
    const STATUS_DELIVERING = 'delivering';

    const STATUS_ENDED = 'ended';

    const STATUS_SCHEDULED = 'scheduled';

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
    private $code;

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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return void
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }
}
