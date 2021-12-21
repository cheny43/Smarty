<?php
require "./Smarty/Smarty.class.php";
$smarty=new Smarty();
define('price','100');
setcookie('name','cookie的值');
$_SESSION['names']='berry';
$smarty->assign('name','tom');
$smarty->display("demo.html");