<?php

namespace Article\Entity\Base;

class CmsNewsEntityBase extends \Base\Entity\BaseEntity
{
	/**
	* @var int
	**/
	protected $id;
	/**
	* @var int
	**/
	protected $id_firmy = null;
	/**
	* @var string
	**/
	protected $title = '';
	/**
	* @var string
	**/
	protected $content = '';
	/**
	* @var string
	**/
	protected $amp_content = '';
	/**
	* @var string
	**/
	protected $short_content = '';
	/**
	* @var string
	**/
	protected $technical_content = '';
	/**
	* @var string
	**/
	protected $search_content = '';
	/**
	* @var string
	**/
	protected $publication_date = '0000-00-00 00:00:00';
	/**
	* @var string
	**/
	protected $add_date = 'CURRENT_TIMESTAMP';
	/**
	* @var string
	**/
	protected $end_date = '0000-00-00 00:00:00';
	/**
	* @var int
	**/
	protected $active = 0;
	/**
	* @var int
	**/
	protected $main_page_active = 0;
	/**
	* @var int
	**/
	protected $archives = 0;
	/**
	* @var string
	**/
	protected $meta_title = '';
	/**
	* @var string
	**/
	protected $meta_description = '';
	/**
	* @var string
	**/
	protected $meta_keywords = '';
	/**
	* @var int
	**/
	protected $id_news_type = null;
	/**
	* @var string
	**/
	protected $url = '';
	/**
	* @var string
	**/
	protected $external_url = '';
	/**
	* @var int
	**/
	protected $id_admin = null;
	/**
	* @var int
	**/
	protected $id_author = null;
	/**
	* @var int
	**/
	protected $id_image = null;
	/**
	* @var int
	**/
	protected $id_gallery = null;
	/**
	* @var int
	**/
	protected $id_survey = null;
	/**
	* @var int
	**/
	protected $survey_show_results = 0;
	/**
	* @var int
	**/
	protected $survey_required_personal_data = 0;
	/**
	* @var int
	**/
	protected $is_seo_site = 1;
	/**
	* @var string
	**/
	protected $id_youtube_video = '';
	/**
	* @var int
	**/
	protected $like_count = 0;
	/**
	* @var string
	**/
	protected $seo_priority = '1';
	/**
	* @var string
	**/
	protected $seo_changefreq = '';
	/**
	* @var string
	**/
	protected $json_data = '';

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
	* Gets the id_firmy property
	* @return integer the id_firmy
	*/
	public function getIdFirmy()
	{
		return $this->id_firmy;
	}

