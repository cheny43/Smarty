<?php
require './inc/conn.php';
if(!empty($_POST['score'])){
    $score=$_POST['score'];
    $time=time();
    $list=$DB->exec("insert into blockit values(null,$score,$time)");
}
header("location:./blockIt.html");
?>