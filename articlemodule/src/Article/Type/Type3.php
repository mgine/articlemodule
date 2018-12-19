<?php

namespace Article\Type;

use Article\Form\ArticleSearchFormAbstract;
use Article\Form\NewsSearchForm;

class Type3  extends TypeAbstract {

    protected $searchLinker;

    /**
     * @return string
     */
    function url(): string
    {
        return $this->getServiceLocator()->get('viewhelpermanager')->get('url')->__invoke('newsdetail3', array('id' => $this->getId(), 'title' => $this->getUrl()));
    }

    /**
     * @return ArticleSearchFormAbstract
     */
    public function getSearchLinker() : ArticleSearchFormAbstract
    {
        if($this->searchLinker){
            return $this->searchLinker;
        }
        return $this->searchLinker = new NewsSearchForm();
    }
}