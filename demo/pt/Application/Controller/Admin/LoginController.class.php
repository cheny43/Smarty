<?php
namespace Controller\Admin;
use Core\Controller;    //引入基础控制器
use Model\UserModel;
use Core\Model;

class LoginController extends Controller{
    //登录
    public function loginAction(){
        if(!empty($_POST)){
            $model=new \Model\UserModel();
            $info=$model->getUserByNameAndPwd($_POST['username'], $_POST['password']);
           if(!empty($info)){
                $this->success('index.php?p=Admin&c=Admin&a=admin', '登陆成功');
            }else{
                $this->error('index.php?p=Admin&c=Login&a=login', '登陆失败，请重新登陆');
            }
        }        
        //第一步：显示登陆界面
        require __VIEW__.'login.html';
    }
    //注册
    public function registerAction(){
        if(!empty($_POST)){
            $data['user_name']=$_POST['username'];
            $data['user_pwd']=md5(md5($_POST['password'].$GLOBALS['config']['app']['key']));
            $model=new \Core\Model('user');
            if($model->insert($data)){
                $this->success('index.php?p=Admin&c=Login&a=login','注册成功');
            }else{
                $this->error('index.php?p=admin&c=login&a=register','注册失败,请重新注册');
            }
        }
        require __VIEW__.'register.html';
    }
    //验证用户是否存在
    public function checkUserAction(){
        $_GET['username'];
        $model = new \Model\UserModel();
        echo $model->isExists($_GET['username']);
    }

}