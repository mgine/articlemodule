<?php

namespace Article\Entity\Base;

class CmsNewsTypeEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var string
	**/
	protected $name = '';

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
	* Gets the name property
	* @return string the name
	*/
	public function getName()
	{
		return $this->name;
	}

	/**
	* Sets the name property
	* @param string the name to set
	* @return void
	*/
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}


}