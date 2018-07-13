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
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
}