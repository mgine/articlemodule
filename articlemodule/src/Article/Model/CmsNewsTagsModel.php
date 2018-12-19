<?php

namespace Article\Model;

use Base\Model\BaseModel;

class CmsNewsTagsModel extends BaseModel
{

    
    protected $tablename = 'cms_news_tags';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    
    
    public function __construct() {
        parent::__construct();
        if(class_exists('\Article\Entity\CmsNewsTagsEntity')){
            $this->entity = new \Article\Entity\CmsNewsTagsEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsTagsHydrator();
        }
    }
    
    
}