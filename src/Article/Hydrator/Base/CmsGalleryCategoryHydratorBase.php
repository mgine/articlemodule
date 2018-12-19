<?php

namespace Article\Hydrator\Base;

class CmsGalleryCategoryHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_cms_gallery_category_list' => $object->getIdCmsGalleryCategoryList(),
			'id_cms_gallery' => $object->getIdCmsGallery(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdCmsGalleryCategoryList(!empty($data['id_cms_gallery_category_list']) ? $data['id_cms_gallery_category_list'] : null)
			->setIdCmsGallery(!empty($data['id_cms_gallery']) ? $data['id_cms_gallery'] : null)
		;
        return $object;
    }
}