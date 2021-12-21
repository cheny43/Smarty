<?php
return array(
    //数据库配置
    'database'=>array(
        
    ),
    //应用程序配置
    'app'       =>array(
        'key'   =>  'itcast',       //加密秘钥
        'dp'    =>  'Admin',        //默认平台
        'dc'    =>  'Login',     //默认控制器
        'da'    =>  'login',         //默认方法
        'path'  =>  './Public/Uploads/',
        'size'  =>  1234567,
        'type'  =>  ['image/png','image/jpeg','image/gif']
    ),
);

