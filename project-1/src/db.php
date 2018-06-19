<?php
require_once 'config.php';

$dsn = "$dbType:dbname=$dbName;host=$server;charset=utf8";
try {
    $dbh = new PDO($dsn, $username, $pwd, [PDO::MYSQL_ATTR_FOUND_ROWS => true]);
} catch (PDOException $e) {
    echo 'Не удалось подключиться к базе данных:' . $e->getMessage();
    exit();
}
