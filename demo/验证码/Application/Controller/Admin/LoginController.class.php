<?php

namespace Controller\Admin;

use Core\Controller;    //引入基础控制器
class LoginController extends BaseController
{
    //登录
    public function loginAction()
    {
        //第二步：执行登陆逻辑
        if (!empty($_POST)) {
            $captcha=new \Lib\Captcha();
            if(!$captcha->check($_POST['passcode'])){
                $this->error('index.php?p=Admin&c=Login&a=login','验证码错误');
            }
            $model = new \Model\UserModel();
            if ($info = $model->getUserByNameAndPwd($_POST['username'], $_POST['password'])) {
                $_SESSION['user'] = $info;    //将用户信息保存到会话中
                $model->updateLoginInfo();   //更新登陆信息
                if(isset($_POST['remember'])){
                    $time=time()+3600*24*7;//保存七天
                    setcookie('name',$_POST['username'],$time);
                    setcookie('pwd',$_POST['password'],$time);
                } 
                $this->success('index.php?p=Admin&c=Admin&a=admin', '登陆成功');
            } else {
                $this->error('index.php?p=Admin&c=Login&a=login', '登陆失败，请重新登陆');
            }
        }
        //第一步：显示登陆界面
        $name=$_COOKIE['name']??'';
        $pwd=$_COOKIE['pwd']??'';
        require __VIEW__ . 'login.html';
    }
    //安全退出
    public function logoutAction(){
        session_destroy();
        header('location:index.php?p=Admin&c=Login&a=login');
    }
    //注册
    public function registerAction()
    {
        //第二步：执行注册逻辑
        if (!empty($_POST)) {
            //验证码检验
            $captcha=new \Lib\Captcha();
            if(!$captcha->check($_POST['passcode'])){
                $this->error('index.php?p=Admin&c=Login&a=login','验证码错误');
            }
            //文件上传
            $path=$GLOBALS['config']['app']['path'];
            $size=$GLOBALS['config']['app']['size'];
            $type=$GLOBALS['config']['app']['type'];
            $upload= new \Lib\Upload($path,$size,$type);
            if($path=$upload->uploadOne($_FILES['face'])){
                $data['user_face']=$path;
            }else{
                $this->error('index.php?p=Admin&c=Login&a=register',$upload->getError());
            }

            $data['user_name'] = $_POST['username'];
            $data['user_pwd'] = md5(md5($_POST['password']) . $GLOBALS['config']['app']['key']);
            $model = new \Core\Model('user');
            if ($model->insert($data))
                $this->success('index.php?p=Admin&c=Login&a=login', '注册成功，您可以去登陆了');
            else
                $this->error('index.php?p=Admin&c=Login&a=register', '注册失败，请重新注册');
        }
        //第一步：显示注册界面
        require __VIEW__ . 'register.html';
    }
    //验证用户名是否存在
    public function checkUserAction()
    {
        $model = new \Model\UserModel();
        echo $model->isExists($_GET['username']);
    }
    //验证码
    public function verifyAction(){
        $captcha=new \Lib\Captcha();
        $captcha->entry();
    }
}
