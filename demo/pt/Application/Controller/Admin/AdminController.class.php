<?php
namespace Controller\Admin;
use \Core\Controller;
class AdminController extends Controller{
    public function adminAction(){
        require __VIEW__.'admin.html';
    }
    public function topAction(){
        require __VIEW__.'top.html';
    }
    public function menuAction(){
        require __VIEW__.'menu.html';
    }
    public function mainAction(){
        require __VIEW__.'main.html';
    }
}
?>