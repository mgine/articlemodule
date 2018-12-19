<?php

namespace Article\Search\Result;

use Article\Entity\CmsNewsEntity;

class ResultArray implements ResultInterface{

    protected $serviceLocator;

    protected $items;

    /**
     * ResultArray constructor.
     * @param array $items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getCurrentEntities(): array
    {
        return (array) $this->items;
    }

    /**
     * @return CmsNewsEntity|null
     */
    public function getFirstEntity(): ?CmsNewsEntity
    {
        foreach ($this->items as $entity){
            return $entity;
        }

        return null;

    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        $entities = [];
        foreach ($this->items as $entity){
            array_push($entities,$entity);
        }
        return $entities;
    }


    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}
