<?php
//自动加载类
spl_autoload_register(function($class_name){
    require "{$class_name}.class.php";
});
//连接数据库
$param=array(
    'user'=>'root',
    'username'=>'root'
);
//静态属性可以直接调动内部方法
$mypdo=MYPDO::getInstance($param);
?>