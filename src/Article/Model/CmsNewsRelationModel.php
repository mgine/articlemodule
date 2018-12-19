<?php

namespace Article\Model;

use Base\Model\BaseModel;

class CmsNewsRelationModel extends BaseModel
{

    
    protected $tablename = 'cms_news_relation';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    
    
    public function __construct() {
        parent::__construct();
        if(class_exists('\Article\Entity\CmsNewsRelationEntity')){
            $this->entity = new \Article\Entity\CmsNewsRelationEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsRelationHydrator();
        }
    }
    
    
}