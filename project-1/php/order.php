<?php
require_once '../src/functions.php';
require_once '../src/config.php';

$name = normalize($_POST['name']);
$email = normalize($_POST['email']);
$phone = normalize($_POST['phone']);
$street = normalize($_POST['street']);
$home = normalize($_POST['home']);
$part = normalize($_POST['part']);
$appt = normalize($_POST['appt']);
$floor = normalize($_POST['floor']);
$comment = normalize($_POST['comment']);
$payment = normalize($_POST['payment']);
$callback = isset($_POST['callback']) ? normalize($_POST['callback']) : 0;
$dsn = "$dbType:dbname=$dbName;host=$server;charset=utf8";

try {
    $dbh = new PDO($dsn, $username, $pwd, [PDO::MYSQL_ATTR_FOUND_ROWS => true]);
} catch (PDOException $e) {
    echo 'Не удалось подключиться к базе данных:' . $e->getMessage();
    exit();
}

if ($user_id = findUser()) { //если пользователь уже есть в базе запишем его id в $user_id
    addOrder($user_id); //добавим заказ от найденного пользователя
} else { //если пользвателя нет в базе
    addUser(); //добавим его в базу
    $user_id = findUser(); //найдём добавленного пользователя в базе и получим его id
    addOrder($user_id); //добавим заказ от найденного пользователя
}
