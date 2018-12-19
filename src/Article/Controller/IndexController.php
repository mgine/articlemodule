<?php

namespace Article\Controller;

use Article\Controller\Helper\ArticleSearchBreadcrumbs;
use Article\Form\ArchitectureSearchForm;
use Article\Form\NewsSearchForm;
use Article\Form\ProductsSearchForm;
use Article\Search\Filter\Bim;
use Article\Search\Filter\CategoryId;
use Article\Search\Filter\ExcludeId;
use Article\Search\Filter\Sg;
use Article\Search\Filter\TagSlug;
use Article\Search\Filter\Text;
use Article\Search\Filter\Typ;
use Base\View\Model\PagesModel;
use Zend\View\Model\ViewModel;

class IndexController extends \Zend\Mvc\Controller\AbstractActionController
{
    public function indexAction(){

    }


    public function searchAction() {

        $data = $this->params()->fromQuery();

        if ($this->request->isPost()) {
            $data = array_merge($data, $this->request->getPost()->toArray());
        }

        if( $this->params()->fromRoute(Typ::INPUT_NAME, false)){
            $data[Typ::INPUT_NAME] = $this->params()->fromRoute(Typ::INPUT_NAME);
        }

        $searchService = $this->getServiceLocator()->get('ArticleSearch')->create();


        if($this->params()->fromRoute('page')){
            $searchService->setPage($this->params()->fromRoute('page'));
        }
        if($this->params()->fromRoute('records')){
            $searchService->setPerPage($this->params()->fromRoute('records'));
        }

        $searchService->setData($data);

        $advertsNews = false;
        $advertsVertical = false;

        if($this->getServiceLocator()->has('Advert\Service\AdvertsGenerator')){
            $advertGenerator = $this->getServiceLocator()->get('Advert\Service\AdvertsGenerator');
            if(!$this->mobileDetect()->isMobile()){
                $advertsNews = $advertGenerator->generate(array(
                    'like' => 'prawa_kolumna%'
                ));
                $advertsVertical = $advertGenerator->generate(array(
                    'like' => 'baner_poziomy%'
                ));
            }else{

                $advertsNews = false;
                $advertsVertical = $advertGenerator->generate(array(
                    'like' => 'mobile_baner_poziomy%'
                ));
            }
        }

        $view = new ViewModel(array(
            'params' => $data,
            'paginator' => $searchService->searchResultPagination(),
            'search' => $searchService,
            'page_name' => $this->params()->fromRoute('page_name', false),
            'page_sufix' => $this->params()->fromRoute('sufix', false),
            'formActive' => $this->params()->fromRoute('form', false),
            'page' => $searchService->getPage(),
            'records' => $searchService->getPerPage(),
            'adverts' => $advertsNews,
            'advertsVertical' => $advertsVertical,
            'options' => array('query' => $data)
        ));

        if($template = $this->params()->fromRoute('template')){
            $view->setTemplate('article/index/'.$template.'.phtml');
        }

        return $view;

    }

    public function detail1Action(){


        $breadcrumbs = $this->getServiceLocator()->get('viewhelpermanager')->get('breadcrumbs');

        $article = $this->getServiceLocator()->get('Article\Model\CmsNews')->getEntity((int)$this->params()->fromRoute('id', 0), !$this->params()->fromQuery("active", false));

        if (!$article) {
            return $this->notFoundAction(); //$this->createHttpNotFoundModel($this->response);
        }
        $this->metaTags(array(
            'meta_title' => $article->getMetaTitle(),
            'meta_description' => $article->getMetaDescription(),
            'meta_keywords' => $article->getMetaKeywords()
        ));

        $form = new ArchitectureSearchForm();
        $articleBreadcrumbsHelper = new ArticleSearchBreadcrumbs($breadcrumbs, $form);
        $articleBreadcrumbsHelper->prepareFirstLevel( 'Architektura')
            ->prepareWithArticle( $article);

        $breadcrumbs
           // ->appendPage(array('href' => $this->url, 'text' =>  $this->name))
            ->appendPage(array('text' => $article->getTitle()));

        $adverts = false;
        if($this->getServiceLocator()->has('Advert\Service\AdvertsGenerator')){
            $advertGenerator = $this->getServiceLocator()->get('Advert\Service\AdvertsGenerator');
            $adverts = $advertGenerator->generate(array(
                'like' => ($this->mobileDetect()->isMobile() ? 'mobile_' : '').'artykul_%'
            ));
            $showParams = array(
                'article_type' => $article->getIdNewsType(),
                'article_id' => $article->getId(),
                'category_ids' => $article->getCategoryIdsWithChild(),
                'recursive_category_ids' => array()

            );
            foreach($article->getCategory() as $category){
                $showParams['recursive_category_ids'][] = $category->getId();
            }

            $adverts->addShowParams($showParams);
            $article->prepareContentWithAdverts($adverts);
        }

        $searchService = $this->getServiceLocator()->get('ArticleSearch')->create();

        $view = new ViewModel(array(
            "pg" => $article,
            'adverts' => $adverts,
            'nextItem' => $searchService->getNextItem($article),
            'previousItem' => $searchService->getPreviousItem($article)
        ));


        return $view;

    }

