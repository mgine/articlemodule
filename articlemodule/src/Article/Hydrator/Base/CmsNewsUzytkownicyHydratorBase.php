<?php

namespace Article\Hydrator\Base;

class CmsNewsUzytkownicyHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_cms_news' => $object->getIdCmsNews(),
			'id_uzytkownicy' => $object->getIdUzytkownicy(),
			'describe' => $object->getDescribe(),
			'add_date' => $object->getAddDate(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdCmsNews(!empty($data['id_cms_news']) ? $data['id_cms_news'] : null)
			->setIdUzytkownicy(!empty($data['id_uzytkownicy']) ? $data['id_uzytkownicy'] : null)
			->setDescribe(!empty($data['describe']) ? $data['describe'] : null)
			->setAddDate(!empty($data['add_date']) ? $data['add_date'] : null)
		;
        return $object;
    }
}