<?php

namespace Article\Hydrator;

class CmsNewsTagsHydrator extends \Article\Hydrator\Base\CmsNewsTagsHydratorBase
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