<?php

namespace Nanos\Foundation\Controller\Plugin;

use Nanos\Foundation\Service\SerializerService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Class SerializerPlugin
 *
 * @package Nanos\Foundation\Controller\Plugin
 */
class SerializerPlugin extends AbstractPlugin
{
    /**
     * @var SerializerService
     */
    private $serializer;

    /**
     * SerializerPlugin constructor.
     *
     * @param SerializerService $serializer
     */
    public function __construct(SerializerService $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return SerializerService
     */
    public function __invoke() : SerializerService
    {
        return $this->serializer;
    }
}
