<?php

namespace Article\Model;

use Article\Entity\CmsNewsEntity;
use Base\Entity\PlikiEntity;
use Base\Hydrator\PlikiHydrator;
use Base\Model\BaseModel;
use Base\Settings\Lang;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Select;

class CmsNewsFilesModel extends BaseModel
{

    
    protected $tablename = 'cms_news_files';
    
    protected $primary = 'id';
    
    protected $namespace = 'Article';
    
    
    public function __construct()
    {
        parent::__construct();
        $this->entity = new PlikiEntity();
        $this->hydrator = new PlikiHydrator();
    }

    /**
     * @param CmsNewsEntity $news
     * @return array
     */
    public function getByNews(CmsNewsEntity $news): array{

        $select = new Select(['cnf' => $this->tablename]);
        $select->join('pliki', 'pliki.id_pliku = cnf.id_pliki', ['*']);
        $select->where(['cnf.id_cms_news' => $news->getId()]);

        return (array) $this->getDataFromSelect($select, self::ENTITY_MODE);

    }





}