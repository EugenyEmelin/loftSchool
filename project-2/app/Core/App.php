<?php
namespace App\Core;

/**
 * Class App
 * Основной класс-фабрика
 * Инициалицазия данного класса запускает цепочку создания многих важных объектов
 * @package App\Core
 */
class App
{
    public static $app;
    public function __construct()
    {
        //создадим все объекты-компоненты, которые указаны в файле конфигурации
        self::$app = Registry::instance();
        //Создадим объект обработчика ошибок
        new ErrorHandler();
    }
}