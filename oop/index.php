<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/18
 * Time: 19:21
 */

interface logger
{
    public function save($message);
}


class FileLogger implements logger
{
    public function save($message)
    {
        var_dump('log into file'.$message);
    }
}

class DatabaseLogger implements logger
{
    public function save($message)
    {
        var_dump('log into data'.$message);
    }
}

class UsersController
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function register()
    {
        $user = 'xiaoht';
        $this->logger->save($user);
    }
}

$controller = new UsersController(new FileLogger());
$controller->register();
