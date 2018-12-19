<?php

namespace Article\Form;

use Article\Entity\CmsNewsCategoryListEntity;
use Article\Search\Filter\CategorySlug;
use Article\Search\Filter\TagSlug;
use Article\Search\Filter\Text;
use Article\Search\Filter\Typ;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class ArchitectureSearchForm extends ArticleSearchFormAbstract
{

    protected $type = 1;

    protected $tagsElements = [
        'architekci' => [
            'label' => 'Wszyscy architekci'
        ],
        'panstwo' => [
            'label' => 'Wszystkie regiony'
        ],
        'rok' => [
            'label' => 'Dowolne lata'
        ],
        'temat' => [
            'label' => 'Wszystkie tematy'
        ],
    ];

    protected $queryParams = [
        'text'
    ];

    public static $linkPrefix = '/architektura';

    /**
     * @param array $data
     * @param bool $withQuery
     * @return string
     */
    public function prepareLinkWithData(array $data, bool $withQuery = true): string
    {
        return self::$linkPrefix.parent::prepareLinkWithData($data, $withQuery);

    }

    /**
     * @return array
     */
    public function getLinkParamsInOrder(): array
    {
        if(!empty($this->linkParamsInOrder)){
            return $this->linkParamsInOrder;
        }

        parent::getLinkParamsInOrder();

        foreach($this->linkParamsInOrder as $key => $value){
            if($value == 'temat'){
                unset($this->linkParamsInOrder[$key]);
            }
        }

        return $this->linkParamsInOrder;
    }

}
