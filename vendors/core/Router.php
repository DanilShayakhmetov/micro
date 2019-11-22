<?php

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
	   if(preg_match($pattern, $url, $matches)){
		        foreach ($matches as $k => $v){
                    if (is_string($k)){
                        $route[$k] = $v;
                    }
                }
		        if (!isset($route['Action'])){
		            $route['Action'] = 'index';
                }
                self::$route = $route;
			    return true;
			}
		}
		return false;
	}

	public static function dispatch($url)
    {
        if(self::matchRoute($url)){
            $controller = Router::routeFilterController(self::$route['Controller']);
            $action = Router::routeFilterAction(self::$route['Action']);
            debug($action);
            if (class_exists($controller)){
                $$controller = new $controller;
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
            include '404.html';
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
}

//
//var_dump($pattern);
//$url = $_SERVER['REQUEST_URI'];
//var_dump($url);
//preg_match("/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i", $url, $matches);
//var_dump($matches);