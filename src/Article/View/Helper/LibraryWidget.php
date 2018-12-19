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

class LibraryWidget extends AbstractHelper implements ServiceLocatorAwareInterface{

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

    public function __invoke() {

        $loggedUser = $this->getServiceLocator()->getServiceLocator()->get('UzytkownicyLoggedEntity');

        if(!$loggedUser){
            return array();
        }

        $search = $this->getServiceLocator()->getServiceLocator()->get('ArticleSearch')->create();

        $search->setData(array('library_in' => $loggedUser->getIdUzytkownik()));

        $result = array();
        $ids = $this->getServiceLocator()->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->getNewsByUser($loggedUser->getIdUzytkownik());
        $data =  $search->searchResultArray()->getCurrentEntities();
        if(!empty($ids)){
            foreach($ids as $id) {
                foreach ($data as $d) {
                    if ($id['id_cms_news'] == $d->getId()) {
                        array_push($result, $d);
                        break;
                    }
                }
            }
        }
        return array(
            'data' => $result
        );
    }

}