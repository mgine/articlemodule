<?php

namespace Article\Model;

use Base\Model\BaseModel;
use Base\Settings\Lang;
use Zend\Db\Sql\Select;

class CmsNewsTypeModel extends BaseModel
{

    
    protected $tablename = 'cms_news_type';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    
    
    public function __construct() {
        parent::__construct();
        if(class_exists('\Article\Entity\CmsNewsTypeEntity')){
            $this->entity = new \Article\Entity\CmsNewsTypeEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsTypeHydrator();
        }
    }

    public function getMainCategoryIdByNewsType($idNewsType){
        $select = new Select(array('nt' => 'cms_news_type_site_category'));
        $select->columns(array(
            'id',
            'id_cms_news_category_list'
        ));
        $select->where(array(
            'id_cms_news_type' =>$idNewsType,
            'id_cms_pages_projects_langs' => Lang::getLangSite()
        ));

        $data = $this->getDataFromSelect($select);

        if(!empty($data[0]['id_cms_news_category_list'])){
            return $data[0]['id_cms_news_category_list'];
        }
        return false;
    }
    
    
}