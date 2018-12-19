<?php

namespace Article\Service;

use Article\Entity\CmsNewsEntity;
use Uzytkownicy\Entity\UzytkownicyEntity;
use \Zend\ServiceManager\ServiceLocatorAwareInterface;

class LibraryService implements ServiceLocatorAwareInterface{

    protected $serviceLocator;

    /**
     * @param UzytkownicyEntity $user
     * @param CmsNewsEntity $news
     * @return bool
     */
    public function haveInLibrary(UzytkownicyEntity $user, CmsNewsEntity $news): bool
    {

        return $this->getServiceLocator()->get('Article\Model\CmsNewsUzytkownicy')->getIdByUserAndNews($user, $news) ? true : false;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->serviceLocator = $serviceLocator;
        return $this;
    }
}
