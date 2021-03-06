<?php

namespace Article\Search\Filter;

use Article\Search\Filter\Algorithms\InArraySqlStatement;

class TagSlug extends SearchFilterAbstract {


    protected $slugs;

    const INPUT_NAME = 'tag_slug';
    
    public function __construct() {
        
    }

    /**
     * @param \Zend\Form\Form $form
     * @return SearchFilterAbstract
     */
    public function  prepareFormElements(\Zend\Form\Form &$form): SearchFilterAbstract
    {
        
        $form->add([
            'name' => self::INPUT_NAME,
            'type' => 'text',
            'options' => [
                'required' => false
            ],
        ]);
        
        return $this;
    }

    /**
     * @param \Zend\InputFilter\InputFilter $filter
     * @return SearchFilterAbstract
     */
    public function prepareFormFilter(\Zend\InputFilter\InputFilter &$filter): SearchFilterAbstract
    {

        $filter->add([
            'name' => self::INPUT_NAME,
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
        ]);

        return $this;
    }

    /**
     * @param array $data
     * @return SearchFilterAbstract
     */
    public function setData(array $data): SearchFilterAbstract{

        if(isset($data[self::INPUT_NAME]) and is_array($data[self::INPUT_NAME]) and (count($data[self::INPUT_NAME]) > 0)){
            $this->doSearchFilter = true;
            $this->slugs = $data[self::INPUT_NAME];
        }
        
        return $this;
        
    }

    /**
     * @param \Zend\Db\Sql\Select $select
     * @return bool
     */
    public function prepareSelect(\Zend\Db\Sql\Select &$select): bool
    {
        
        if(!$this->doSearchFilter){
            return false;
        }
        $c = count($this->slugs);
        $params = $this->slugs;
        $params[] = $c;
        $select->where->expression('(SELECT SUM(CASE WHEN t2.slug IN ('.(new InArraySqlStatement($c)).') THEN 1 ELSE 0 END) FROM cms_news_tags as cnt2
            LEFT JOIN tagi as t2 ON cnt2.id_tagu = t2.id
            LEFT JOIN tagi_grupy as tg2 ON tg2.id = t2.id_grupy
            WHERE cnt2.id_item = n.id) = ?', $params);

        return true;
        
    }

}