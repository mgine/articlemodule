<?php

namespace Article\Model;

use Base\Model\BaseModel;
use Base\Settings\Lang;

class CmsNewsCategoryListModel extends BaseModel
{

    
    protected $tablename = 'cms_news_category_list';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    
    
    public function __construct() {
        parent::__construct();
        if(class_exists('\Article\Entity\CmsNewsCategoryListEntity')){
            $this->entity = new \Article\Entity\CmsNewsCategoryListEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsCategoryListHydrator();
        }
    }

    /**
     * @return array
     */
    public function getAllEntities(): array{
        $select = $this->sql->select();
        $select->where(['id_site' => Lang::getLangSite()]);

        return (array) $this->getDataFromSelect($select, self::ENTITY_MODE);
    }
    
    
}