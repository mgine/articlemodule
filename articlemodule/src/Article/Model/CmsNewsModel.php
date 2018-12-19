<?php

namespace Article\Model;

use Article\Entity\CmsNewsEntity;
use Base\Model\BaseModel;
use Base\Settings\Lang;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Select;

class CmsNewsModel extends BaseModel
{

    
    protected $tablename = 'cms_news';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';

    protected $entities;

    protected $showDeactivation = false;
    
    
    public function __construct()
    {
        parent::__construct();
        if (class_exists('\Article\Entity\CmsNewsEntity')) {
            $this->entity = new \Article\Entity\CmsNewsEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsHydrator();
            $this->entities = array(
                1 => array('default' => new \Article\Type\Type1()),
                2 => array('default' => new \Article\Type\Type2()),
                3 => array('default' => new \Article\Type\Type3()),
            );
        }
    }

    /**
     * @param bool $active
     * @param bool $archives
     * @param bool $publication_date
     * @return Select
     */
    public function getSelect(bool $active = true, bool $archives = false, bool $publication_date = true): Select{

        $this->setGroupConcatLong();

        $select = new Select(['n' => $this->tablename]);

        $on = "n.id_gallery = g.id";
        if ($active) {
            $select->where(["n.active = ?" => true]);
            $on .= " and g.is_active = ?";
            $on = new Expression($on, [true]);
        }

        $select->join(['g' => 'cms_gallery'], $on, [
            'gallery_name' => 'name',
            'gallery_active' => 'is_active',
            'category_name' => new Expression('(SELECT GROUP_CONCAT(cncl2.name SEPARATOR \'---\') FROM cms_news_category cnc2 LEFT JOIN cms_news_category_list cncl2 ON cnc2.id_news_category_list = cncl2.id WHERE cnc2.id_news = n.id and cncl2.id_site = ? AND !cncl2.default)', [Lang::getLangSite()]),
            'category_ids' => new Expression('(SELECT GROUP_CONCAT(cncl2.id) FROM cms_news_category cnc2 LEFT JOIN cms_news_category_list cncl2 ON cnc2.id_news_category_list = cncl2.id WHERE cnc2.id_news = n.id and cncl2.id_site = ? AND !cncl2.default)', [Lang::getLangSite()]),
            'tags' => new Expression("(SELECT GROUP_CONCAT(CONCAT(cnt2.id_tagu,'|',tg2.id,'|',t2.nazwa,'|',tg2.nazwa,'|',t2.pozycja,'|',tg2.pozycja,'|',t2.slug,'|',tg2.slug)) as tags 
                FROM cms_news_tags as cnt2
                LEFT JOIN tagi as t2 ON cnt2.id_tagu = t2.id
                LEFT JOIN tagi_grupy as tg2 ON tg2.id = t2.id_grupy
                WHERE cnt2.id_item = n.id
            )"),], "LEFT");
        $select->join(["nt" => "cms_news_type"], "nt.id = n.id_news_type", [], "LEFT");
        $select->join(["a" => "admini"], "a.id_admin = n.id_author", ["author_name" => "imie", "author_surname" => "nazwisko"], "LEFT");
        $select->join(['aap' => 'pliki'], 'a.avatar_id_pliku = aap.id_pliku', ['author_avatar' => new Expression("CONCAT(aap.sciezka,'_SIZE_', aap.nazwa)")], "LEFT");
        $select->join(['p' => 'pliki'],
            'n.id_image = p.id_pliku' ,
            ['autor_photo'=>'autor','photo_title'=>'tytul','short_photo_description'=>'opis_html','photo' => new Expression("CONCAT(p.sciezka,'_SIZE_', p.nazwa)")],
            "LEFT");

        $select->join(['cnc' => 'cms_news_category'], 'cnc.id_news = n.id', [], "LEFT");
        $select->join(['cncl' => 'cms_news_category_list'], 'cnc.id_news_category_list = cncl.id', [
        ], "LEFT");
        $select->join(['f'=>'firmy'],'f.id = n.id_firmy', ["id_company"=>"id","nazwa_firmy"=>"nazwa_firmy","miejscowosc_firmy"=>"miejscowosc","ulica_firmy"=>"ulica","nr_budynku"=>"nr_budynku","nr_lokalu"=>"nr_lokalu","kod_pocztowy_firmy"=>"kod_pocztowy","strona_www"=>"strona_www","email"=>"email"],"LEFT");
        $select->join(['fa'=>'firmy_adresy'],'f.id = fa.id_firma', ['phone1'=>'telefon','phone2'=>'telefon2','phone3'=>'telefon3'],"LEFT");
        $select->join(['pl' => 'pliki'],
            'f.logotyp = pl.id_pliku' ,
            ['photo_company' => new Expression("CONCAT(pl.sciezka,'_SIZE_', pl.nazwa)")],
            "LEFT");
        $select->where([
            'cncl.default',
            'cncl.id_site' => Lang::getLangSite(),
        ]);

        if($archives !== null){
            $select->where(['n.archives' => (int)$archives]);
        }

        if($publication_date){
            $select->where([
                'n.publication_date <= ?' => $this->getDate(),
                new Expression('(n.end_date IS NULL OR n.end_date > ?)', $this->getDate())
            ]);
        }

        $select->order(['publication_date DESC', 'id DESC']);

        return $select;
    }

    /**
     * @param int $id
     * @param bool $active
     * @param bool $archives
     * @param bool $publication_date
     * @return CmsNewsEntity|null
     */
    public function getEntity(int $id, bool $active = true, bool $archives = false, bool $publication_date = true): ?CmsNewsEntity{

        $select = $this->getSelect($active, $archives, $publication_date);
        $select->where([
            'n.id' => $id
        ]);
        $select->limit(1);
        $data = $this->getDataFromSelect($select, self::ENTITY_MODE);
        if(empty($data[0])){
            return null;
        }

        return $data[0];

    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime {
        $time = new \DateTime();
        return $time->format("Y-m-d");
    }

    /**
     * @param array $data
     * @return CmsNewsEntity
     * @throws \Exception
     */
    public function createEntityFromData(array $data): CmsNewsEntity
    {

        if(empty($data['id_news_type']) || empty($this->entities[$data['id_news_type']]['default'])){
            throw new \Exception('Wrong news type');
        }

        $entity = $this->setServiceLocatorToEntity($this->hydrator->hydrate($data, clone $this->entities[$data['id_news_type']]['default']));

        if($entity instanceof ServiceLocatorAwareInterface){
            $entity->setServiceLocator($this->getServiceLocator());
        }

        $entity->calculateDisplayMode();

        return $entity;

    }

    /**
     * @param CmsNewsEntity $entity
     * @return CmsNewsEntity
     */
    public function setServiceLocatorToEntity(CmsNewsEntity $entity): CmsNewsEntity{
        $entity->setServiceLocator($this->getServiceLocator());
        return $entity;
    }


}