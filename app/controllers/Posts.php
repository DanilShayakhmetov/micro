<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Posts extends Controller
{

    function indexAction()
    {
        $this->route;
        echo "index function".$this->route;
    }

    function testAction(){
        echo "testAction";
    }
}