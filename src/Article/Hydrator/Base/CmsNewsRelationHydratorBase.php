<?php

namespace Article\Hydrator\Base;

class CmsNewsRelationHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_project' => $object->getIdProject(),
			'id_relation' => $object->getIdRelation(),
			'id_news' => $object->getIdNews(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdProject(!empty($data['id_project']) ? $data['id_project'] : null)
			->setIdRelation(!empty($data['id_relation']) ? $data['id_relation'] : null)
			->setIdNews(!empty($data['id_news']) ? $data['id_news'] : null)
		;
        return $object;
    }
}