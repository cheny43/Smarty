<?php
//连接数据库
$link = @mysqli_connect('localhost','root','root','gg') or die('错误: '.mysqli_connect_error());
mysqli_set_charset($link,'utf8');
