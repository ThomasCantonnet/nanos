<?php
namespace Nanos\Foundation\Service;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer as JMSSerializer;
use Zend\Json\Json;

/**
 * Class Serializer
 *
 * @package Nanos\Foundation\Service
 */
class SerializerService
{
    /**
     * @var JMSSerializer
     */
    private $delegate;

    /**
     * Serializer constructor.
     *
     * @param JMSSerializer $delegate
     */
    public function __construct(JMSSerializer $delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * @param mixed                     $data
     * @param SerializationContext|null $context
     *
     * @return array|null
     */
    public function serialize($data, SerializationContext $context = null) : ?array
    {
        $json = $this->delegate->serialize($data, 'json', $context);

        return Json::decode($json, Json::TYPE_ARRAY);
    }
}
