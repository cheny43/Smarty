<?php
//基础控制器
namespace Core;
class Controller{
    use \Traits\Jump;
    public function __construct() {
        $this->initSession();
    }
    //初始化session
    private function initSession(){
        new \Lib\Session();
    }
}

