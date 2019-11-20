<?php



require '../vendors/core/Router.php';
require '../vendors/lib/functions.php';

$query = $_SERVER['REQUEST_URI'];
$router = new Router();
$router::add('/post/add',['Controller' => 'Posts', 'Action' => 'add']);


if (Router::matchRoute($query)){
    debug(Router::getRoute());
}else{
    echo '404';
}
