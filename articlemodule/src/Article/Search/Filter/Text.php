<?php

namespace Article\Search\Filter;

class Text extends SearchFilterAbstract {
    
    
    protected $toSelect;
    
    protected $text;

    const INPUT_NAME = 'text';
    
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
                'required' => false,
            ],
        ]);
        
        return $this;
    }

    /**
     * @param \Zend\InputFilter\InputFilter $filter
     * @return SearchFilterAbstract
     */
    public function prepareFormFilter(\Zend\InputFilter\InputFilter &$filter): SearchFilterAbstract{

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
            $this->text = (string)$data[self::INPUT_NAME];
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
        
        $select->where->nest()
                ->like($this->mainTableAlias.'.subtitle', '%'.$this->text.'%')
                ->or
                ->like($this->mainTableAlias.'.content', '%'.$this->text.'%')
                ->or
                ->like($this->mainTableAlias.'.short_content', '%'.$this->text.'%')
                ->or
                ->like($this->mainTableAlias.'.technical_content', '%'.$this->text.'%')
                ->or
                ->like($this->mainTableAlias.'.title', '%'.$this->text.'%')
                ->or
                ->like('f.nazwa_firmy', '%'.$this->text.'%')
                ->or
                ->like('f.miejscowosc', '%'.$this->text.'%')
            ->unnest();
        
        return true;
        
    }

}