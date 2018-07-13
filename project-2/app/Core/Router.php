<?php
namespace App\Core;
use App;

class Router
{
    /**
     * таблица маршрутов
     * @var array
     */
    protected static $routes = [];
    /**
     * текущий маршрут
     * @var array
     */
    protected static $route = [];
    /**
     * добавляет маршрут в таблицу маршрутов
     * @param $regex
     * @param array $route
     */
    public static function add($regex, array $route = [])
    {
        self::$routes[$regex] = $route;
    }
    /**
     * получает массив доступных маршрутов
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }
    /**
     * получает текущий маршрут
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }
    /**
     * проверяет url-адрес на соответствие шаблонам из self::$routes
     * сохраняет запрошеный маршрут в self::$route
     * @param $url
     * @return bool*/
    private static function matchRoutes($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) $route[$key] = $value;
                    if (!isset($route['action'])) $route['action'] = 'index';
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    /**
     * исходя из url-запроса создаёт экземпляр объекта-контроллера
     * вызывает запрошеный метод контроллера
     * если запрашиваемый маршрут не найден в таблице маршрутов, то перенаправляет на стр. 404.html
     * @param $url
     * @return void
     */
    public static function dispatch($url)
    {
        if (self::matchRoutes($url)) {
            $controller = self::$route['controller'];
            $className = '\App\Controllers\\'.ucfirst($controller).'Controller';
            if (class_exists($className)) {
                $controllerObj = new $className(self::$route);
                $action = self::$route['action'];
                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->view();
                } else {
                    echo "Метод <b>$controller:$action не найден";
                }
            } else {
                echo "Контроллер <b>$controller</b> не найден";
            }
        } else {
            http_response_code(404);
            include_once WWW.'/404.html';
        }
    }
}