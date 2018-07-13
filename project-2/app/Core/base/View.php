<?php
namespace App\Core\base;

/**
 * Class View
 * @package AppController\Core
 */
class View
{
    /**
     * текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    protected $route = [];
    /**
     * текущий вид
     * @var
     */
    protected $view;
    /**
     * текущий шаблон
     * @var
     */
    protected $layout;

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }
    public function render(array $data)
    {
        if (is_array($data)) extract($data);
        $fileView = APP_PATH."/Views/{$this->route['controller']}/{$this->view}.php";
        //для того, чтобы отобразить вид внутри шаблона - буферизируем его
        ob_start();
        if (is_file($fileView)) {
            require_once $fileView;
        } else {
            echo "Не найден вид $fileView";
//            throw new \Exception("Не найден вид $fileView");
        }
        $content = ob_get_clean();

        if ($this->layout !== false) {
            $fileLayout = APP_PATH . "/views/layouts/{$this->layout}.php";
            if (is_file($fileLayout)) {
                require_once $fileLayout;
            } else {
                echo "Не найден шаблон $fileLayout";
            }
        }
    }
}