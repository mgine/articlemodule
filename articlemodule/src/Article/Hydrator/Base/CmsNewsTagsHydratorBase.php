<?php

namespace Article\Hydrator\Base;

class CmsNewsTagsHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_item' => $object->getIdItem(),
			'id_tagu' => $object->getIdTagu(),
			'data_dodania' => $object->getDataDodania(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdItem(!empty($data['id_item']) ? $data['id_item'] : null)
			->setIdTagu(!empty($data['id_tagu']) ? $data['id_tagu'] : null)
			->setDataDodania(!empty($data['data_dodania']) ? $data['data_dodania'] : null)
		;
        return $object;
    }
}