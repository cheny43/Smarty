<?php
/* Smarty version 3.1.39, created on 2021-12-08 20:56:31
  from 'D:\Web\phpstudy_pro\WWW\templates\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61b0ab7f62c3b9_80923252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8db16f11102e58d181c19047762b56595bd4fdf6' => 
    array (
      0 => 'D:\\Web\\phpstudy_pro\\WWW\\templates\\index.html',
      1 => 1638101870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61b0ab7f62c3b9_80923252 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>


<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>
<?php if (is_numeric($_GET['score'])) {
if ($_GET['score'] >= 90) {?>
A
<?php } elseif ($_GET['score'] >= 80) {?>
B
<?php } else { ?>
C
<?php }?>
<hr>
<?php if (!(1 & $_GET['score'])) {?>
是偶数
<?php } elseif ((1 & $_GET['score'])) {?>
是奇数
<?php }
} else { ?>
不是数字
<?php }?>

</body>

</html><?php }
}
