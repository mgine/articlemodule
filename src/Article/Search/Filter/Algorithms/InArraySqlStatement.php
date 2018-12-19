<?php

namespace Article\Search\Filter\Algorithms;

class InArraySqlStatement
{
    protected $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function __toString(): string
    {
        if($this->count == 0){
           return '';
        }

        $x = array();

        for($i = 0; $i<$this->count; $i++){
            $x[] = '?';
        }

        return implode(',', $x);

    }
}