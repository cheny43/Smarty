<?php
require "./inc/conn.php";
$list = $DB->fetchAll('select * from blockit order by score desc', 'assoc');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">+
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<style>
    .small_title {
        float: right;
        padding-top: 30px;
    }

    a {
        font-size: 12px;
    }
</style>

<body>
    <div class="container">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h2 class="text-center">游戏排行榜<small class="small_title"><a href="blockIt.html">返回游戏</a></small></h2>
            </div>
            <div class="panel-body panel-danger">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info">
                            <th>编号</th>
                            <th>分数</th>
                            <th>时间</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['score'] ?></a></td>
                                <td><?php echo date('Y-m-d H:i:s', $row['datetime']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
?>