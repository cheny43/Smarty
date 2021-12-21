<?php
namespace Model;
class UserModel extends \Core\Model{
    //用户存在返回1，否则返回0
    public function isExists($name){
        $info=$this->select(['user_name'=>$name]);
        return empty($info)?0:1;
    }
    //通过用户名和密码获取用户的信息
    public function getUserByNameAndPwd($name,$pwd){
        $cond=array(
            'user_name'  =>  $name,
            'user_pwd'   => md5(md5($pwd).$GLOBALS['config']['app']['key'])
        );
        $info=$this->select($cond);
        if(!empty($info))
            return $info[0];
        return array();
    }
    //更新登陆信息
    public function updateLoginInfo(){
        //更新的信息
        $_SESSION['user']['user_login_ip']= ip2long($_SERVER['REMOTE_ADDR']=='::1'?'127.0.0.1':$_SERVER['REMOTE_ADDR']);
        $_SESSION['user']['user_login_time']=time();
        $_SESSION['user']['user_login_count']=++$_SESSION['user']['user_login_count'] ;
        //实例化模型
        $model=new \Core\Model('user');
        //更新
        return (bool)$model->update($_SESSION['user']);
    }
}
