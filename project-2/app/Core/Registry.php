<?php
namespace App\Core;

/**
 * Class Registry
 * Класс-фабрика. Создаёт объекты-компоненты, названия которых хранятся в файле конфигурации
 * @package App\Core
 */
class Registry
{
    use SingletonTrait;

    public static $objects = [];
    /**
     * Registry constructor.
     * Заполняем массив $objects компонентами из файла конфигурации, предварительно создавая экземпляры их объектов
     */
    protected function __construct()
    {
        require_once $config = APP_PATH.'/config/config.php';
        foreach ($config['components'] as $name => $component) {
            if (class_exists($component))
                self::$objects[$name] = new $component();
            else trigger_error("Не найден класс $component");
        }
    }
    public function __get($name)
    {
        if (is_object(self::$objects[$name]))
            return self::$objects[$name];
        else
            trigger_error("$name не является объектом");
        return false;
    }
    public function __set($name, $object)
    {
        if (!isset(self::$objects[$name])) {
            self::$objects[$name] = new $object();
        }
    }
}