<?php
namespace App\Core\base;


//use AppController\Core\View;

abstract class Controller
{
    /**
     * текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    protected $route = [];
    /**
     * вид
     * @var string
     */
    protected $view;
    /**
     * шаблон
     * @var string
     */
    protected $layout;
    /**
     * пользовательские данные
     * @var array
     */
    protected $data =[];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }
    public function view()
    {
        $viewObject = new View($this->route, $this->layout, $this->view);
        $viewObject->render($this->data);
    }
    public function set(array $data){
        $this->data = $data;
    }
}