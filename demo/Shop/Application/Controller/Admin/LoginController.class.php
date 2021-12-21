<?php
namespace Controller\Admin;
use Core\Controller;    //引入基础控制器
class LoginController extends Controller{
    //登录
    public function loginAction(){
        require __VIEW__.'login.html';
    }
    //注册
    public function registerAction(){
        require __VIEW__.'register.html';
    }
}