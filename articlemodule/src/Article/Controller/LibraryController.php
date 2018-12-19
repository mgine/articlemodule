<?php

namespace Article\Controller;

use Article\Form\ArchitectureSearchForm;
use Article\Form\LibraryAddForm;
use Article\Form\ProductsSearchForm;
use Article\Search\Filter\CategoryId;
use Article\Search\Filter\Sg;
use Article\Search\Filter\TagSlug;
use Article\Search\Filter\Text;
use Article\Search\Filter\Typ;
use Base\View\Model\PagesModel;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class LibraryController extends \Zend\Mvc\Controller\AbstractActionController
{

    public function addAction(){

        $loggedUser = $this->getServiceLocator()->get('UzytkownicyLoggedEntity');

        if(!$loggedUser){
            $this->getServiceLocator()->get('RedirectSessionKeep')->addAfterLoginRedirect($this->url()->fromRoute('library/add'));
            $this->msg()->info('Zaloguj się, aby zarządzać biblioteką.');
            return $this->redirect()->toUrl($this->urlbyslug('logowanie'));
        }

        $news = $this->getServiceLocator()->get('Article\Model\CmsNews')->getEntity($this->params()->fromPost('id_news', 0));

        if(!$news){
            return $this->notFoundAction();
        }

        $form = new LibraryAddForm();

        $form->setData($this->getRequest()->getPost());

        if($form->isValid()){

            $data = $form->getData();

            if(!$news){
                return $this->notFoundAction();
            }

            if(!$this->getServiceLocator()->get('Library')->haveInLibrary($loggedUser, $news)){
                $this->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->insert(
                    array(
                        'id_cms_news' => $news->getId(),
                        'id_uzytkownicy' => $loggedUser->getIdUzytkownik(),
                        'describe' => $data['description']
                    )
                );
            }else{
                $this->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->update(
                    array(
                        'describe' => $data['description']
                    ),
                    array(
                        'id_cms_news' => $news->getId(),
                        'id_uzytkownicy' => $loggedUser->getIdUzytkownik(),
                    )
                );
            }



            if($this->params()->fromQuery('backpanel')){
                $this->msg()->success('Aktualizacja przebiegła pomyślnie');
                return $this->redirect()->toUrl($_SERVER['HTTP_REFERER']);
            }
            $this->msg()->success('Pomyślnie dodano do biblioteki');
            return $this->redirect()->toUrl($_SERVER['HTTP_REFERER']);

        }

        $model = new PagesModel(array(
            'pg' => $news,
            'form' => $form->prepare()
        ));



        $model->setTitle('Dodaj do biblioteki');
        $model->setPage('panel');

        return $model;

    }
    public function addajaxAction(){

        $id_news = $this->params()->fromRoute('id');

        $news = $this->getServiceLocator()->get('Article\Model\CmsNews')->getEntity($id_news);

        if(!$news){
            return $this->notFoundAction();
        }

        $loggedUser = $this->getServiceLocator()->get('UzytkownicyLoggedEntity');

        if(!$loggedUser){
            $this->getServiceLocator()->get('RedirectSessionKeep')->addAfterLoginRedirect($news->url());
            //$this->msg()->info('Zaloguj się, aby zarządzać biblioteką.');
            echo 0; die;
        }
//
//        if($this->getServiceLocator()->get('Library')->haveInLibrary($loggedUser, $news)){
//            return $this->notFoundAction();
//        }

        $libraryEntity = $this->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->getEntityByUserAndNews($loggedUser, $news);

        $form = new LibraryAddForm();

        $form->setData(array(
            'id_news' => $news->getId(),
            'description' => $libraryEntity ? $libraryEntity->getDescribe() : ''
        ));

        $form->setAttribute('action', $this->url()->fromRoute('library/add').($this->params()->fromQuery('backpanel') ? '?backpanel=1' : ''));

        $view = new ViewModel(array(
            'pg' => $news,
            'form' => $form->prepare()
        ));

        $view->setTerminal(true);

        $view->setTemplate('article/library/add');

        return $view;

    }

    public function removeAction(){

        $loggedUser = $this->getServiceLocator()->get('UzytkownicyLoggedEntity');

        if(!$loggedUser){
            $this->getServiceLocator()->get('RedirectSessionKeep')->addAfterLoginRedirect($this->url()->fromRoute('library'));
            $this->msg()->info('Zaloguj się, aby zarządzać biblioteką.');
            return $this->redirect()->toUrl($this->urlbyslug('logowanie'));
        }

        $id_news = $this->params()->fromRoute('id');
        $news = $this->getServiceLocator()->get('Article\Model\CmsNews')->getEntity($id_news);

        if(!$news){
            return $this->notFoundAction();
        }

        $libraryEntity = $this->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->getEntityByUserAndNews($loggedUser, $news);

        if($libraryEntity){
            $this->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->delete(
                array(
                    'id' => $libraryEntity->getId()
                )
            );
        }

            $this->msg()->success('Usunięto pomyślnie');
            return $this->redirect()->toUrl($_SERVER['HTTP_REFERER']);

    }

    public function listAction(){

        $loggedUser = $this->getServiceLocator()->get('UzytkownicyLoggedEntity');

        if(!$loggedUser){
            $this->getServiceLocator()->get('RedirectSessionKeep')->addAfterLoginRedirect($this->url()->fromRoute('library'));
            $this->msg()->info('Zaloguj się, aby zarządzać biblioteką.');
            return $this->redirect()->toUrl($this->urlbyslug('logowanie'));
        }

        $search = $this->getServiceLocator()->get('ArticleSearch')->create();

        $search->setData(array('library_in' => $loggedUser->getIdUzytkownik()));
        $result = array();

        $ids = $this->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->getNewsByUser($loggedUser->getIdUzytkownik());
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
        $model = new PagesModel(array(
            'data' => $result,
        ));


        $model->setTitle('Biblioteka');
        $model->setPage('panel');

        return $model;

    }
}
