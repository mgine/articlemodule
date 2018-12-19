<?php

namespace Article\Hydrator;

class CmsGalleryGroupHydrator extends \Article\Hydrator\Base\CmsGalleryGroupHydratorBase
{
	public function extract($object)
	{

		return array_merge( parent::extract($object), array(


		));
    }
	public function hydrate(array $data, $object)
	{

		parent::hydrate($data, $object);


		
        return $object;
    }
}