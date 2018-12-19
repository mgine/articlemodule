<?php

namespace Article\Form;
    

class LibraryAddForm extends \Zend\Form\Form
{
    
    
    public function __construct()
    {
        parent::__construct('libary-add-form');

        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'libary-add-form');

        $this->prepareFormElements();
        $this->setInputFilter($this->prepareFilter());
    }

        
    public function prepareFormElements(){
        
       
        $this->add(array(
            'name' => 'id_news',
            'class' => 'id_news',
            'attributes' => array(
                'type' => 'hidden',
            ),
            'options' => array(
//                'label' => 'e-mail',
            )
        ));

        $this->add(array(
            'name' => 'description',
            'class' => 'description',
            'attributes' => array(
                'type' => 'textarea',
                'placeholder' => 'Dlaczego dodajesz do biblioteki?',
                'class'=>'custom-form-input-big'
            ),
            'options' => array(
                'label' => 'e-mail',
            )
        ));

        $this->add(array(
            'type' => '\Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
                array('name' => 'HtmlEntities'),
            ),
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 900
                )
            )
        ));
        
        return $this;
    }
    public function prepareFilter(){
        
        $filter = new \Zend\InputFilter\InputFilter();
        
        $filter->add(array(
            'name' => 'id_news',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
        $filter->add(array(
            'name' => 'description',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'max' => 255,
                    ),
                ),
            )
        ));

        return $filter;
       }
       
}
