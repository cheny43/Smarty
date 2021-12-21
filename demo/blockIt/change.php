<?php
include "./inc/conn.php";
if ($_GET['id']) {
    $sql = "select * from news where id='{$_GET['id']}'";
    $DB->fetchRow($sql);
    if (!empty($_POST)) {
        // $title = $_POST['title'];
        // $content = $_POST['content'];
        $sql = "update news set title='{$_POST['title']}',content='{$_POST['content']}' where id = '{$_GET['id']}'";
        if ($DB->exec($sql)) {
            header("location:./list.php");
        } else {
            echo '错误信息: ' . mysqli_error($link);
            exit;
        }
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="text-center">文章修改</h2>
            </div>
            <div class="panel-body">
                <form action="" method="POST">
                    标题：<input type="text" name="title"><br>
                    内容：<br><textarea name="content" id="" cols="60" rows="10" style="resize: none;"></textarea><br>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4 text-center">
                            <input type="submit" class="btn btn-success btn-sm" value="修改" name="chenge">
                            <input type="button" class="btn btn-primary btn-sm" value="返回" name="back" onclick="location.href='./list.php'">
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