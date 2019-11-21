<?php



require '../vendors/core/Router.php';
require '../vendors/lib/functions.php';

$query = $_SERVER['REQUEST_URI'];
$router = new Router();


Router::add("/(?P<Controller>[a-z-]+)\/(?P<Action>[a-z-]+)/i");
Router::add("/(?P<Controller>[a-z-]+)/i");
Router::add("/\S/",['Controller' => 'Main', 'Action' => 'index']);


debug(Router::getRoutes());
debug(Router::dispatch($query));


//if (Router::matchRoute($query)){
//    debug(Router::getRoute());
//}else{
//    echo '404';
//}
