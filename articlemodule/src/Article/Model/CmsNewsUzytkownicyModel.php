<?php

namespace Article\Model;

use Article\Entity\CmsNewsEntity;
use Article\Entity\CmsNewsUzytkownicyEntity;
use Base\Model\BaseModel;
use Uzytkownicy\Entity\UzytkownicyEntity;

class CmsNewsUzytkownicyModel extends BaseModel
{

    
    protected $tablename = 'cms_news_uzytkownicy';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    public function __construct() {
        parent::__construct();
        if(class_exists('\Article\Entity\CmsNewsUzytkownicyEntity')){
            $this->entity = new \Article\Entity\CmsNewsUzytkownicyEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsUzytkownicyHydrator();
        }
    }

    public function getIdByUserAndNews(UzytkownicyEntity $user, CmsNewsEntity $news): ?int{

        $select = $this->sql->select();

        $select->where([
            'id_cms_news' => $news->getId(),
            'id_uzytkownicy' => $user->getIdUzytkownik()
        ]);

        $data = $this->getDataFromSelect($select);

        if(empty($data[0]['id'])){
            return null;
        }

        return $data[0]['id'];

    }

    public function getNewsByUser(int $id): array{

        $select = $this->sql->select();

        $select->where([
            'id_uzytkownicy' => $id,
        ]);

        $select->order('add_date DESC');

        $data = $this->getDataFromSelect($select);

        if(empty($data[0])){
            return null;
        }

        return $data;

    }

    public function getEntityByUserAndNews(UzytkownicyEntity $user, CmsNewsEntity $news): CmsNewsUzytkownicyEntity{

        $select = $this->sql->select();

        $select->where(array(
            'id_cms_news' => $news->getId(),
            'id_uzytkownicy' => $user->getIdUzytkownik()
        ));

        $select->limit(1);

        $data = $this->getDataFromSelect($select, self::ENTITY_MODE);

        if(empty($data[0])){
            return false;
        }

        return $data[0];

    }
    
    
}