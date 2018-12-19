<?php

namespace Article\Search\Filter;

class Bim extends SearchFilterAbstract {


    protected $bim;

    const INPUT_NAME = 'bim';

    /**
     * @param \Zend\Form\Form $form
     * @return SearchFilterAbstract
     */
    public function  prepareFormElements(\Zend\Form\Form &$form): SearchFilterAbstract
    {

        $form->add(array(
            'name' => self::INPUT_NAME,
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => [
                'label' => 'Plik BIM',
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
        ));
        
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

        $select->where->expression('((SELECT COUNT(id_pliku) FROM pliki pbim LEFT JOIN cms_news_files newspbim ON newspbim.id_pliki = pbim.id_pliku WHERE newspbim.id_cms_news = n.id AND pbim.typ=\'bim\') > 0)', array());

        $this->doSearchFilter = false;

        return true;
        
    }

}