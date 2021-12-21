<?php
include('./inc/conn.php');
$list=$DB->exec("delete from news where id = '{$_GET['id']}'");
$sql = "delete from news where id = '{$_GET['id']}'";
sleep(1);
header('location:./list.php');
?>