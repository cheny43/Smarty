<?php
session_start();
require("conn.php");
if ($_POST['Log_in'] == '登录') {
    $sql = "select * from sheet1 where Myname='{$_POST['username']}' and password='{$_POST['pwd']}'";
    $rs = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($rs);
    if (empty($row)) {
        echo '用户输入的密码错误';
    } else {
        echo '用户输入的密码正确';
        $_SESSION['username']=$_POST['username'];
        header('location:list.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 150px;
            width: 700px;
            padding: 0 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h2 class="text-center">登录</h2>
            </div>
            <div class="panel-body">
                <form method="POST" action="#" class="form-horizontal" role="form">
                    <!-- 表单元素中的表单元素组 -->

                    <div class="form-group">
                        <label for="uname" class="control-label col-md-2 col-md-push-1">用户名</label>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-1">
                            <input type="text" name="username" id="uname" class="form-control" placeholder="请输入姓名...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pw" class="control-label col-md-2 col-md-push-1">密码</label>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-1">
                            <input type="password" id="pw" class="form-control" name="pwd">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-xs-4 col-sm-4 col-md-4 col-md-offset-4 text-center">
                            <input type="submit" class="btn btn-success btn-sm" value="登录" name="Log_in">
                            <input type="button" class="btn btn-primary btn-sm" id="button" value="注册" name="Sign up" onclick="location.href='Sign_up.php'">
                            <!-- <button class="btn btn-success btn-sm">登录</button>
                            <button class="btn btn-primary btn-sm">注册</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>