<?php

namespace Article\Form;

use Article\Entity\CmsNewsCategoryListEntity;
use Article\Search\Filter\CategorySlug;
use Article\Search\Filter\TagSlug;
use Article\Search\Filter\Text;
use Article\Search\Filter\Typ;
use Zend\InputFilter\InputFilter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class ProductsSearchForm extends ArticleSearchFormAbstract
{


    protected $type = 2;

    protected $tagsElements = [
        'materialy' => [
            'label' => 'Dowolny materiał'
        ],
    ];

    protected $queryParams = [
        'text',
        'bim'
    ];

    public static $linkPrefix = '/produkty';
    public function prepareLinkWithData(array $data, bool $withQuery = true): string
    {
        return self::$linkPrefix.parent::prepareLinkWithData($data, $withQuery);

    }

    public function prepareFormElements(): ArticleSearchFormAbstract
    {
        parent::prepareFormElements();
        $this->getServiceLocator()->get('Article\Search\Filter\Bim')->prepareFormElements($this);
        return $this;
    }
    public function prepareFilter(): InputFilter
    {
        $filter = parent::prepareFilter();
        $this->getServiceLocator()->get('Article\Search\Filter\Bim')->prepareFormFilter($filter);
        return $filter;
    }

}