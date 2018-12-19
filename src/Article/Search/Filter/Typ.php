<?php

namespace Article\Search\Filter;

class Typ extends SearchFilterAbstract {
    
    
    protected $toSelect;
    
    protected $selected;
    
    protected $type;

    const INPUT_NAME = 'type';

    const DEFAULT_VALUE = 1;
    
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
            'type' => 'select',
            'options' => [
                'required' => false,
                'value_options' => [
                    '1' => 'Aktualności',
                    '2' => 'Porady',
                    '3' => 'Test'
                ]
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

        $filter->add(array(
            'name' => self::INPUT_NAME,
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));

        return $this;
        
    }

    /**
     * @param array $data
     * @return SearchFilterAbstract
     */
    public function setData(array $data): SearchFilterAbstract
    {

        if(!empty($data[self::INPUT_NAME])){
            $this->doSearchFilter = true;
            $this->type = $data[self::INPUT_NAME];
        }

//        if(self::DEFAULT_VALUE != null){
//            $this->doSearchFilter = true;
//            $this->type = self::DEFAULT_VALUE;
//        }
//
        return $this;
        
    }

    /**
     * @param \Zend\Db\Sql\Select $select
     * @return bool
     */
    public function prepareSelect(\Zend\Db\Sql\Select &$select): bool{
        
        if(!$this->doSearchFilter){
            return false;
        }

        $select->where(array($this->mainTableAlias.".id_news_type" =>  $this->type));
        
        return true;
        
    }

}