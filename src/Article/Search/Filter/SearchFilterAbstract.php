<?php

namespace Article\Search\Filter;

abstract class SearchFilterAbstract implements \Zend\ServiceManager\ServiceLocatorAwareInterface {
    
    protected $serviceLocator;
    
    protected $mainTableAlias;
    
    protected $doSearchFilter = false;

    const INPUT_NAME = self::class;

    /**
     * @param string $alias
     * @return SearchFilterAbstract
     */
    public function setMainTableAlias(string $alias): SearchFilterAbstract
    {

        $this->mainTableAlias = $alias;
        return $this;

    }

    public function init(){}

    /**
     * @return string
     */
    public function getInputName():string
    {
        return self::INPUT_NAME;
    }

    /**
     * @param \Zend\Form\Form $form
     * @return SearchFilterAbstract
     */
    abstract public function prepareFormElements(\Zend\Form\Form &$form): SearchFilterAbstract;

    /**
     * @param \Zend\InputFilter\InputFilter $filter
     * @return SearchFilterAbstract
     */
    abstract public function prepareFormFilter(\Zend\InputFilter\InputFilter &$filter): SearchFilterAbstract;

    /**
     * @param array $data
     * @return SearchFilterAbstract
     */
    abstract public function setData(array $data): SearchFilterAbstract;

    /**
     * @param \Zend\Db\Sql\Select $select
     * @return bool
     */
    abstract public function prepareSelect(\Zend\Db\Sql\Select &$select): bool;

    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return $this
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $this->serviceLocator = $serviceLocator;
        
        $this->init();
        
        return $this;
    }

}