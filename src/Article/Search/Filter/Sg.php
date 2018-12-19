<?php

namespace Article\Search\Filter;

class Sg extends SearchFilterAbstract {


    protected $sg;

    const INPUT_NAME = 'sg';
    
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
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => [
                'label' => 'Strona główna',
//                'label_attributes' => array(
//                    "for" => "active",
//                    "class" => "control-label control-label-checkbox"
//                ),
                'checked-value' => 1,
                'unchecked-value' => 0,
                'default' => 0,

            ],
//            'attributes' => array(
//                'class' => 'toggle',
//                'id' => 'free'
//            )
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
    public function setData(array $data): SearchFilterAbstract
    {

        if(!empty($data[self::INPUT_NAME])){
            $this->doSearchFilter = true;
            $this->sg = true;
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

        $select->where(array('n.main_page_active' => true));

        return true;
        
    }

}