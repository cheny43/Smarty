<?php
require './Smarty/Smarty.class.php';
$smarty= new Smarty();
$smarty->assign('title','标题');
$smarty->left_delimiter='{{';
$smarty->right_delimiter='}}';
$smarty->setTemplateDir('./view/');
$smarty->setCompileDir('./viewc/');
$smarty->display('1-demo.html');