	/**
	* Sets the id_firmy property
	* @param integer the id_firmy to set
	* @return void
	*/
	public function setIdFirmy($id_firmy)
	{
		$this->id_firmy = $id_firmy;
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
	* Gets the amp_content property
	* @return string the amp_content
	*/
	public function getAmpContent()
	{
		return $this->amp_content;
	}

	/**
	* Sets the amp_content property
	* @param string the amp_content to set
	* @return void
	*/
	public function setAmpContent($amp_content)
	{
		$this->amp_content = $amp_content;
		return $this;
	}

	/**
	* Gets the short_content property
	* @return string the short_content
	*/
	public function getShortContent()
	{
		return $this->short_content;
	}

	/**
	* Sets the short_content property
	* @param string the short_content to set
	* @return void
	*/
	public function setShortContent($short_content)
	{
		$this->short_content = $short_content;
		return $this;
	}

	/**
	* Gets the technical_content property
	* @return string the technical_content
	*/
	public function getTechnicalContent()
	{
		return $this->technical_content;
	}

	/**
	* Sets the technical_content property
	* @param string the technical_content to set
	* @return void
	*/
	public function setTechnicalContent($technical_content)
	{
		$this->technical_content = $technical_content;
		return $this;
	}

	/**
	* Gets the search_content property
	* @return string the search_content
	*/
	public function getSearchContent()
	{
		return $this->search_content;
	}

	/**
	* Sets the search_content property
	* @param string the search_content to set
	* @return void
	*/
	public function setSearchContent($search_content)
	{
		$this->search_content = $search_content;
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
	* Gets the end_date property
	* @return datetime the end_date
	*/
	public function getEndDate()
	{
		return $this->end_date;
	}

	/**
	* Sets the end_date property
	* @param datetime the end_date to set
	* @return void
	*/
	public function setEndDate($end_date)
	{
		$this->end_date = $end_date;
		return $this;
	}

	/**
	* Gets the active property
	* @return integer the active
	*/
	public function getActive()
	{
		return $this->active;
	}

	/**
	* Sets the active property
	* @param integer the active to set
	* @return void
	*/
	public function setActive($active)
	{
		$this->active = $active;
		return $this;
	}

	/**
	* Gets the main_page_active property
	* @return integer the main_page_active
	*/
	public function getMainPageActive()
	{
		return $this->main_page_active;
	}

	/**
	* Sets the main_page_active property
	* @param integer the main_page_active to set
	* @return void
	*/
	public function setMainPageActive($main_page_active)
	{
		$this->main_page_active = $main_page_active;
		return $this;
	}

	/**
	* Gets the archives property
	* @return integer the archives
	*/
	public function getArchives()
	{
		return $this->archives;
	}

	/**
	* Sets the archives property
	* @param integer the archives to set
	* @return void
	*/
	public function setArchives($archives)
	{
		$this->archives = $archives;
		return $this;
	}

	/**
	* Gets the meta_title property
	* @return string the meta_title
	*/
	public function getMetaTitle()
	{
		return $this->meta_title;
	}

	/**
	* Sets the meta_title property
	* @param string the meta_title to set
	* @return void
	*/
	public function setMetaTitle($meta_title)
	{
		$this->meta_title = $meta_title;
		return $this;
	}

	/**
	* Gets the meta_description property
	* @return string the meta_description
	*/
	public function getMetaDescription()
	{
		return $this->meta_description;
	}

	/**
	* Sets the meta_description property
	* @param string the meta_description to set
	* @return void
	*/
	public function setMetaDescription($meta_description)
	{
		$this->meta_description = $meta_description;
		return $this;
	}

	/**
	* Gets the meta_keywords property
	* @return string the meta_keywords
	*/
	public function getMetaKeywords()
	{
		return $this->meta_keywords;
	}

	/**
	* Sets the meta_keywords property
	* @param string the meta_keywords to set
	* @return void
	*/
	public function setMetaKeywords($meta_keywords)
	{
		$this->meta_keywords = $meta_keywords;
		return $this;
	}

	/**
	* Gets the id_news_type property
	* @return integer the id_news_type
	*/
	public function getIdNewsType()
	{
		return $this->id_news_type;
	}

	/**
	* Sets the id_news_type property
	* @param integer the id_news_type to set
	* @return void
	*/
	public function setIdNewsType($id_news_type)
	{
		$this->id_news_type = $id_news_type;
		return $this;
	}

	/**
	* Gets the url property
	* @return string the url
	*/
	public function getUrl()
	{
		return $this->url;
	}

	/**
	* Sets the url property
	* @param string the url to set
	* @return void
	*/
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	/**
	* Gets the external_url property
	* @return string the external_url
	*/
	public function getExternalUrl()
	{
		return $this->external_url;
	}

	/**
	* Sets the external_url property
	* @param string the external_url to set
	* @return void
	*/
	public function setExternalUrl($external_url)
	{
		$this->external_url = $external_url;
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
	* Gets the id_author property
	* @return integer the id_author
	*/
	public function getIdAuthor()
	{
		return $this->id_author;
	}

	/**
	* Sets the id_author property
	* @param integer the id_author to set
	* @return void
	*/
	public function setIdAuthor($id_author)
	{
		$this->id_author = $id_author;
		return $this;
	}

	/**
	* Gets the id_image property
	* @return integer the id_image
	*/
	public function getIdImage()
	{
		return $this->id_image;
	}

	/**
	* Sets the id_image property
	* @param integer the id_image to set
	* @return void
	*/
	public function setIdImage($id_image)
	{
		$this->id_image = $id_image;
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
	* Gets the id_survey property
	* @return integer the id_survey
	*/
	public function getIdSurvey()
	{
		return $this->id_survey;
	}

	/**
	* Sets the id_survey property
	* @param integer the id_survey to set
	* @return void
	*/
	public function setIdSurvey($id_survey)
	{
		$this->id_survey = $id_survey;
		return $this;
	}

	/**
	* Gets the survey_show_results property
	* @return integer the survey_show_results
	*/
	public function getSurveyShowResults()
	{
		return $this->survey_show_results;
	}

	/**
	* Sets the survey_show_results property
	* @param integer the survey_show_results to set
	* @return void
	*/
	public function setSurveyShowResults($survey_show_results)
	{
		$this->survey_show_results = $survey_show_results;
		return $this;
	}

	/**
	* Gets the survey_required_personal_data property
	* @return integer the survey_required_personal_data
	*/
	public function getSurveyRequiredPersonalData()
	{
		return $this->survey_required_personal_data;
	}

	/**
	* Sets the survey_required_personal_data property
	* @param integer the survey_required_personal_data to set
	* @return void
	*/
	public function setSurveyRequiredPersonalData($survey_required_personal_data)
	{
		$this->survey_required_personal_data = $survey_required_personal_data;
		return $this;
	}

	/**
	* Gets the is_seo_site property
	* @return integer the is_seo_site
	*/
	public function getIsSeoSite()
	{
		return $this->is_seo_site;
	}

	/**
	* Sets the is_seo_site property
	* @param integer the is_seo_site to set
	* @return void
	*/
	public function setIsSeoSite($is_seo_site)
	{
		$this->is_seo_site = $is_seo_site;
		return $this;
	}

	/**
	* Gets the id_youtube_video property
	* @return string the id_youtube_video
	*/
	public function getIdYoutubeVideo()
	{
		return $this->id_youtube_video;
	}

	/**
	* Sets the id_youtube_video property
	* @param string the id_youtube_video to set
	* @return void
	*/
	public function setIdYoutubeVideo($id_youtube_video)
	{
		$this->id_youtube_video = $id_youtube_video;
		return $this;
	}

	/**
	* Gets the like_count property
	* @return integer the like_count
	*/
	public function getLikeCount()
	{
		return $this->like_count;
	}

	/**
	* Sets the like_count property
	* @param integer the like_count to set
	* @return void
	*/
	public function setLikeCount($like_count)
	{
		$this->like_count = $like_count;
		return $this;
	}

	/**
	* Gets the seo_priority property
	* @return string the seo_priority
	*/
	public function getSeoPriority()
	{
		return $this->seo_priority;
	}

	/**
	* Sets the seo_priority property
	* @param string the seo_priority to set
	* @return void
	*/
	public function setSeoPriority($seo_priority)
	{
		$this->seo_priority = $seo_priority;
		return $this;
	}

	/**
	* Gets the seo_changefreq property
	* @return string the seo_changefreq
	*/
	public function getSeoChangefreq()
	{
		return $this->seo_changefreq;
	}

	/**
	* Sets the seo_changefreq property
	* @param string the seo_changefreq to set
	* @return void
	*/
	public function setSeoChangefreq($seo_changefreq)
	{
		$this->seo_changefreq = $seo_changefreq;
		return $this;
	}

	/**
	* Gets the json_data property
	* @return string the json_data
	*/
	public function getJsonData()
	{
		return $this->json_data;
	}

	/**
	* Sets the json_data property
	* @param string the json_data to set
	* @return void
	*/
	public function setJsonData($json_data)
	{
		$this->json_data = $json_data;
		return $this;
	}


}