<?php

namespace Article\Hydrator\Base;

class CmsNewsCommentsHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_news' => $object->getIdNews(),
			'nick' => $object->getNick(),
			'email' => $object->getEmail(),
			'content' => $object->getContent(),
			'is_active' => $object->getIsActive(),
			'is_rejected' => $object->getIsRejected(),
			'add_date' => $object->getAddDate(),
			'activate_date' => $object->getActivateDate(),
			'note' => $object->getNote(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdNews(!empty($data['id_news']) ? $data['id_news'] : null)
			->setNick(!empty($data['nick']) ? $data['nick'] : null)
			->setEmail(!empty($data['email']) ? $data['email'] : null)
			->setContent(!empty($data['content']) ? $data['content'] : null)
			->setIsActive(!empty($data['is_active']) ? $data['is_active'] : null)
			->setIsRejected(!empty($data['is_rejected']) ? $data['is_rejected'] : null)
			->setAddDate(!empty($data['add_date']) ? $data['add_date'] : null)
			->setActivateDate(!empty($data['activate_date']) ? $data['activate_date'] : null)
			->setNote(!empty($data['note']) ? $data['note'] : null)
		;
        return $object;
    }
}