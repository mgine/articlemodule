<?php

namespace Article\Entity\Base;

class CmsGalleryPhotoEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_gallery = null;
	/**
	* @var int
	**/
	protected $id_admin = null;
	/**
	* @var int
	**/
	protected $id_file = null;
	/**
	* @var string
	**/
	protected $description = '';
	/**
	* @var string
	**/
	protected $title = '';
	/**
	* @var string
	**/
	protected $alternative_field = '';
	/**
	* @var int
	**/
	protected $position = 100;
	/**
	* @var string
	**/
	protected $publication_date = 'CURRENT_TIMESTAMP';

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
	* Gets the id_gallery property
	* @return integer the id_gallery
	*/
	public function getIdGallery()
	{
		return $this->id_gallery;
	}

	/**
	* Sets the id_gallery property
	* @param integer the id_gallery to set
	* @return void
	*/
	public function setIdGallery($id_gallery)
	{
		$this->id_gallery = $id_gallery;
		return $this;
	}

	/**
	* Gets the id_admin property
	* @return integer the id_admin
	*/
	public function getIdAdmin()
	{
		return $this->id_admin;
	}

	/**
	* Sets the id_admin property
	* @param integer the id_admin to set
	* @return void
	*/
	public function setIdAdmin($id_admin)
	{
		$this->id_admin = $id_admin;
		return $this;
	}

	/**
	* Gets the id_file property
	* @return integer the id_file
	*/
	public function getIdFile()
	{
		return $this->id_file;
	}

	/**
	* Sets the id_file property
	* @param integer the id_file to set
	* @return void
	*/
	public function setIdFile($id_file)
	{
		$this->id_file = $id_file;
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
	* Gets the title property
	* @return string the title
	*/
	public function getTitle()
	{
		return $this->title;
	}

	/**
	* Sets the title property
	* @param string the title to set
	* @return void
	*/
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	* Gets the alternative_field property
	* @return string the alternative_field
	*/
	public function getAlternativeField()
	{
		return $this->alternative_field;
	}

	/**
	* Sets the alternative_field property
	* @param string the alternative_field to set
	* @return void
	*/
	public function setAlternativeField($alternative_field)
	{
		$this->alternative_field = $alternative_field;
		return $this;
	}

	/**
	* Gets the position property
	* @return integer the position
	*/
	public function getPosition()
	{
		return $this->position;
	}

	/**
	* Sets the position property
	* @param integer the position to set
	* @return void
	*/
	public function setPosition($position)
	{
		$this->position = $position;
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


}