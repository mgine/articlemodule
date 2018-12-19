<?php

namespace Article\Entity\Base;

class CmsNewsCategoryListEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_site = 0;
	/**
	* @var int
	**/
	protected $id_pliki_konfiguracja_rozmiary = null;
	/**
	* @var int
	**/
	protected $id_parent = null;
	/**
	* @var int
	**/
	protected $keep_proportions = 0;
	/**
	* @var string
	**/
	protected $name = '';
	/**
	* @var int
	**/
	protected $default = 0;
	/**
	* @var string
	**/
	protected $slug = '';
	/**
	* @var int
	**/
	protected $id_admini = null;
	/**
	* @var int
	**/
	protected $assigned_news = 0;

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
	* Gets the id_site property
	* @return integer the id_site
	*/
	public function getIdSite()
	{
		return $this->id_site;
	}

	/**
	* Sets the id_site property
	* @param integer the id_site to set
	* @return void
	*/
	public function setIdSite($id_site)
	{
		$this->id_site = $id_site;
		return $this;
	}

	/**
	* Gets the id_pliki_konfiguracja_rozmiary property
	* @return integer the id_pliki_konfiguracja_rozmiary
	*/
	public function getIdPlikiKonfiguracjaRozmiary()
	{
		return $this->id_pliki_konfiguracja_rozmiary;
	}

	/**
	* Sets the id_pliki_konfiguracja_rozmiary property
	* @param integer the id_pliki_konfiguracja_rozmiary to set
	* @return void
	*/
	public function setIdPlikiKonfiguracjaRozmiary($id_pliki_konfiguracja_rozmiary)
	{
		$this->id_pliki_konfiguracja_rozmiary = $id_pliki_konfiguracja_rozmiary;
		return $this;
	}

	/**
	* Gets the id_parent property
	* @return integer the id_parent
	*/
	public function getIdParent()
	{
		return $this->id_parent;
	}

	/**
	* Sets the id_parent property
	* @param integer the id_parent to set
	* @return void
	*/
	public function setIdParent($id_parent)
	{
		$this->id_parent = $id_parent;
		return $this;
	}

	/**
	* Gets the keep_proportions property
	* @return integer the keep_proportions
	*/
	public function getKeepProportions()
	{
		return $this->keep_proportions;
	}

	/**
	* Sets the keep_proportions property
	* @param integer the keep_proportions to set
	* @return void
	*/
	public function setKeepProportions($keep_proportions)
	{
		$this->keep_proportions = $keep_proportions;
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
	* Gets the default property
	* @return integer the default
	*/
	public function getDefault()
	{
		return $this->default;
	}

	/**
	* Sets the default property
	* @param integer the default to set
	* @return void
	*/
	public function setDefault($default)
	{
		$this->default = $default;
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

	/**
	* Gets the id_admini property
	* @return integer the id_admini
	*/
	public function getIdAdmini()
	{
		return $this->id_admini;
	}

	/**
	* Sets the id_admini property
	* @param integer the id_admini to set
	* @return void
	*/
	public function setIdAdmini($id_admini)
	{
		$this->id_admini = $id_admini;
		return $this;
	}

	/**
	* Gets the assigned_news property
	* @return integer the assigned_news
	*/
	public function getAssignedNews()
	{
		return $this->assigned_news;
	}

	/**
	* Sets the assigned_news property
	* @param integer the assigned_news to set
	* @return void
	*/
	public function setAssignedNews($assigned_news)
	{
		$this->assigned_news = $assigned_news;
		return $this;
	}


}