<?php

namespace Article\Search;

use Zend\EventManager\Event;

class ArticleSearchEvent extends Event
{
    
    const EVENT_SEARCH             = 'searchFlats';
    const EVENT_SEARCH_POST        = 'searchFlats.post';
    const EVENT_PREPARE_SEARCH             = 'searchFlatsPrepare';
    const EVENT_PREPARE_SEARCH_POST        = 'searchFlatsPrepare.post';
    
    public function getSearchData(){
        return (object) $this->params['data'];
    }
    public function getArticleSearchService(){
        return $this->target;
    }
    
}