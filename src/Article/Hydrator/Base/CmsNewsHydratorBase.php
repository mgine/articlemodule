<?php

namespace Article\Hydrator\Base;

class CmsNewsHydratorBase
{
	public function extract($object)
	{

		return array(
			'id' => $object->getId(),
			'id_firmy' => $object->getIdFirmy(),
			'title' => $object->getTitle(),
			'content' => $object->getContent(),
			'amp_content' => $object->getAmpContent(),
			'short_content' => $object->getShortContent(),
			'technical_content' => $object->getTechnicalContent(),
			'search_content' => $object->getSearchContent(),
			'publication_date' => $object->getPublicationDate(),
			'add_date' => $object->getAddDate(),
			'end_date' => $object->getEndDate(),
			'active' => $object->getActive(),
			'main_page_active' => $object->getMainPageActive(),
			'archives' => $object->getArchives(),
			'meta_title' => $object->getMetaTitle(),
			'meta_description' => $object->getMetaDescription(),
			'meta_keywords' => $object->getMetaKeywords(),
			'id_news_type' => $object->getIdNewsType(),
			'url' => $object->getUrl(),
			'external_url' => $object->getExternalUrl(),
			'id_admin' => $object->getIdAdmin(),
			'id_author' => $object->getIdAuthor(),
			'id_image' => $object->getIdImage(),
			'id_gallery' => $object->getIdGallery(),
			'id_survey' => $object->getIdSurvey(),
			'survey_show_results' => $object->getSurveyShowResults(),
			'survey_required_personal_data' => $object->getSurveyRequiredPersonalData(),
			'is_seo_site' => $object->getIsSeoSite(),
			'id_youtube_video' => $object->getIdYoutubeVideo(),
			'like_count' => $object->getLikeCount(),
			'seo_priority' => $object->getSeoPriority(),
			'seo_changefreq' => $object->getSeoChangefreq(),
			'json_data' => $object->getJsonData(),
		);
    }
	public function hydrate(array $data, $object)
	{

		$object
			->setId(!empty($data['id']) ? $data['id'] : null)
			->setIdFirmy(!empty($data['id_firmy']) ? $data['id_firmy'] : null)
			->setTitle(!empty($data['title']) ? $data['title'] : null)
			->setContent(!empty($data['content']) ? $data['content'] : null)
			->setAmpContent(!empty($data['amp_content']) ? $data['amp_content'] : null)
			->setShortContent(!empty($data['short_content']) ? $data['short_content'] : null)
			->setTechnicalContent(!empty($data['additional_content']) ? $data['additional_content'] : null)
			->setSearchContent(!empty($data['search_content']) ? $data['search_content'] : null)
			->setPublicationDate(!empty($data['publication_date']) ? $data['publication_date'] : null)
			->setAddDate(!empty($data['add_date']) ? $data['add_date'] : null)
			->setEndDate(!empty($data['end_date']) ? $data['end_date'] : null)
			->setActive(!empty($data['active']) ? $data['active'] : null)
			->setMainPageActive(!empty($data['main_page_active']) ? $data['main_page_active'] : null)
			->setArchives(!empty($data['archives']) ? $data['archives'] : null)
			->setMetaTitle(!empty($data['meta_title']) ? $data['meta_title'] : null)
			->setMetaDescription(!empty($data['meta_description']) ? $data['meta_description'] : null)
			->setMetaKeywords(!empty($data['meta_keywords']) ? $data['meta_keywords'] : null)
			->setIdNewsType(!empty($data['id_news_type']) ? $data['id_news_type'] : null)
			->setUrl(!empty($data['url']) ? $data['url'] : null)
			->setExternalUrl(!empty($data['external_url']) ? $data['external_url'] : null)
			->setIdAdmin(!empty($data['id_admin']) ? $data['id_admin'] : null)
			->setIdAuthor(!empty($data['id_author']) ? $data['id_author'] : null)
			->setIdImage(!empty($data['id_image']) ? $data['id_image'] : null)
			->setIdGallery(!empty($data['id_gallery']) ? $data['id_gallery'] : null)
			->setIdSurvey(!empty($data['id_survey']) ? $data['id_survey'] : null)
			->setSurveyShowResults(!empty($data['survey_show_results']) ? $data['survey_show_results'] : null)
			->setSurveyRequiredPersonalData(!empty($data['survey_required_personal_data']) ? $data['survey_required_personal_data'] : null)
			->setIsSeoSite(!empty($data['is_seo_site']) ? $data['is_seo_site'] : null)
			->setIdYoutubeVideo(!empty($data['id_youtube_video']) ? $data['id_youtube_video'] : null)
			->setLikeCount(!empty($data['like_count']) ? $data['like_count'] : null)
			->setSeoPriority(!empty($data['seo_priority']) ? $data['seo_priority'] : null)
			->setSeoChangefreq(!empty($data['seo_changefreq']) ? $data['seo_changefreq'] : null)
			->setJsonData(!empty($data['json_data']) ? $data['json_data'] : null)
		;
        return $object;
    }
}