<?php

namespace Article\Entity\Base;

class CmsNewsCategoryEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_news = null;
	/**
	* @var int
	**/
	protected $id_news_category_list = null;
	/**
	* @var string
	**/
	protected $date_added = 'CURRENT_TIMESTAMP';

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

	/**
	* Gets the id_news_category_list property
	* @return integer the id_news_category_list
	*/
	public function getIdNewsCategoryList()
	{
		return $this->id_news_category_list;
	}

	/**
	* Sets the id_news_category_list property
	* @param integer the id_news_category_list to set
	* @return void
	*/
	public function setIdNewsCategoryList($id_news_category_list)
	{
		$this->id_news_category_list = $id_news_category_list;
		return $this;
	}

	/**
	* Gets the date_added property
	* @return string the date_added
	*/
	public function getDateAdded()
	{
		return $this->date_added;
	}

	/**
	* Sets the date_added property
	* @param string the date_added to set
	* @return void
	*/
	public function setDateAdded($date_added)
	{
		$this->date_added = $date_added;
		return $this;
	}


}