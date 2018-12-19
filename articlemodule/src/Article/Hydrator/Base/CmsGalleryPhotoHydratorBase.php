<?php

namespace Article\Hydrator\Base;

class CmsGalleryPhotoHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_gallery' => $object->getIdGallery(),
			'id_admin' => $object->getIdAdmin(),
			'id_file' => $object->getIdFile(),
			'description' => $object->getDescription(),
			'title' => $object->getTitle(),
			'alternative_field' => $object->getAlternativeField(),
			'position' => $object->getPosition(),
			'publication_date' => $object->getPublicationDate(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdGallery(!empty($data['id_gallery']) ? $data['id_gallery'] : null)
			->setIdAdmin(!empty($data['id_admin']) ? $data['id_admin'] : null)
			->setIdFile(!empty($data['id_file']) ? $data['id_file'] : null)
			->setDescription(!empty($data['description']) ? $data['description'] : null)
			->setTitle(!empty($data['title']) ? $data['title'] : null)
			->setAlternativeField(!empty($data['alternative_field']) ? $data['alternative_field'] : null)
			->setPosition(!empty($data['position']) ? $data['position'] : null)
			->setPublicationDate(!empty($data['publication_date']) ? $data['publication_date'] : null)
		;
        return $object;
    }
}