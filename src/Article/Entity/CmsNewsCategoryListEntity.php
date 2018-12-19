<?php

namespace Article\Entity;

class CmsNewsCategoryListEntity extends \Article\Entity\Base\CmsNewsCategoryListEntityBase
{

    protected $childEntities = array();

    protected $parent;

    public function child(): array{
        return $this->childEntities;
    }

    public function childRecursive(): array{

        $ret = array();

        foreach($this->childEntities as $entity){
            $ret[$entity->getId()] = $entity;
            foreach($entity->childRecursive() as $entity){
                if(empty($ret[$entity->getId()])){
                    $ret[$entity->getId()] = $entity;
                }
            }
        }

        return $ret;
    }

    public function prepareChildEntities(array &$entitiesList){

        foreach ($entitiesList as $entity){

            if($entity->getIdParent() == $this->getId()){
                $entity->prepareChildEntities($entitiesList);
                $this->childEntities[] =  $entity;
            }

            if($this->getIdParent() == $entity->getId()){
                $this->parent = $entity;
            }

        }

        return;
    }

    public function getCategoryAndChildIds(): array{

        $ids = array($this->getId());

        foreach($this->childEntities as $entity){
            $ids[] = $entity->getId();
            foreach($entity->getCategoryAndChildIds() as $id){
                if(!in_array($id, $ids)){
                    $ids[] = $id;
                }
            }
        }

        return $ids;

    }

    public function getCategoryAndChildSlugs(): array{

        $slugs = array($this->getSlug());

        foreach($this->childEntities as $entity){
            $slugs[] = $entity->getSlug();
            foreach($entity->getCategoryAndChildSlugs() as $slug){
                if(!in_array($slug, $slugs)){
                    $slugs[] = $slug;
                }
            }
        }

        return $slugs;

    }

    public function getSlug(): string
    {
        $slug =  parent::getSlug();

        if(empty($slug)){
            return $slug = 'slug_'.$this->getId();
        }

        return $slug;

    }

    public function getParent(): ?CmsNewsCategoryListEntity{
        return $this->parent;
    }

    public function getParentCategories(): array{

         return $this->getParent() ? $this->getParent()->getParentCategoriesWithCurrent() : array();

    }
    public function getParentCategoriesWithCurrent(): array{

        if($this->getParent()){
            $ret = $this->getParent()->getParentCategoriesWithCurrent();
        }else{
            $ret = array();
        }

        $ret[] = $this;

        return $ret;
    }

}