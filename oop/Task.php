<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/17
 * Time: 18:10
 */

class Task{
    public $description;

    public $completed = false;

    public function __construct($description)
    {
        $this->description = $description;
    }

    public function complete()
    {
        $this->completed = true;
    }
}

$task = new Task('learn oop');
$task->complete();
var_dump($task->completed);