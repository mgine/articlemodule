<?php

namespace Article\Hydrator\Base;

class CmsGalleryPhotoLangsHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_gallery_photo' => $object->getIdGalleryPhoto(),
			'id_lang' => $object->getIdLang(),
			'description' => $object->getDescription(),
			'title' => $object->getTitle(),
			'alternative_field' => $object->getAlternativeField(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdGalleryPhoto(!empty($data['id_gallery_photo']) ? $data['id_gallery_photo'] : null)
			->setIdLang(!empty($data['id_lang']) ? $data['id_lang'] : null)
			->setDescription(!empty($data['description']) ? $data['description'] : null)
			->setTitle(!empty($data['title']) ? $data['title'] : null)
			->setAlternativeField(!empty($data['alternative_field']) ? $data['alternative_field'] : null)
		;
        return $object;
    }
}