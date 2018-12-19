<?php

namespace Article\Entity\Base;

class CmsNewsTagsEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_item = null;
	/**
	* @var int
	**/
	protected $id_tagu = null;
	/**
	* @var string
	**/
	protected $data_dodania = '0000-00-00 00:00:00';

	/**
	* Gets the id property
	* @return integer the id
	*/
	public function getId()
	{
		return $this->id;
	}

	/**
	* Sets the id property
	* @param integer the id to set
	* @return void
	*/
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	* Gets the id_item property
	* @return integer the id_item
	*/
	public function getIdItem()
	{
		return $this->id_item;
	}

	/**
	* Sets the id_item property
	* @param integer the id_item to set
	* @return void
	*/
	public function setIdItem($id_item)
	{
		$this->id_item = $id_item;
		return $this;
	}

	/**
	* Gets the id_tagu property
	* @return integer the id_tagu
	*/
	public function getIdTagu()
	{
		return $this->id_tagu;
	}

	/**
	* Sets the id_tagu property
	* @param integer the id_tagu to set
	* @return void
	*/
	public function setIdTagu($id_tagu)
	{
		$this->id_tagu = $id_tagu;
		return $this;
	}

	/**
	* Gets the data_dodania property
	* @return datetime the data_dodania
	*/
	public function getDataDodania()
	{
		return $this->data_dodania;
	}

	/**
	* Sets the data_dodania property
	* @param datetime the data_dodania to set
	* @return void
	*/
	public function setDataDodania($data_dodania)
	{
		$this->data_dodania = $data_dodania;
		return $this;
	}


}