    public function detail2Action(){


        $breadcrumbs = $this->getServiceLocator()->get('viewhelpermanager')->get('breadcrumbs');

        $article = $this->getServiceLocator()->get('Article\Model\CmsNews')->getEntity((int)$this->params()->fromRoute('id', 0), !$this->params()->fromQuery("active", false));

        if (!$article) {
            return $this->notFoundAction(); //$this->createHttpNotFoundModel($this->response);
        }
        $this->metaTags(array(
            'meta_title' => $article->getMetaTitle(),
            'meta_description' => $article->getMetaDescription(),
            'meta_keywords' => $article->getMetaKeywords()
        ));


        $form = new ProductsSearchForm();
        $articleBreadcrumbsHelper = new ArticleSearchBreadcrumbs($breadcrumbs, $form);
        $articleBreadcrumbsHelper->prepareFirstLevel( 'Produkty')
            ->prepareWithArticle($article);

        $breadcrumbs
            // ->appendPage(array('href' => $this->url, 'text' =>  $this->name))
            ->appendPage(array('text' => $article->getTitle()));

        $adverts = false;
        if($this->getServiceLocator()->has('Advert\Service\AdvertsGenerator')){
            $advertGenerator = $this->getServiceLocator()->get('Advert\Service\AdvertsGenerator');
            $adverts = $advertGenerator->generate(array(
                'like' =>  ($this->mobileDetect()->isMobile() ? 'mobile_' : '').'artykul_%'
            ));
            $showParams = array(
                'article_type' => $article->getIdNewsType(),
                'article_id' => $article->getId(),
                'category_ids' => $article->getCategoryIdsWithChild(),
                'recursive_category_ids' => array()

            );
            foreach($article->getCategory() as $category){
                $showParams['recursive_category_ids'][] = $category->getId();
            }
            $adverts->addShowParams($showParams);

            $article->prepareContentWithAdverts($adverts);
        }

        $searchService = $this->getServiceLocator()->get('ArticleSearch')->create();

        $view = new ViewModel(array(
            "pg" => $article,
            'adverts' => $adverts,
            'nextItem' => $searchService->getNextItem($article),
            'previousItem' => $searchService->getPreviousItem($article)
        ));

        $view->setTemplate('article/index/detail1');

        return $view;
    }

    public function detail3Action(){


        $breadcrumbs = $this->getServiceLocator()->get('viewhelpermanager')->get('breadcrumbs');

        $active = ($this->params()->fromQuery("active", false) and ($this->params()->fromQuery("active", false) == 'd41d8cd98f00b204e9800998ecf8427e')) ? false : true;

        $article = $this->getServiceLocator()->get('Article\Model\CmsNews')->getEntity((int)$this->params()->fromRoute('id', 0), $active);

        if (!$article) {
            return $this->notFoundAction(); //$this->createHttpNotFoundModel($this->response);
        }
        $this->metaTags(array(
            'meta_title' => $article->getMetaTitle(),
            'meta_description' => $article->getMetaDescription(),
            'meta_keywords' => $article->getMetaKeywords()
        ));


        $form = new NewsSearchForm();

        $articleBreadcrumbsHelper = new ArticleSearchBreadcrumbs($breadcrumbs, $form);
        $articleBreadcrumbsHelper->prepareFirstLevel('Newsy')
            ->prepareWithArticle($article);

        $breadcrumbs
            // ->appendPage(array('href' => $this->url, 'text' =>  $this->name))
            ->appendPage(array('text' => $article->getTitle()));

        $adverts = false;
        if($this->getServiceLocator()->has('Advert\Service\AdvertsGenerator')){
            $advertGenerator = $this->getServiceLocator()->get('Advert\Service\AdvertsGenerator');
            $adverts = $advertGenerator->generate(array(
                'like' =>  ($this->mobileDetect()->isMobile() ? 'mobile_' : '').'artykul_%'
            ));
            $showParams = array(
                'article_type' => $article->getIdNewsType(),
                'article_id' => $article->getId(),
                'category_ids' => $article->getCategoryIdsWithChild(),
                'recursive_category_ids' => array()

            );
            foreach($article->getCategory() as $category){
                $showParams['recursive_category_ids'][] = $category->getId();
            }
            $adverts->addShowParams($showParams);
            $article->prepareContentWithAdverts($adverts);
        }

        $searchService = $this->getServiceLocator()->get('ArticleSearch')->create();

        $view = new ViewModel(array(
            "pg" => $article,
            'adverts' => $adverts,
            'nextItem' => $searchService->getNextItem($article),
            'previousItem' => $searchService->getPreviousItem($article)
        ));

        $view->setTemplate('article/index/detail1');

        return $view;
    }

