<?php

namespace Article\Hydrator\Base;

class CmsNewsCategoryListHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_site' => $object->getIdSite(),
			'id_pliki_konfiguracja_rozmiary' => $object->getIdPlikiKonfiguracjaRozmiary(),
			'id_parent' => $object->getIdParent(),
			'keep_proportions' => $object->getKeepProportions(),
			'name' => $object->getName(),
			'default' => $object->getDefault(),
			'slug' => $object->getSlug(),
			'id_admini' => $object->getIdAdmini(),
			'assigned_news' => $object->getAssignedNews(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdSite(!empty($data['id_site']) ? $data['id_site'] : null)
			->setIdPlikiKonfiguracjaRozmiary(!empty($data['id_pliki_konfiguracja_rozmiary']) ? $data['id_pliki_konfiguracja_rozmiary'] : null)
			->setIdParent(!empty($data['id_parent']) ? $data['id_parent'] : null)
			->setKeepProportions(!empty($data['keep_proportions']) ? $data['keep_proportions'] : null)
			->setName(!empty($data['name']) ? $data['name'] : null)
			->setDefault(!empty($data['default']) ? $data['default'] : null)
			->setSlug(!empty($data['slug']) ? $data['slug'] : null)
			->setIdAdmini(!empty($data['id_admini']) ? $data['id_admini'] : null)
			->setAssignedNews(!empty($data['assigned_news']) ? $data['assigned_news'] : null)
		;
        return $object;
    }
}