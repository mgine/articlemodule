<?php

namespace Article\Entity\Base;

class CmsNewsCommentsEntityBase extends \Base\Entity\BaseEntity
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
	* @var string
	**/
	protected $nick = '';
	/**
	* @var string
	**/
	protected $email = '';
	/**
	* @var string
	**/
	protected $content = '';
	/**
	* @var int
	**/
	protected $is_active = 0;
	/**
	* @var int
	**/
	protected $is_rejected = 0;
	/**
	* @var string
	**/
	protected $add_date = 'CURRENT_TIMESTAMP';
	/**
	* @var string
	**/
	protected $activate_date = '';
	/**
	* @var string
	**/
	protected $note = '';

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
	* Gets the nick property
	* @return string the nick
	*/
	public function getNick()
	{
		return $this->nick;
	}

	/**
	* Sets the nick property
	* @param string the nick to set
	* @return void
	*/
	public function setNick($nick)
	{
		$this->nick = $nick;
		return $this;
	}

	/**
	* Gets the email property
	* @return string the email
	*/
	public function getEmail()
	{
		return $this->email;
	}

	/**
	* Sets the email property
	* @param string the email to set
	* @return void
	*/
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/**
	* Gets the content property
	* @return string the content
	*/
	public function getContent()
	{
		return $this->content;
	}

	/**
	* Sets the content property
	* @param string the content to set
	* @return void
	*/
	public function setContent($content)
	{
		$this->content = $content;
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

	/**
	* Gets the is_rejected property
	* @return integer the is_rejected
	*/
	public function getIsRejected()
	{
		return $this->is_rejected;
	}

	/**
	* Sets the is_rejected property
	* @param integer the is_rejected to set
	* @return void
	*/
	public function setIsRejected($is_rejected)
	{
		$this->is_rejected = $is_rejected;
		return $this;
	}

	/**
	* Gets the add_date property
	* @return string the add_date
	*/
	public function getAddDate()
	{
		return $this->add_date;
	}

	/**
	* Sets the add_date property
	* @param string the add_date to set
	* @return void
	*/
	public function setAddDate($add_date)
	{
		$this->add_date = $add_date;
		return $this;
	}

	/**
	* Gets the activate_date property
	* @return string the activate_date
	*/
	public function getActivateDate()
	{
		return $this->activate_date;
	}

	/**
	* Sets the activate_date property
	* @param string the activate_date to set
	* @return void
	*/
	public function setActivateDate($activate_date)
	{
		$this->activate_date = $activate_date;
		return $this;
	}

	/**
	* Gets the note property
	* @return string the note
	*/
	public function getNote()
	{
		return $this->note;
	}

	/**
	* Sets the note property
	* @param string the note to set
	* @return void
	*/
	public function setNote($note)
	{
		$this->note = $note;
		return $this;
	}


}