<?php

namespace Article\Search;

use Article\Entity\CmsNewsEntity;
use Article\Search\Filter\Algorithms\InArraySqlStatement;
use Article\Search\Filter\SearchFilterAbstract;
use Article\Search\Form\ArticleSearchForm;
use Article\Search\Result\ResultArray;
use Article\Search\Result\ResultPagination;
use Base\Model\BaseModel;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Select;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use \Zend\ServiceManager\ServiceLocatorAwareInterface;

class ArticleSearch implements EventManagerAwareInterface, ServiceLocatorAwareInterface{

    protected $mode;
    protected $eventManager;
    protected $serviceLocator;
    protected $searchForm;
    protected $dataSet = null;
    protected $page = 1;
    protected $perPage =10;
    protected $sort;
    protected $sortParams;
    protected $limit = false;
    protected $searchFilers = [];
    protected $searchSelect;
    protected $totalSearchCount = 0;
    protected $retDataLimit = false;
    protected $czy_na_sprzedaz = true;

    public function __construct() {
        $this->setEventManager(new EventManager());
    }

    public function init() {

        $this->initMode();

        $this->searchForm = new \Article\Search\Form\ArticleSearchForm($this);
        $filter = $this->searchForm->prepareFilter();

        foreach ($this->searchFilers as $sFiltr) {

            $sFiltr->prepareFormElements($this->searchForm);
            $sFiltr->prepareFormFilter($filter);
        }
        $this->searchForm->setInputFilter($filter);

    }


    /**
     * @return ArticleSearch
     */
    protected function initMode(): ArticleSearch
    {

        $this->mode = 2;
        return $this;

    }

