<?php

namespace Article\Hydrator\Base;

class CmsNewsTypeHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'name' => $object->getName(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setName(!empty($data['name']) ? $data['name'] : null)
		;
        return $object;
    }
}