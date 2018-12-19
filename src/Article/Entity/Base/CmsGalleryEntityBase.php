<?php

namespace Article\Entity\Base;

class CmsGalleryEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_pliki_konfiguracja_rozmiary = null;
	/**
	* @var int
	**/
	protected $keep_proportions = 0;
	/**
	* @var int
	**/
	protected $id_group = null;
	/**
	* @var string
	**/
	protected $name = '';
	/**
	* @var string
	**/
	protected $description = '';
	/**
	* @var string
	**/
	protected $short_description = '';
	/**
	* @var string
	**/
	protected $publication_date = '0000-00-00 00:00:00';
	/**
	* @var string
	**/
	protected $add_date = 'CURRENT_TIMESTAMP';
	/**
	* @var int
	**/
	protected $is_active = 0;

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
	* Gets the id_group property
	* @return integer the id_group
	*/
	public function getIdGroup()
	{
		return $this->id_group;
	}

	/**
	* Sets the id_group property
	* @param integer the id_group to set
	* @return void
	*/
	public function setIdGroup($id_group)
	{
		$this->id_group = $id_group;
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
	* Gets the description property
	* @return string the description
	*/
	public function getDescription()
	{
		return $this->description;
	}

	/**
	* Sets the description property
	* @param string the description to set
	* @return void
	*/
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

	/**
	* Gets the short_description property
	* @return string the short_description
	*/
	public function getShortDescription()
	{
		return $this->short_description;
	}

	/**
	* Sets the short_description property
	* @param string the short_description to set
	* @return void
	*/
	public function setShortDescription($short_description)
	{
		$this->short_description = $short_description;
		return $this;
	}

	/**
	* Gets the publication_date property
	* @return datetime the publication_date
	*/
	public function getPublicationDate()
	{
		return $this->publication_date;
	}

	/**
	* Sets the publication_date property
	* @param datetime the publication_date to set
	* @return void
	*/
	public function setPublicationDate($publication_date)
	{
		$this->publication_date = $publication_date;
		return $this;
	}

	/**
	* Gets the add_date property
	* @return datetime the add_date
	*/
	public function getAddDate()
	{
		return $this->add_date;
	}

	/**
	* Sets the add_date property
	* @param datetime the add_date to set
	* @return void
	*/
	public function setAddDate($add_date)
	{
		$this->add_date = $add_date;
		return $this;
	}

	/**
	* Gets the is_active property
	* @return integer the is_active
	*/
	public function getIsActive()
	{
		return $this->is_active;
	}

	/**
	* Sets the is_active property
	* @param integer the is_active to set
	* @return void
	*/
	public function setIsActive($is_active)
	{
		$this->is_active = $is_active;
		return $this;
	}


}