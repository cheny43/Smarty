<?php

namespace Model;

class UserModel extends \Core\Model
{
    //用户存在返回1,否则返回0
    public function isExists($name)
    {
        $info = $this->select(['user_name' => $name]);
        return empty($info) ? 0 : 1;
    }
    //通过用户名获取用户的信息
    public function getUserByNameAndPwd($name, $pwd)
    {
        $cond = array(
            'user_name' => $name,
            'user_pwd' => md5(md5($pwd.$GLOBALS['config']['app']['key']))
        );
        $info = $this->select($cond);
        if (!empty($info))
            return $info[0];
        return array();
    }
}
