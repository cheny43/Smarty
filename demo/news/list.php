<?php
session_start();
require('./inc/conn.php');
$list=$DB->fetchAll('select * from news order by id desc','assoc');
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
        .small_title{
            float: right;
            padding-top: 30px;
         }
         a{
             font-size: 12px;
         }
    </style>
</head>
<body>`
    <div class="container">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h2 class="text-center">文章管理<small class="small_title">欢迎你 &nbsp;&nbsp; <?php echo $_SESSION['username']?>&nbsp;&nbsp; <a href="Clear_session.php">注销</a></small></h2>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr  class="info">
                            <th>编号</th>
                            <th>标题</th>
                            <th>内容</th>
                            <th>时间</th>
                            <th>修改</th>
                            <th>删除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo $row['content'] ?></td>
                                <td><?php echo date('Y-m-d H:i:s', $row['createtime']) ?></td>
                                <td><input type="button" value="修改" name="change" onclick="location.href='./change.php?id=<?php echo $row['id']; ?>'"></td>
                                <td><input type="button" value="删除" name="delete" onclick="location.href='./del.php?id=<?php echo $row['id'] ?>'"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="./add.php">添加文章</a>
            </div>
        </div>
    </div>

</body>

</html>