<?php

namespace Article\Search\Result;


use Zend\ServiceManager\ServiceLocatorAwareInterface;

interface ResultInterface extends ServiceLocatorAwareInterface {

    public function getCurrentEntities(): array;

}
