<?php

namespace Article\Hydrator\Base;

class CmsNewsCategoryHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_news' => $object->getIdNews(),
			'id_news_category_list' => $object->getIdNewsCategoryList(),
			'date_added' => $object->getDateAdded(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdNews(!empty($data['id_news']) ? $data['id_news'] : null)
			->setIdNewsCategoryList(!empty($data['id_news_category_list']) ? $data['id_news_category_list'] : null)
			->setDateAdded(!empty($data['date_added']) ? $data['date_added'] : null)
		;
        return $object;
    }
}