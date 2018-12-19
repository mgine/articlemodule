<?php

namespace Article\Service;

use Article\Entity\CmsNewsCategoryListEntity;
use \Zend\ServiceManager\ServiceLocatorAwareInterface;

class CategoriesService implements ServiceLocatorAwareInterface{

    protected $serviceLocator;

    protected $categoriesList = array();

    protected $categoriesListSlug = array();

    protected $categoriesTree = false;

    protected function init(){

        $allEntities = $this->getServiceLocator()->get('Article\Model\CmsNewsCategoryList')->getAllEntities();

        foreach($allEntities as $entity){
            $this->categoriesList[$entity->getId()] = $entity;
            $this->categoriesListSlug[$entity->getSlug()] = $entity;
            if(!$entity->getIdParent()){
                $this->categoriesTree = $entity;
            }
        }
        if($this->categoriesTree){
            $this->categoriesTree->prepareChildEntities($allEntities);
        }
    }

    /**
     * @param int $id
     * @return CmsNewsCategoryListEntity|null
     */
    public function getCategoryById(int $id): ?CmsNewsCategoryListEntity{

        if(empty($this->categoriesList[$id])){
            return null;
        }

        return $this->categoriesList[$id];
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getCategoryByIds(array $ids): array{

        $ret = [];

        foreach($ids as $id){

            if(!empty($this->categoriesList[$id])){
                $ret[] = $this->categoriesList[$id];
            }
        }

        return $ret;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getCategoryMakeUpWithParentsByIds(array $ids): array{

        $ret = [];

       foreach($this->getCategoryByIds($ids) as $category){
           $ret[$category->getId()] = $category;
           foreach($category->getParentCategories() as $parent){
               $ret[$parent->getId()] = $parent;
           }
       }

        return $ret;
    }

    /**
     * @return array
     */
    public function getAttributesOptions(): array{

        $ret = [];

        foreach($this->categoriesList as $entity){
            $ret[$entity->getId()] = $entity->getName();
        }

        return $ret;

    }

    /**
     * @return array
     */
    public function getAttributesOptionsWithSlugs(): array{

        $ret = [];

        foreach($this->categoriesList as $entity){
            $ret[$entity->getSlug()] = $entity->getName();
        }

        return $ret;

    }

    /**
     * @param string $slug
     * @return CmsNewsCategoryListEntity|null
     */
    public function getCategoryBySlug(string $slug): ?CmsNewsCategoryListEntity{

        if(empty($this->categoriesListSlug[$slug])){
            return null;
        }

        return $this->categoriesListSlug[$slug];

    }

    /**
     * @param array $ids
     * @return array
     */
    public function getCategoryIdsMakeUpWithChildsIds(array $ids): array{

        $ret = [];

        foreach ($ids as $idMain){
            if(empty($this->categoriesList[$idMain])){
                continue;
            }
            foreach($this->getCategoryById($idMain)->getCategoryAndChildIds() as $id){
                if(!in_array($id, $ret)){
                    $ret[] = $id;
                }
            }
        }

        return $ret;

    }

    /**
     * @param int $idNewsType
     * @return CmsNewsCategoryListEntity
     */
    public function getMainCategoryByNewsType(int $idNewsType): CmsNewsCategoryListEntity{

        $mainCategoryId = $this->getServiceLocator()->get('Article\Model\CmsNewsType')->getMainCategoryIdByNewsType($idNewsType);

        if(!$mainCategoryId){
            return null;
        }

        return $this->getCategoryById($mainCategoryId);

    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->serviceLocator = $serviceLocator;
        $this->init();
        return $this;
    }
}
