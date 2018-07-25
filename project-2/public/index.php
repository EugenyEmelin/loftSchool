<?php
use \App\Core\Router,
    \App\Core\Registry;
//use \App\Core\Registry;
error_reporting(-1);

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE_PATH', dirname(__DIR__).'/app/Core');
define('APP_PATH', dirname(__DIR__).'/app');
define('LIBS', dirname(__DIR__).'/vendor/libs');

define('LAYOUT', 'default');

require '../vendor/autoload.php';

$query = $_SERVER['QUERY_STRING'];
//правила по-умолчанию
Router::add('^$', ['controller'=>'user', 'action'=>'all']); //маршрут по умолчанию при пустом url
Router::add('^user[/]?$', ['controller'=>'user', 'action'=>'all']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);

Registry::instance();
