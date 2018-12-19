<?php

namespace Article\Hydrator;

class CmsNewsHydrator extends \Article\Hydrator\Base\CmsNewsHydratorBase
{
	public function extract($object)
	{

		return array_merge( parent::extract($object), array(


		));
    }
	public function hydrate(array $data, $object)
	{

		parent::hydrate($data, $object);

        $object
            ->setGalleryName(!empty($data['gallery_name']) ? $data['gallery_name'] : null)
            ->setGalleryActive(!empty($data['gallery_active']) ? $data['gallery_active'] : null)
            ->setAuthorName(!empty($data['author_name']) ? $data['author_name'] : null)
            ->setAuthorSurname(!empty($data['author_surname']) ? $data['author_surname'] : null)
            ->setAuthorAvatar(!empty($data['author_avatar']) ? $data['author_avatar'] : null)
            ->setPhoto(!empty($data['photo']) ? $data['photo'] : null)
            ->setPhotoAuthor(!empty($data['autor_photo']) ? $data['autor_photo'] : null)
            ->setPhotoTitle(!empty($data['photo_title']) ? $data['photo_title'] : null)
            ->setPhotoCompany(!empty($data['photo_company']) ? $data['photo_company'] : null)
            ->setCompanyName(!empty($data['nazwa_firmy']) ? $data['nazwa_firmy'] : null)
            ->setCompanyId(!empty($data['id_company']) ? $data['id_company'] : null)
            ->setCompanyLocation(!empty($data['miejscowosc_firmy']) ? $data['miejscowosc_firmy'] : null)
            ->setCompanyStreet(!empty($data['ulica_firmy']) ? $data['ulica_firmy'] : null)
            ->setCompanyBuilding(!empty($data['nr_budynku']) ? $data['nr_budynku'] : null)
            ->setCompanyFlat(!empty($data['nr_lokalu']) ? $data['nr_lokalu'] : null)
            ->setCompanyPostal(!empty($data['kod_pocztowy_firmy']) ? $data['kod_pocztowy_firmy'] : null)
            ->setShortPhotoDescription(!empty($data['short_photo_description']) ? $data['short_photo_description'] : null)
            ->setWebsite(!empty($data['strona_www']) ? $data['strona_www'] : null)
            ->setEmail(!empty($data['email']) ? $data['email'] : null)
            ->setTags(!empty($data['tags']) ? $data['tags'] : null)
            ->setCategoryIds(!empty($data['category_ids']) ? $data['category_ids'] : null)
            ->setCategoryName(!empty($data['category_name']) ? $data['category_name'] : null)
            ->setSubtitle(!empty($data['subtitle']) ? $data['subtitle'] : null)
            ->setPhone1(!empty($data['phone1']) ? $data['phone1'] : null)
            ->setPhone2(!empty($data['phone2']) ? $data['phone2'] : null)
            ->setPhone3(!empty($data['phone3']) ? $data['phone3'] : null)
            ;

		
        return $object;
    }
}