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
		foreach (self::$routes as $route => $controller){
			if($route == $url){
				self::$route = $controller;
				return true;
			}
			return false;
		}
	}

}
