<?php

namespace Article\Hydrator;

class CmsNewsUzytkownicyHydrator extends \Article\Hydrator\Base\CmsNewsUzytkownicyHydratorBase
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