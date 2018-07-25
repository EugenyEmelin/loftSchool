<?php
namespace App\Core;

class Registry
{
    public static $objects = [];
    protected static $instance;

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
        print_r(self::$objects); //debug
    }

    /**
     * singleton метод
     * @return Registry
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}