<?php

namespace Article\Controller;

use Article\Video\Stream;
use UserEngage\Client\UserEngageClient;
use UserEngage\Service\UserEngageService;
use Zend\View\Model\ViewModel;

class TestController extends \Zend\Mvc\Controller\AbstractActionController
{
    public function indexAction(){

            echo '{}';die;

    }
    public function streamAction(){
//        var_dump(getcwd().'/BigBuckBunny.mp4');die;
//        \Base\Service\GlobalFunction::httpasswd('ait', 'ait');
//        $stream = new Stream(getcwd().'/public/BigBuckBunny.mp4');
//        $stream->start();
        $entity = $this->getServiceLocator()->get('Article\Model\ElearnCourse')->getEntity(1);

    }
}
