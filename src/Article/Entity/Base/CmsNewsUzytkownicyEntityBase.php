<?php

namespace Article\Entity\Base;

class CmsNewsUzytkownicyEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_cms_news = null;
	/**
	* @var int
	**/
	protected $id_uzytkownicy = null;
	/**
	* @var string
	**/
	protected $describe = '';
	/**
	* @var string
	**/
	protected $add_date = 'CURRENT_TIMESTAMP';

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
	* Gets the id_cms_news property
	* @return integer the id_cms_news
	*/
	public function getIdCmsNews()
	{
		return $this->id_cms_news;
	}

	/**
	* Sets the id_cms_news property
	* @param integer the id_cms_news to set
	* @return void
	*/
	public function setIdCmsNews($id_cms_news)
	{
		$this->id_cms_news = $id_cms_news;
		return $this;
	}

	/**
	* Gets the id_uzytkownicy property
	* @return integer the id_uzytkownicy
	*/
	public function getIdUzytkownicy()
	{
		return $this->id_uzytkownicy;
	}

	/**
	* Sets the id_uzytkownicy property
	* @param integer the id_uzytkownicy to set
	* @return void
	*/
	public function setIdUzytkownicy($id_uzytkownicy)
	{
		$this->id_uzytkownicy = $id_uzytkownicy;
		return $this;
	}

	/**
	* Gets the describe property
	* @return string the describe
	*/
	public function getDescribe()
	{
		return $this->describe;
	}

	/**
	* Sets the describe property
	* @param string the describe to set
	* @return void
	*/
	public function setDescribe($describe)
	{
		$this->describe = $describe;
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


}