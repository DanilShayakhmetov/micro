<?php


namespace vendor\core\base;


abstract class View
{
    protected $route = [];
    protected $layout = [];

    public function __construct($route, $layout)
    {
        $this->route = $route;
        $this->layout = $layout ?: LAYOUT;
    }

    public function render()
    {
        $viewPath = APP . '/vews/' . $this->route['controller'] . '/' . $this->route['action'] . '.php';
        if (is_file($viewPath)) {
            require $viewPath;
        } else {
            echo "<b>File is not exist " . $viewPath . " <b>";
        }

    }
}