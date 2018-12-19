<?php

namespace Article\Model;

use Base\Model\BaseModel;

class CmsNewsCategoryModel extends BaseModel
{

    
    protected $tablename = 'cms_news_category';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    
    
    public function __construct() {
        parent::__construct();
        if(class_exists('\Article\Entity\CmsNewsCategoryEntity')){
            $this->entity = new \Article\Entity\CmsNewsCategoryEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsCategoryHydrator();
        }
    }
    
    
}