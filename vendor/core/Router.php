<?php

namespace vendor\core;

use app\controllers\Main;
use http\Url;

class Router
{
	protected static $routes = array();
	protected static $route = array();

	public static function add($regexp, $route = [])
	{
		self::$routes[$regexp] = $route;
	}

	public static function getRoute()
	{
		return self::$route;
	}

	public static function getRoutes()
	{
		return self::$routes;
	}

	public static function matchRoute($url)
	{
	    foreach (self::$routes as $pattern => $route){
	        if(preg_match("#$pattern#i", $url, $matches)){
		        foreach ($matches as $k => $v){
                    if (is_string($k)){
                        $route[$k] = $v;
                    }
                }
		        if (!isset($route['action'])){
		            $route['action'] = 'index';
                }
                self::$route['controller'] = Router::routeFilterController($route['controller']);
                self::$route['action'] = Router::routeFilterAction($route['action']);;
			    return true;
			}
		}
		return false;
	}

	public static function dispatch($url)
    {
        $url = Router::urlFilter($url);
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\'.self::$route['controller'];
            $action = self::$route['action'].'Action';
            if (class_exists($controller)){
                $$controller = new $controller(self::$route);
                if (method_exists($$controller, $action)){
                    $$controller->$action();
                }else{
                    echo "Method {$action} doesn't exist in {$controller}";
                }
            }else{
                echo "Class {$controller} doesn't exist";
            }
        }else{
            http_response_code(404);
            include '../../public/404.html';
        }
    }

    public static function routeFilterController($name)
    {
        return str_replace(' ','',ucwords(str_replace('-', '', $name)));
    }

    public static function routeFilterAction($name)
    {
        return lcfirst(self::routeFilterController($name));
    }

    public static function urlFilter($url)
    {
        if ($url) {
            $url = explode('?', $url);
//            debug($url);
        }
        return rtrim( $url[0],'/');
    }
}
