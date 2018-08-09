<?php
namespace Nanos\Foundation\Service;

use JMS\Serializer\Context;
use JMS\Serializer\VisitorInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Class ArrayCollectionHandler
 *
 * @package Nanos\Foundation\Service
 */
class ArrayCollectionHandler extends \JMS\Serializer\Handler\ArrayCollectionHandler
{
    /**
     * @param VisitorInterface $visitor
     * @param Collection       $collection
     * @param array            $type
     * @param Context          $context
     *
     * @return mixed
     */
    public function serializeCollection(VisitorInterface $visitor, Collection $collection, array $type, Context $context)
    {
        // We change the base type, and pass through possible parameters.
        $type['name'] = 'array';

        return $visitor->visitArray($collection->getValues(), $type, $context);
    }
}
