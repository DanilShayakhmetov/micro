<?php



require '../vendors/core/Router.php';
require '../vendors/lib/functions.php';
require '../application/controllers/Main.php';
require '../application/controllers/Posts.php';

spl_autoload_register(function ($class) {
    $dir = '../application/controllers/';
    foreach (scandir($dir) as $class){
        require '../application/controllers/' . $class . '.class g.php';
    }

});


$query = $_SERVER['REQUEST_URI'];
$router = new Router();


Router::add('^/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::add('^/?(?P<controller>[a-z-]+)?$');
Router::add("^$",['Controller' => 'Main', 'Action' => 'index']);



debug(Router::getRoutes());
debug(Router::dispatch($query));


//if (Router::matchRoute($query)){
//    debug(Router::getRoute());
//}else{
//    echo '404';
//}
