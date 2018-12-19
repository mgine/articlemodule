<?php

namespace Article\Entity\Base;

class CmsGalleryCategoryEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_cms_gallery_category_list = null;
	/**
	* @var int
	**/
	protected $id_cms_gallery = null;

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
	* Gets the id_cms_gallery_category_list property
	* @return integer the id_cms_gallery_category_list
	*/
	public function getIdCmsGalleryCategoryList()
	{
		return $this->id_cms_gallery_category_list;
	}

	/**
	* Sets the id_cms_gallery_category_list property
	* @param integer the id_cms_gallery_category_list to set
	* @return void
	*/
	public function setIdCmsGalleryCategoryList($id_cms_gallery_category_list)
	{
		$this->id_cms_gallery_category_list = $id_cms_gallery_category_list;
		return $this;
	}

	/**
	* Gets the id_cms_gallery property
	* @return integer the id_cms_gallery
	*/
	public function getIdCmsGallery()
	{
		return $this->id_cms_gallery;
	}

	/**
	* Sets the id_cms_gallery property
	* @param integer the id_cms_gallery to set
	* @return void
	*/
	public function setIdCmsGallery($id_cms_gallery)
	{
		$this->id_cms_gallery = $id_cms_gallery;
		return $this;
	}


}