    public function advertlistAction(){

        $params = $this->params()->fromRoute();
//var_dump($params);
        $searchParams = array();

        if(!empty($params[Sg::INPUT_NAME])){
            $searchParams[Sg::INPUT_NAME] = true;
        }

        if(!empty($params[CategoryId::INPUT_NAME])){
            $searchParams[CategoryId::INPUT_NAME] = explode('|', $params[CategoryId::INPUT_NAME]);
        }

        if(!empty($params[TagSlug::INPUT_NAME])){
            $searchParams[TagSlug::INPUT_NAME] = explode('|', $params[TagSlug::INPUT_NAME]);
        }

        if(!empty($params['article_type']) and !empty($params['from_current_type'])){
            $searchParams[Typ::INPUT_NAME] = $params['article_type'];
        }
        if(!empty($params[Typ::INPUT_NAME])){
            $searchParams[Typ::INPUT_NAME] = $params[Typ::INPUT_NAME];
        }

        if(!empty($params[ExcludeId::INPUT_NAME])){
            $searchParams[ExcludeId::INPUT_NAME] = $params[ExcludeId::INPUT_NAME];
        }elseif(!empty($params['article_id'])){
            $searchParams[ExcludeId::INPUT_NAME] = array($params['article_id']);
        }

        $limit = empty($params['limit']) ? 5 : $params['limit'];

        $service = $this->getServiceLocator()->get('ArticleSearch')
            ->create()
            ->setData($searchParams);//->searchResultDebug()


        if(!empty($params['from_current_category']) && !empty($params['category_ids'])){
            $service->setSort(3);
            $service->setSortParams($params['category_ids']);
        }

        $result = $service->searchResultArray($limit);

        $viewModel = new ViewModel(array(
            'result' => $result->getCurrentEntities()
            ));

        $viewModel->setTemplate('article/index/advert/'.(!empty($params['template']) ? $params['template'] : 'list'));


        return $viewModel;
    }

    public function searcharchitectureAction(){
        $customPerPage = 30;
        $routeParams = $this->params()->fromRoute('params', false);
        $params = $routeParams == '/' ? '' : $routeParams;
        $text = $this->params()->fromQuery(Text::INPUT_NAME);

        $form = new ArchitectureSearchForm();
        $form->setServiceLocator($this->getServiceLocator());
        $form->setLinkParams($params, array(
            Text::INPUT_NAME => $text
        ));

        if(!$form->isValid()){
            return $this->notFoundAction();
        }

//        if(($curLink = $form->prepareCurrentLink()) != $this->getRequest()->getRequestUri()){
//            return $this->redirect()->toUrl($curLink);
//        }

        $breadcrumbs = $this->getServiceLocator()->get('viewhelpermanager')->get('breadcrumbs');

        $articleBreadcrumbsHelper = new ArticleSearchBreadcrumbs($breadcrumbs, $form);
        $articleBreadcrumbsHelper->prepareFirstLevel('Architektura')
            ->prepare();

        $data = $form->getData();

        $searchService = $this->getServiceLocator()->get('ArticleSearch')->create();


        if($this->params()->fromQuery('page')){
            $searchService->setPage($this->params()->fromQuery('page'));
        }
        if($this->params()->fromQuery('records')){
            $searchService->setPerPage($this->params()->fromQuery('records'));
        }

        $searchService->setData($data);

        $view = new PagesModel(array(
            'params' => $data,
            'routeParams' => $routeParams,
            'paginator' => $searchService->searchResultPagination($customPerPage),
            'search' => $searchService,
            'page' => $searchService->getPage(),
            'records' => $searchService->getPerPage(),
            'form' => $form
        ));

        $view->setTitle('Architektura');
        $view->setPage('default');

        return $view;

    }

