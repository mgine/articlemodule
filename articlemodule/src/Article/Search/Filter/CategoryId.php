<?php

namespace Article\Search\Filter;

use Article\Search\Filter\Algorithms\InArraySqlStatement;

class CategoryId extends SearchFilterAbstract {


    protected $ids;

    const INPUT_NAME = 'category_id';
    
    public function __construct() {
        
    }

    /**
     * @param \Zend\Form\Form $form
     * @return SearchFilterAbstract
     */
    public function prepareFormElements(\Zend\Form\Form &$form): SearchFilterAbstract
    {

        $form->add([
            'name' => self::INPUT_NAME,
            'type' => 'multicheckbox',
            'options' => [
                'required' => false,
                'value_options' => $this->getServiceLocator()->get('Categories')->getAttributesOptions(),
                'empty_option' => '',
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
            ]
        ]);

        return $this;

    }

    /**
     * @param array $data
     * @return SearchFilterAbstract
     */
    public function setData(array $data): SearchFilterAbstract
    {

        if(isset($data[self::INPUT_NAME]) and is_array($data[self::INPUT_NAME]) and (count($data[self::INPUT_NAME]) > 0)){
            foreach($data[self::INPUT_NAME] as $key => $value){
                if($value != '0'){
                    $this->ids[$key] = $value;
                }
            }

            $this->doSearchFilter = true;
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
        $params = $this->getServiceLocator()->get('Categories')->getCategoryIdsMakeUpWithChildsIds($this->ids);
        $c = count($params);
        $select->where->expression('((SELECT count(id) as cnccunt FROM cms_news_category cnc2 WHERE cnc2.id_news = n.id AND cnc2.id_news_category_list IN ('.(new InArraySqlStatement($c)).')) >= 1)', $params);

        return true;
        
    }

}