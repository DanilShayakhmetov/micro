<?php

use vendor\core\Router;

require '../vendor/lib/functions.php';


define('WWW', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('LAYOUT', dirname(__DIR__).'/app/views/Layouts/default.php');
define('LAYOUT1', dirname(__DIR__).'/app/views/Layouts/default1.php');




spl_autoload_register(function ($class) {
    $path = '../'.str_replace('\\','/', $class).'.php';
    if (is_file($path)) {
        require_once $path;
    }
});


$query = $_SERVER['REQUEST_URI'];
$router = new Router();


Router::add('^/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::add('^/?(?P<controller>[a-z-]+)?$');
Router::add("^$",['Controller' => 'Main', 'Action' => 'index']);



//debug(Router::getRoutes());
debug(Router::dispatch($query));


//if (Router::matchRoute($query)){
//    debug(Router::getRoute());
//}else{
//    echo '404';
//}
