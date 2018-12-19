<?php
namespace Article\View\Helper;


use Article\Entity\CmsNewsCategoryListEntity;
use Article\Form\ArchitectureSearchForm;
use Article\Form\ArticleSearchFormAbstract;
use Article\Form\NewsSearchForm;
use Article\Form\ProductsSearchForm;
use Article\Search\Filter\CategorySlug;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MenuCategory extends AbstractHelper implements ServiceLocatorAwareInterface{

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function __invoke($slug, $params = array(), $template = 'partials/menu/default.phtml') {

        if(empty($slug)){
            return '';
        }

        $menu = $this->getServiceLocator()->getServiceLocator()->get('Base\Model\Menu')->getMenu($slug);
        $articles = $this->getServiceLocator()->getServiceLocator()->get('Article\Model\CmsNews')->getPromotionArticles();
        if(!$menu){
            return '';
        }

        foreach($menu as &$item){

            if($item['id_page']){
                continue;
            }

            if($item['url'] == ArchitectureSearchForm::$linkPrefix){

                $this->generateCategoryLinks($item, new ArchitectureSearchForm());

            }elseif($item['url'] == ProductsSearchForm::$linkPrefix){

                $this->generateProducentsLinks($item);
                $this->generateCategoryLinks($item, new ProductsSearchForm());

            }elseif($item['url'] == NewsSearchForm::$linkPrefix){

                $this->generateCategoryLinks($item, new NewsSearchForm());

            }
        }

        $params['menu'] = $menu;

        $resultArray = array();
        $promowanieId = 219;
        foreach($articles as $a){
            $categoriesAll = array();
            $tags = explode('|',$a['tags']);
            $categories = explode(',',$a['categories']);
            $parents = explode(',',$a['parent_id']);
            foreach($categories as $c){
                array_push($categoriesAll,$c);
            }
            foreach ($parents as $p){
                if(!in_array($p,$categoriesAll)){
                    array_push($categoriesAll,$p);
                }
            }
            if($tags[0] == $promowanieId){
                array_push($resultArray,array('article'=>$a,'categories'=>$categoriesAll,'url'=>'/architektura/'.$a['url'].','.$a['id'].'.html'));
            }
        }
        $params['articles'] = $resultArray;
        $helper = $this->getServiceLocator()->getServiceLocator()->get('viewhelpermanager');
        $partial = $helper->get("partial");

        return $partial->__invoke($template, $params);
    }

    protected function generateCategoryLinks(&$item, ArticleSearchFormAbstract $linkGenerator){

        $mainCategory = $this->getServiceLocator()->getServiceLocator()->get('Categories')->getMainCategoryByNewsType($linkGenerator->getType());

        if(!$mainCategory){
            return;
        }

        if(count($childs = $mainCategory->child()) > 0){

            if(empty($item['childs'])){
                $item['childs'] = array();
            }
            foreach($childs as $child){
                $item['childs']['c_'.$child->getId()] = $this->generateChildsLink($child, $linkGenerator);
            }

        }

        return;

    }

    protected function generateProducentsLinks(&$item){

        $producents = $this->getServiceLocator()->getServiceLocator()->get('Application\Model\CmsCompanyModel')->getAllCompaniesWithLimit(15);
        if(empty($item['childs'])){
            $item['childs'] = array();
        }

        $item['childs'][0] = array(
            'id'=>null,
            'name' => "Producenci",
            'slug' => "producenci",
            'is_active' => 1,
            'link_in_blank' => 0,
            'link_active' => 1,
            'url' => '/producenci',
            'photo_url' => null,
            'url_sufix' => null,
            'id_page' => false,
            'childs' => array()
        );
        foreach ($producents as $p) {
            array_push($item['childs'][0]['childs'],array(
                'id'=>null,
                'name' => $p['nazwa_firmy'],
                'slug' => mb_strtolower($p['nazwa_firmy']),
                'is_active' => 1,
                'link_in_blank' => 0,
                'link_active' => 1,
                'url' => '/company/detail/'.$p['id'],
                'photo_url' => $p['photo'],
                'url_sufix' => null,
                'id_page' => false));
        }
        array_push($item['childs'][0]['childs'],array(
            'id'=>null,
            'name' => 'Zobacz więcej',
            'slug' => 'all',
            'is_active' => 1,
            'link_in_blank' => 0,
            'link_active' => 1,
            'url' => '/producenci',
            'photo_url' => null,
            'url_sufix' => null,
            'id_page' => false));
    }

    protected function generateChildsLink(CmsNewsCategoryListEntity $category, ArticleSearchFormAbstract $linkGenerator){

        $ret = array(
            'id'=>$category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
            'is_active' => 1,
            'link_in_blank' => 0,
            'link_active' => 1,
            'url' => $linkGenerator->prepareLinkWithAdditionalParam(CategorySlug::INPUT_NAME, $category->getSlug()),
            'photo_url' => null,
            'url_sufix' => null,
            'id_page' => false
        );

        if(count($childs = $category->child()) > 0){
            $ret['childs'] = array();
            foreach ($childs as $child){
                $ret['childs'][] = $this->generateChildsLink($child, $linkGenerator);
            }
        }

        return $ret;

    }

}