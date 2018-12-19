<?php

namespace Article\Type;

use Article\Form\ArchitectureSearchForm;
use Article\Form\ArticleSearchFormAbstract;

class Type1 extends TypeAbstract {

    protected $searchLinker;

    /**
     * @return string
     */
    public function url(): string
    {
        return $this->getServiceLocator()->get('viewhelpermanager')->get('url')->__invoke('newsdetail1', array('id' => $this->getId(), 'title' => $this->getUrl()));
    }

    /**
     * @return ArticleSearchFormAbstract
     */
    public function getSearchLinker() : ArticleSearchFormAbstract
    {
        if($this->searchLinker){
            return $this->searchLinker;
        }
        return $this->searchLinker = new ArchitectureSearchForm();
    }
}
