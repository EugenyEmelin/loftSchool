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
    /**
     * массив скриптов
     * @var array
     */
    public $scripts = [];

    public static $metaData = ['title'=>'', 'description'=>'', 'keywords'=>''];

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
                $content = $this->cutScripts($content);
                $scripts = [];
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require_once $fileLayout;
            } else {
                echo "Не найден шаблон $fileLayout";
            }
        }
    }

    public function cutScripts($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if (!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }
    public static function getMetaData()
    {
        echo '<title>'.self::$metaData['title'].'</title>';
        echo '<meta name="description" content="'.self::$metaData['description'].'">';
        echo '<meta name="keywords" content="'.self::$metaData['keywords'].'">';
    }
    public static function setMetaData($title = '', $description = '', $keywords = '')
    {
        self::$metaData['title'] = $title;
        self::$metaData['description'] = $description;
        self::$metaData['keywords'] = $keywords;
    }
}