    public function searchproductsAction(){

        $customPerPage = 30;
        $routeParams = $this->params()->fromRoute('params', false);
        $params = $routeParams == '/' ? '' : $routeParams;
        $text = $this->params()->fromQuery(Text::INPUT_NAME);
        $bim = $this->params()->fromQuery(Bim::INPUT_NAME);

        $form = new ProductsSearchForm();
        $form->setServiceLocator($this->getServiceLocator());
        $form->setLinkParams($params, array(
            Text::INPUT_NAME => $text,
            Bim::INPUT_NAME => $bim
        ));

        if(!$form->isValid()){
            return $this->notFoundAction();
        }

//        if(($curLink = $form->prepareCurrentLink()) == $this->getRequest()->getRequestUri()){
//            return $this->redirect()->toUrl($curLink);
//        }

        $breadcrumbs = $this->getServiceLocator()->get('viewhelpermanager')->get('breadcrumbs');

        $articleBreadcrumbsHelper = new ArticleSearchBreadcrumbs($breadcrumbs, $form);
        $articleBreadcrumbsHelper->prepareFirstLevel('Produkty')
            ->prepare();

        $data = $form->getData();

        $searchService = $this->getServiceLocator()->get('ArticleSearch')->create();




        if($this->params()->fromQuery('page')){
            $searchService->setPage($this->params()->fromQuery('page'));
        }
        if($this->params()->fromQuery('records')){
            $searchService->setPerPage($this->params()->fromQuery('records'));
        }

        $searchService->setData($data);
        $mainPage = (empty($params) and empty($text) and empty($bim));
        $withBinArticle = false;
        if($mainPage){
            $withBinArticle = $this->getServiceLocator()->get('ArticleSearch')->create()->setData(array(
                Bim::INPUT_NAME => 1,
                Typ::INPUT_NAME => 2
            ))->searchResultArray(3);
        }

        $view = new PagesModel(array(
            'params' => $data,
            'routeParams' => $routeParams,
            'paginator' => $searchService->searchResultPagination($customPerPage),
            'search' => $searchService,
            'page' => $searchService->getPage(),
            'records' => $searchService->getPerPage(),
            'form' => $form,
            'withBinArticle' => $withBinArticle,
            'mainPage' => $mainPage
        ));

        $view->setTitle('Architektura');
        $view->setPage('default');

        return $view;

    }

    public function searchnewsAction(){
        $customPerPage = 30;
        $routeParams = $this->params()->fromRoute('params', false);
        $params = $routeParams == '/' ? '' : $routeParams;
        $text = $this->params()->fromQuery(Text::INPUT_NAME);

        $form = new NewsSearchForm();
        $form->setServiceLocator($this->getServiceLocator());
        $form->setLinkParams($params, array(
            Text::INPUT_NAME => $text
        ));

        if(!$form->isValid()){
            return $this->notFoundAction();
        }

        if(($curLink = $form->prepareCurrentLink()) != $this->getRequest()->getRequestUri()){
            return $this->redirect()->toUrl($curLink);
        }

        $breadcrumbs = $this->getServiceLocator()->get('viewhelpermanager')->get('breadcrumbs');

        $articleBreadcrumbsHelper = new ArticleSearchBreadcrumbs($breadcrumbs, $form);
        $articleBreadcrumbsHelper->prepareFirstLevel('Newsy')
            ->prepare();


        $data = $form->getData();

        $searchService = $this->getServiceLocator()->get('ArticleSearch')->create();


        if($this->params()->fromQuery('page')){
            $searchService->setPage($this->params()->fromQuery('page'));
        }
        if($this->params()->fromQuery('records')){
            $searchService->setPerPage($this->params()->fromQuery('records'));
        }

        $searchService->setData($data);

        $view = new PagesModel(array(
            'params' => $data,
            'routeParams' => $routeParams,
            'paginator' => $searchService->searchResultPagination($customPerPage),
            'search' => $searchService,
            'page' => $searchService->getPage(),
            'records' => $searchService->getPerPage(),
            'form' => $form
        ));

        $view->setTitle('Aktualności');
        $view->setPage('default');

        return $view;

    }
}
