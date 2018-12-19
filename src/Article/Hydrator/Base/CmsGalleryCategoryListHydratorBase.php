<?php

namespace Article\Hydrator\Base;

class CmsGalleryCategoryListHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_project' => $object->getIdProject(),
			'name' => $object->getName(),
			'slug' => $object->getSlug(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdProject(!empty($data['id_project']) ? $data['id_project'] : null)
			->setName(!empty($data['name']) ? $data['name'] : null)
			->setSlug(!empty($data['slug']) ? $data['slug'] : null)
		;
        return $object;
    }
}