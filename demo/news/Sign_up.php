<?php
require("conn.php");
if ($_POST['Sign_up'] == '注册') {
    $sql = "insert into sheet1 values ('{$_POST['username']}','{$_POST['pwd']}','{$_POST['sex']}','{$_POST['edu']}'); ";
    mysqli_query($link, $sql);
    sleep(2);
    header('location:index.php');
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="text-center">注册</h2>
            </div>
            <div class="panel-body">
                <form method="POST" action="#" class="form-horizontal" role="form" onsubmit="return checkForm(this);">
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
                            <input type="password" id="pw" class="form-control password" name="pwd" onkeyup="checkpassword()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-md-push-1">性别</label>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-1">
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="男" checked>男
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="女">女
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="control-label col-md-2 col-md-push-1">学历</label>
                        <div class="col-md-3 col-md-offset-1">
                            <select name="edu" id="city" class="form-control">
                                <option name="edu">请选择学历</option>
                                <option value="高中">高中</option>
                                <option value="大专">大专</option>
                                <option value="本科">本科</option>
                                <option value="硕博">硕博</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4 text-center">
                            <input type="button" class="btn btn-success btn-sm" value="登录" name="Log_in" onclick="location.href='index.php'">
                            <input type="submit" class="btn btn-primary btn-sm" value="注册" name="Sign_up">
                            <!-- <button class="btn btn-success btn-sm">登录</button>
                            <button class="btn btn-primary btn-sm">注册</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    function checkForm(form) {
        if (form.username.value == "") {
            alert("用户名不能为空!");
            form.username.focus();
            return false;
        }
        if (form.pwd.value == "") {
            alert("密码不能为空!");
            form.pwd.focus();
            return false;
        }
        return true;
    }
</script>


</html>