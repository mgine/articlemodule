<?php

namespace Article\Hydrator\Base;

class CmsGalleryHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_pliki_konfiguracja_rozmiary' => $object->getIdPlikiKonfiguracjaRozmiary(),
			'keep_proportions' => $object->getKeepProportions(),
			'id_group' => $object->getIdGroup(),
			'name' => $object->getName(),
			'description' => $object->getDescription(),
			'short_description' => $object->getShortDescription(),
			'publication_date' => $object->getPublicationDate(),
			'add_date' => $object->getAddDate(),
			'is_active' => $object->getIsActive(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdPlikiKonfiguracjaRozmiary(!empty($data['id_pliki_konfiguracja_rozmiary']) ? $data['id_pliki_konfiguracja_rozmiary'] : null)
			->setKeepProportions(!empty($data['keep_proportions']) ? $data['keep_proportions'] : null)
			->setIdGroup(!empty($data['id_group']) ? $data['id_group'] : null)
			->setName(!empty($data['name']) ? $data['name'] : null)
			->setDescription(!empty($data['description']) ? $data['description'] : null)
			->setShortDescription(!empty($data['short_description']) ? $data['short_description'] : null)
			->setPublicationDate(!empty($data['publication_date']) ? $data['publication_date'] : null)
			->setAddDate(!empty($data['add_date']) ? $data['add_date'] : null)
			->setIsActive(!empty($data['is_active']) ? $data['is_active'] : null)
		;
        return $object;
    }
}