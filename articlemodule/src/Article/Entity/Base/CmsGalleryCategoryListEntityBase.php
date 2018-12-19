<?php

namespace Article\Entity\Base;

class CmsGalleryCategoryListEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_project = null;
	/**
	* @var string
	**/
	protected $name = '';
	/**
	* @var string
	**/
	protected $slug = '';

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
	* Gets the id_project property
	* @return integer the id_project
	*/
	public function getIdProject()
	{
		return $this->id_project;
	}

	/**
	* Sets the id_project property
	* @param integer the id_project to set
	* @return void
	*/
	public function setIdProject($id_project)
	{
		$this->id_project = $id_project;
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

	/**
	* Gets the slug property
	* @return string the slug
	*/
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	* Sets the slug property
	* @param string the slug to set
	* @return void
	*/
	public function setSlug($slug)
	{
		$this->slug = $slug;
		return $this;
	}


}