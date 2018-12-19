<?php

namespace Article\Entity\Base;

class CmsGalleryPhotoLangsEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_gallery_photo = null;
	/**
	* @var int
	**/
	protected $id_lang = null;
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
	* Gets the id_gallery_photo property
	* @return integer the id_gallery_photo
	*/
	public function getIdGalleryPhoto()
	{
		return $this->id_gallery_photo;
	}

	/**
	* Sets the id_gallery_photo property
	* @param integer the id_gallery_photo to set
	* @return void
	*/
	public function setIdGalleryPhoto($id_gallery_photo)
	{
		$this->id_gallery_photo = $id_gallery_photo;
		return $this;
	}

	/**
	* Gets the id_lang property
	* @return integer the id_lang
	*/
	public function getIdLang()
	{
		return $this->id_lang;
	}

	/**
	* Sets the id_lang property
	* @param integer the id_lang to set
	* @return void
	*/
	public function setIdLang($id_lang)
	{
		$this->id_lang = $id_lang;
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


}