<?php

namespace Article\Search\Result;

class ResultPagination extends \Zend\Paginator\Paginator implements ResultInterface{

    protected $serviceLocator;

    /**
     * @return array
     */
    public function getCurrentEntities(): array
    {

        $items = $this->getCurrentItems();

        foreach($items as $key=>$value){
            $items[$key] = $this->getServiceLocator()->get('Article\Model\CmsNews')->createEntityFromData((array)$value);
        }

        return (array) $items;

    }
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}
