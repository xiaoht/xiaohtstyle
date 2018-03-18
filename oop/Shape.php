<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/18
 * Time: 10:00
 */

abstract class Shape
{
    public $color;

    public function __construct($color = 'red')
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    abstract public function getArea();
}

class Square extends Shape
{
    protected $length = 4;
    public function getArea()
    {
        return pow($this->length , 2);
    }

}

class Circle extends Shape
{
    protected $length = 4;
    public function getArea()
    {
        return pow($this->length , 2);
    }
}

$shape = new Circle();

var_dump($shape->getArea());