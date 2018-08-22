<?php
namespace App\Core;
use R;

class Db
{
    use SingletonTrait;

    protected $pdo;
    public static $countSql = 0;
    public static $queries = [];

    protected function __construct()
    {
        if (is_file($config_db = APP_PATH.'/config/config_db.php')) {
            require LIBS.'/rb.php';
            $db = require $config_db;
            R::setup($db['dsn'], $db['user'], $db['password']);
            R::freeze(true);
        } else {
            throw new \Exception("Файл конфигурации базы данных <b>$config_db</b> не найден");
        }
    }
}