    /**
     * @param SearchFilterAbstract $filter
     * @return ArticleSearch
     */
    public function addSearchFilter(SearchFilterAbstract $filter): ArticleSearch
    {

        $this->searchFilers[] = $filter;

        return $this;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @return ArticleSearchForm
     */
    public function form(): ArticleSearchForm
    {

        return $this->searchForm;
    }

    /**
     * @return int
     */
    public function getTotalSearchCount(): int
    {

        if ($this->totalSearchCount) {
            return $this->totalSearchCount;
        }

        if ($this->paginator) {
            $this->totalSearchCount = $this->paginator->getTotalItemCount();
            return $this->totalSearchCount;
        }

        return 0;
    }

    /**
     * @param $data
     * @return ArticleSearch
     */
    public function setData($data): ArticleSearch
    {

        $this->form()->setData($data);

        if ($this->form()->isValid()) {

            $this->dataSet = $this->form()->getData();

            foreach ($this->searchFilers as $filter) {
                $filter->setData($this->dataSet);
            }


        } else {
            if(DEBUG){
                var_dump($data);
                var_dump($this->form()->getMessages());
            }

        }

        return $this;
    }

    /**
     * @return string
     */
    public function getQueryString(): string
    {

        return http_build_query($this->dataSet);

    }

    /**
     * @return int
     */
    public function getPage(): int
    {

        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {

        return $this->perPage;
    }

    /**
     * @param int $page
     * @return ArticleSearch
     */
    public function setPage(int $page): ArticleSearch
    {

        if (!empty($page)) {
            $this->page = $page;
        }

        return $this;
    }

    /**
     * @param int $perPage
     * @return ArticleSearch
     */
    public function setPerPage(int $perPage): ArticleSearch
    {

        if (!empty($perPage) and ($perPage <= 20)) {
            $this->perPage = $perPage;
        }

        return $this;
    }

    /**
     * @return Select
     */
    protected function prepareSearchSelect(): Select
    {

        if(!$this->searchSelect){

            $select = $this->getServiceLocator()->get('Article\Model\CmsNews')->getSelect();

            if($this->limit){
                $select->limit($this->limit);
            }

            foreach ($this->searchFilers as $filter) {
                $filter->setMainTableAlias('n');
                $filter->prepareSelect($select);
            }

            $this->searchSelect = $select;

        }

        $select = clone $this->searchSelect;

        $this->setSortToSelect($select);

        return $select;
    }

    /**
     * @param int $limit
     * @return ResultArray
     */
    public function searchResultArray(int $limit = 0): ResultArray
    {

        if ($this->dataSet) {
            $this->getEventManager()->trigger(ArticleSearchEvent::EVENT_SEARCH, $this, ['data' => $this->dataSet]);
        }

        $select = $this->prepareSearchSelect();

//        if(DEBUG){
//            echo \Base\Utils\SqlFormatter::formatSelect($select);
//        }

        if($limit){
            $select->limit($limit);
        }

        if ($this->dataSet) {
            $this->getEventManager()->trigger(ArticleSearchEvent::EVENT_SEARCH_POST, $this, ['data' => $this->dataSet]);
        }

        return new ResultArray($this->getServiceLocator()->get('Article\Model\CmsNews')->getDataFromSelect($select, BaseModel::ENTITY_MODE));

    }

    /**
     * @param int $records
     * @return ResultPagination
     */
    public function searchResultPagination(int $records = 0): ResultPagination
    {

        if ($this->dataSet) {
            $this->getEventManager()->trigger(ArticleSearchEvent::EVENT_SEARCH, $this, ['data' => $this->dataSet]);
        }

        $select = $this->prepareSearchSelect();

        $adapter = new \Zend\Paginator\Adapter\DbSelect($select, \Base\Model\BaseModel::getStaticAdapter());
        $paginator = new ResultPagination($adapter);
        $paginator->setServiceLocator($this->getServiceLocator());
        if($records){
            $paginator->setItemCountPerPage($records);
        } else{
            $paginator->setItemCountPerPage($this->perPage);
        }
        $paginator->setCurrentPageNumber($this->page);
        $paginator->setPageRange(5);

        if ($this->dataSet) {
            $this->getEventManager()->trigger(ArticleSearchEvent::EVENT_SEARCH_POST, $this, ['data' => $this->dataSet]);
        }

        return $paginator;
    }

    public function searchResultDebug(){

        $select = $this->prepareSearchSelect();

        $select->limit(5);

        echo \Base\Utils\SqlFormatter::formatSelect($select);die;

        var_dump($select->getDataFromSelect($select)); die;

        return;

    }

    /**
     * @param CmsNewsEntity $news
     * @return CmsNewsEntity|null
     */
    public function getPreviousItem(CmsNewsEntity $news): ?CmsNewsEntity
    {

        $select = $this->prepareSearchSelect();

        $select->where([
            new Expression('(CASE WHEN n.publication_date = ? THEN (n.id > ?) ELSE 1 END)', [$news->getPublicationDate(), $news->getId()]),
            'n.id != ?' => $news->getId(),
            'n.publication_date <= ?' => $news->getPublicationDate()
        ]);

        $select->limit(1);

        $data = $this->getServiceLocator()->get('Article\Model\CmsNews')->getDataFromSelect($select, BaseModel::ENTITY_MODE);

        if(empty($data[0])){
            return null;
        }

        return $data[0];

    }

    /**
     * @param CmsNewsEntity $news
     * @return CmsNewsEntity|null
     */
    public function getNextItem(CmsNewsEntity $news): ?CmsNewsEntity
    {

        $select = $this->prepareSearchSelect();

        $select->reset('order');

        $select->order(["n.publication_date ASC","n.id ASC"]);

        $select->where([
            new Expression('(CASE WHEN n.publication_date = ? THEN (n.id < ?) ELSE 1 END)', [$news->getPublicationDate(),$news->getId()]),
            'n.id != ?' => $news->getId(),
            'n.publication_date >= ?' => $news->getPublicationDate()
        ]);

        $select->limit(1);

        $data = $this->getServiceLocator()->get('Article\Model\CmsNews')->getDataFromSelect($select, BaseModel::ENTITY_MODE);

        if(empty($data[0])){
            return null;
        }

        return $data[0];

    }

    /**
     * @return int
     */
    public function searchCount(): int
    {

        $this->prepareSearchSelect();

        $select = clone $this->searchSelect;

        if($this->czy_na_sprzedaz){
            $select->where(['ils.www_czy_na_sprzedaz' => true]);
        }

        $select2 = new \Zend\Db\Sql\Select();
        $select2->from(['n' => $select]);
        $select2->columns([
            'id' => new \Zend\Db\Sql\Predicate\Expression("'1'"),
            'ile' => new \Zend\Db\Sql\Predicate\Expression("count(n.id)"),

        ]);

        $data = $this->getServiceLocator()->get('Article\Model\CmsNews')->getDataFromSelect($select2);

        return (int) isset($data[0]['ile']) ?: 0;

    }

    /**
     * @param Select $select
     * @return ArticleSearch
     */
    protected function setSortToSelect(Select &$select): ArticleSearch {


        switch ($this->sort) {
            case 2:
                $select->order([new \Zend\Db\Sql\Predicate\Expression('n.publication_date DESC'), 'id ASC']);
                break;
            case 3:
                $select->reset('order');
                $c = count($this->sortParams);
                $select->order([
                    new \Zend\Db\Sql\Predicate\Expression('(SELECT count(id) FROM cms_news_category cnc3 WHERE cnc3.id_news = n.id AND cnc3.id_news_category_list IN ('.(new InArraySqlStatement($c)).')) DESC', $this->sortParams),
                    new \Zend\Db\Sql\Predicate\Expression('n.publication_date DESC'),
                    'id ASC']);
                //echo SqlFormatter::formatSelect($select);die;
                break;
            case 1:
            case 12:
            default:
                $select->order([new \Zend\Db\Sql\Predicate\Expression('n.publication_date ASC'), 'id DESC']);
                break;
        }

        return $this;

    }

    /**
     * @param int $sort
     * @return ArticleSearch
     */
    public function setSort(int $sort): ArticleSearch
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param array $sort
     * @return ArticleSearch
     */
    public function setSortParams(array $sort): ArticleSearch
    {
        $this->sortParams = $sort;
        return $this;
    }

    /**
     * @param int $limit
     * @return ArticleSearch
     */
    public function setLimit(int $limit): ArticleSearch
    {
        $this->limit = $limit;
        $this->perPage = $limit;
        return $this;
    }

    public function getEventManager() {
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->setIdentifiers(
            __CLASS__, get_called_class(), 'articleSearch'
        );

        $eventManager->setEventClass('Article\Search\ArticleSearchEvent');

        $this->eventManager = $eventManager;

        return $this;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}
