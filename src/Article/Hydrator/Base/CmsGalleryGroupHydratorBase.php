<?php

namespace Article\Hydrator\Base;

class CmsGalleryGroupHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_site' => $object->getIdSite(),
			'name' => $object->getName(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdSite(!empty($data['id_site']) ? $data['id_site'] : null)
			->setName(!empty($data['name']) ? $data['name'] : null)
		;
        return $object;
    }
}