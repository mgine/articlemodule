<?php

namespace Article\Service;

use Article\Search\Filter\SearchFilterAbstract;
use \Zend\ServiceManager\ServiceLocatorAwareInterface;

class ArticleSearch implements ServiceLocatorAwareInterface{

    protected $serviceLocator;


    protected $searchFilers = [
        'Typ' => 'Article\Search\Filter\Typ',
        'TagSlug' => 'Article\Search\Filter\TagSlug',
        'Sg' => 'Article\Search\Filter\Sg',
        'CategoryId' => 'Article\Search\Filter\CategoryId',
        'CategorySlug' => 'Article\Search\Filter\CategorySlug',
        'Text' => 'Article\Search\Filter\Text',
        'InLibrary' => 'Article\Search\Filter\LibraryIn',
        'ExcludeId' => 'Article\Search\Filter\ExcludeId',
        'Bim' => 'Article\Search\Filter\Bim'
    ];

    public function create(): \Article\Search\ArticleSearch{

        $search = new \Article\Search\ArticleSearch();
        $search->setServiceLocator($this->getServiceLocator());

        foreach ($this->searchFilers as $key => $filtrClass) {

            $filtrObj = false;

            if($this->getServiceLocator()->has($filtrClass)){
                $filtrObj = $this->getServiceLocator()->get($filtrClass);

            }else if(class_exists($filtrClass)){
                $filtrObj = new $filtrClass();
            }

            if(!$filtrObj || !($filtrObj instanceof SearchFilterAbstract )){
                throw new \Exception('Incorect SearchFilter type is set to ArticleSearch ');
            }

            if(!$filtrObj->getServiceLocator()){
                $filtrObj->setServiceLocator($this->serviceLocator);
            }

            $search->addSearchFilter($filtrObj);

        }

        $search->init();

        return $search;

    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}
