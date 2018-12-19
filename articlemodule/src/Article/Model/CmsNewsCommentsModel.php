<?php

namespace Article\Model;

use Base\Model\BaseModel;

class CmsNewsCommentsModel extends BaseModel
{

    
    protected $tablename = 'cms_news_comments';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    
    
    public function __construct() {
        parent::__construct();
        if(class_exists('\Article\Entity\CmsNewsCommentsEntity')){
            $this->entity = new \Article\Entity\CmsNewsCommentsEntity();
            $this->hydrator = new \Article\Hydrator\CmsNewsCommentsHydrator();
        }
    }
    
    
}