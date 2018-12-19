<?php

namespace Article\Entity\Base;

class CmsNewsRelationEntityBase extends \Base\Entity\BaseEntity
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
	* @var int
	**/
	protected $id_relation = null;
	/**
	* @var int
	**/
	protected $id_news = null;

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
	* Gets the id_relation property
	* @return integer the id_relation
	*/
	public function getIdRelation()
	{
		return $this->id_relation;
	}

	/**
	* Sets the id_relation property
	* @param integer the id_relation to set
	* @return void
	*/
	public function setIdRelation($id_relation)
	{
		$this->id_relation = $id_relation;
		return $this;
	}

	/**
	* Gets the id_news property
	* @return integer the id_news
	*/
	public function getIdNews()
	{
		return $this->id_news;
	}

	/**
	* Sets the id_news property
	* @param integer the id_news to set
	* @return void
	*/
	public function setIdNews($id_news)
	{
		$this->id_news = $id_news;
		return $this;
	}


}