<?php
namespace App\Core;
use R;

class Db
{
    protected $pdo;
    protected static $connect;
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
//    protected function __construct()
//    {
//        if (is_file($config_db = APP_PATH.'/config/config_db.php')) {
//            $db = require_once $config_db;
//            $options = [
//                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
//                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
//            ];
//            $this->pdo = new \PDO($db['dsn'], $db['user'], $db['password'], $options);
//        } /*else {*/
//            throw new \Exception("Файл конфигурации базы данных <b>$config_db</b> не найден");
//        }
//    }
    public static function connect()
    {
        if (self::$connect === null) {
            self::$connect = new self;
        }
        return self::$connect;
    }
//    public function execute($sql, $params = [])
//    {
//        self::$countSql++;
//        self::$queries[] = $sql;
//        $statement = $this->pdo->prepare($sql);
//        return $statement->execute($params);
//    }
//    public function query($sql, $params = [])
//    {
//        $statement = $this->pdo->prepare($sql);
//        $result = $statement->execute($params);
//        if ($result !== false) {
//            return $statement->fetchAll();
//        }
//        return []; //чтобы в случае неудачи метод не возвращал false, вернём пустой массив
//    }
}