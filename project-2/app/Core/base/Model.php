<?php
namespace App\Core\base;

use App\Core\Db;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Db::connect();
    }
//    public function query($sql)
//    {
//        return $this->pdo->execute($sql);
//    }
//    public function all()
//    {
//        $sql = "SELECT * FROM {$this->table}";
//        return $this->pdo->query($sql);
//    }
//    public function getOne($value, $field = '')
//    {
//        $field = $field ?: $this->primaryKey;
//        return $this->pdo->query("SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1", [$value]);
//    }
//    public function sql($sql, array $params = [])
//    {
//        return $this->pdo->query($sql, $params);
//    }
//    public function sqlLike($string, $field, $table = '')
//    {
//        $table = $table ?: $this->table;
//        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
//        return $this->pdo->query($sql, ["%$string%"]);
//    }
}
