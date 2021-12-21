<?php
/* Smarty version 3.1.39, created on 2021-12-08 21:19:22
  from 'D:\Web\phpstudy_pro\WWW\templates\demo.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61b0b0da775685_51915867',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59f2c15bf0fc41588c5a9713ea3ae0791e59eb90' => 
    array (
      0 => 'D:\\Web\\phpstudy_pro\\WWW\\templates\\demo.html',
      1 => 1638969559,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61b0b0da775685_51915867 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, 'smarty.conf', 'winter', 0);
?>

    <style>
        body{
            color: <?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'color');?>
;
            font-size: <?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'size');?>
;
        }
    </style>
</head>
<body>
    春天
</body>
</html><?php }
}
