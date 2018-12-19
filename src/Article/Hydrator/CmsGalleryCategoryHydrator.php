<?php

namespace Article\Hydrator;

class CmsGalleryCategoryHydrator extends \Article\Hydrator\Base\CmsGalleryCategoryHydratorBase
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