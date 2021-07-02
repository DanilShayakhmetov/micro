<?php


namespace vendor\core\base;


abstract class Controller
{
    protected $layout = LAYOUT;
    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function render($args)
    {
        if (is_array($args)) {
            extract($args);
        }
        $viewPath = APP . '/views/' . $this->route['controller'] . '/' . $this->route['action'] . '.php';
        ob_start();
        if (is_file($viewPath)) {
            require $viewPath;
        } else {
            echo "<b>File is not exist " . $viewPath . " <b>";
        }
        $content = ob_get_clean();
        if (is_file($this->layout)) {
            require $this->layout;
        } else {
            echo "<b>File is not exist " . $this->layout . " <b>";
        }

    }

}