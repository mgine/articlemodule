<?php

namespace Article\Controller;

class DeveloperController extends \Zend\Mvc\Controller\AbstractActionController
{
    protected $tableNames = array(
        'cms_news',
        'cms_news_category',
        'cms_news_category_list',
        'cms_news_comments',
        'cms_news_relation',
        'cms_news_tags',
        'cms_news_type',
        'cms_gallery',
        'cms_gallery_category',
        'cms_gallery_category_list',
        'cms_gallery_group',
        'cms_gallery_photo',
        'cms_gallery_photo_langs',
        'cms_news_uzytkownicy'
    );


    public function entitygeneratorAction(){

        $folder = 'module';

        foreach($this->tableNames as $tableName){
            $class='Article\Model\\';
            $exp = explode('_', $tableName);
            foreach($exp as $namePart){
                $class .= ucfirst($namePart);
            }

            $gal = $this->getServiceLocator()->get($class);

            $gal->createEntity($folder);
            $gal->createHydrator($folder);
        }

        die;
    }

    public function modelgeneratorAction()
    {

        $dir = getcwd() . '/module/Article/src/Article/Model';

        if (!is_dir($dir) && !mkdir($dir)) {
            die("Can't create dir: " . $dir);
        }

        foreach($this->tableNames as $tableName){
            $class='';
            $exp = explode('_', $tableName);
            foreach($exp as $namePart){
                $class .= ucfirst($namePart);
            }


            if (!file_exists($dir . '/' . $class . 'Model.php')) {

            $creator = new \Base\Utility\ModelCreator();
            $data = $creator->setNamespace('Article')
                ->setTablename($tableName)
                ->createModel();

            // Check if we can create the entity file
            if (!$handle = fopen($dir . '/' . $class . 'Model.php', 'w+')) {
                die("Cannot open/create file: " . $dir . '/' . $class . 'Model.php');
            }
            // Write contents to the Entity file
            if (fwrite($handle, $data) === FALSE) {
                die("Cannot write to file: " . $dir . '/' . $class . 'Model.php');
            }
            // Close this handle
            fclose($handle);

            print_r( $creator->createServiceFactoryConfig());
            }

        }

        return true;
    }
}
