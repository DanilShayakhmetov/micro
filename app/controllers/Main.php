<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Main extends Controller
{
//    protected $layout = LAYOUT1;

    public function indexAction() {
        debug('asd');
        $this->render(['a'=>'qweqweqe', 'b'=>'sadasdasdasdf']);
        return "asdasdasd";
    }
}