<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/17
 * Time: 18:30
 */

class LightSwitch
{
    public function on()
    {
        $this->connect();
    }

    public function off()
    {

    }

    protected function connect()
    {
        var_dump('connect');
    }

}


$light = new LightSwitch();
$light->on();
