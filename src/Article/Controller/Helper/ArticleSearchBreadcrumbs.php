<?php

namespace Article\Controller\Helper;

use Article\Entity\CmsNewsEntity;
use Article\Form\ArticleSearchFormAbstract;
use Base\View\Helper\Breadcrumbs;

class ArticleSearchBreadcrumbs{

    protected $articleSearchForm;

    protected $breadcrumbs;

    public function __construct(Breadcrumbs $breadcrumbs, ArticleSearchFormAbstract $articleSearchForm)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->articleSearchForm = $articleSearchForm;

    }

    public function prepareFirstLevel($title){
        $this->breadcrumbs->appendPage(array(
            'href' => $this->articleSearchForm->prepareLinkWithData(array(), false),
            'text' =>  $title
        ));
        return $this;
    }

    public function prepare(){

        $currArr = array();
        $data = $this->articleSearchForm->getLinkData();
        foreach($this->articleSearchForm->getLinkParamsInOrder() as $value){
            if($value == $this->articleSearchForm->getCategorySlug()){
                if(empty($data[$value])){
                    continue;
                }
                $category = $this->articleSearchForm->getServiceLocator()->get('Categories')->getCategoryBySlug($data[$value]);

                if($category){
                    $currArr[$this->articleSearchForm->getCategorySlug()] = $category->getSlug();
                    $this->breadcrumbs->appendPage(array(
                        'href' => $this->articleSearchForm->prepareLinkWithData($currArr, false),
                        'text' => $category->getName()
                    ));
                }
            }elseif(!empty($data[$value])){
                $tag = $this->articleSearchForm->getTagByGroupSlugAndTagSlug($value, $data[$value]);

                if(!$tag){
                    continue;
                }

                $currArr[$value] = $tag->slug;
                $this->breadcrumbs->appendPage(array(
                    'href' => $this->articleSearchForm->prepareLinkWithData($currArr, false),
                    'text' => $tag->nazwa
                ));
            }
        }
        if($this->articleSearchForm->hasQueryParams()){
            $this->breadcrumbs->appendPage(array(
                'text' =>  'Wyniki wyszukiwania'
            ));
        }
        return $this;
    }

    public function prepareWithArticle( CmsNewsEntity $article){

        $tags =  $article->getTags();

        $category = $article->getMainCategory();

        $currArr = array();

        if($category){
            $currArr[$this->articleSearchForm->getCategorySlug()] = $category->getSlug();
            $this->breadcrumbs->appendPage(array(
                'href' => $this->articleSearchForm->prepareLinkWithData($currArr, false),
                'text' => $category->getName()
            ));
        }


        foreach($this->articleSearchForm->getLinkParamsInOrder() as $value){
            if($tags->hasTagInGroup($value)){
                $tag = $tags->getFirstTagInGroup($value);
                $currArr[$value] = $tag->slug;
                $this->breadcrumbs->appendPage(array(
                    'href' => $this->articleSearchForm->prepareLinkWithData($currArr, false),
                    'text' => $tag->nazwa
                ));
            }
        }

        return $this;
    }

}