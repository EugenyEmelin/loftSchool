<?php
use \App\Core\Router;

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE_PATH', dirname(__DIR__).'/app/Core');
define('APP_PATH', dirname(__DIR__).'/app');
define('LIBS', dirname(__DIR__).'/vendor/libs');
define('CACHE', dirname(__DIR__).'/tmp/cache');
define('LAYOUT', 'default');

define('DEV', 1);

require '../vendor/autoload.php';

new \App\Core\App();
$query = $_SERVER['QUERY_STRING'];
//правила по-умолчанию
Router::add('^$', ['controller'=>'user', 'action'=>'all']); //маршрут по умолчанию при пустом url
Router::add('^user[/]?$', ['controller'=>'user', 'action'=>'all']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
//echo test();
//throw new Exception('Исключение :(', 403);
Router::dispatch($query);
