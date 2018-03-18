<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/17
 * Time: 19:03
 */

class Mother
{
    protected function getEyesCount()
    {
        return 2;
    }

}

class Child extends Mother
{
    protected function getEyesCount()
    {
        return 3;
    }

    public function getEyes()
    {
        return $this->getEyesCount();
    }

}

class Boy extends Mother
{
    
}


$child = new Child();
var_dump($child->getEyes());