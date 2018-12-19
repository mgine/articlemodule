<?php

namespace Article\Form;

use Article\Entity\CmsNewsCategoryListEntity;
use Article\Search\Filter\CategorySlug;
use Article\Search\Filter\TagSlug;
use Article\Search\Filter\Text;
use Article\Search\Filter\Typ;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class NewsSearchForm extends ArticleSearchFormAbstract
{


    protected $type = 3;

    protected $tagsElements = [];

    protected $queryParams = [
        'text'
    ];

    public static $linkPrefix = '/aktualnosci';

    /**
     * @param array $data
     * @param bool $withQuery
     * @return string
     */
    public function prepareLinkWithData(array $data, bool $withQuery = true): string
    {
        return self::$linkPrefix.parent::prepareLinkWithData($data, $withQuery);

    }

}