<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/17
 * Time: 18:21
 */

class Person
{
    private $name;
    private $age;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        if ($age < 18){
            throw new Exception('not old enough');
        }
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }
}

$person = new Person('xiaoht');
$person->setAge(18);

var_dump($person->getAge());