<?php

namespace Article\Search\Form;

use Article\Search\ArticleSearch;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class ArticleSearchForm extends Form
 {
    
    protected $service;

    /**
     * ArticleSearchForm constructor.
     * @param ArticleSearch $service
     */
    public function __construct(ArticleSearch $service)
    {
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', "/wyszukiwarka.html");
        
        $this->service = $service;

        $this->add([
            'name' => 'sort',
            'type' => 'select',
            'attributes' => [
                'class' => 'selects',
                'id' => 'sort-input'
            ],
            'options' => [
                'label' => '',
                'value_options' => [
                    '12' => '-- wybierz --',
                    '1' => 'Data rosnąco',
                    '2' => 'Data malejąco',
                ],
            ]
        ]);
        
        $this->add([
            'name' => 's',
            'type' => 'hidden',
            'attributes' => [
                'value' => 0,
            ],
            'options' => [
                'default_value' => '0'
            ]
        ]);
        




    }

    /**
     * @return InputFilter
     */
    public function prepareFilter(): InputFilter{
        
        $filter = new InputFilter();

        
        $filter->add([
            'name' => 's',
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ]
        ]);

        $filter->add([
            'name' => 'sort',
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ]
        ]);
        
        
        return $filter;
    }
}