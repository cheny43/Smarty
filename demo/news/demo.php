<?php
spl_autoload_register(function ($class_name) {
    require "./inc/{$class_name}.class.php";
});
$param = [
    'user' => 'root',
    'pwd' => '123456',
    'dbname' => 'data'
];
$db = MYSQLDB::getInstance($param);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style type="text/css">
    table {
        width: 780px;
        border: solid #000 1px;
    }

    td,
    th {
        border: solid #000 1px;
    }
</style>

<body>
    <?php
    $pagesize = 10;
    // 第一步：获取总记录数
    $rowcount = $db->fetchColumn("select count(proID) from products");
    // 第二步：求出总页数
    $pagecount = ceil($rowcount / $pagesize);
    // 第三步：循环显示页码
    // 第四步：通过当前页面，求出起始位置
    $pageno = $_GET['pageno'] ?? 1;
    $pageno = $pageno < 1 ? 1 : $pageno;
    $pageno = $pageno > $pagecount ? $pagecount : $pageno;
    $startno = ($pageno - 1) * $pagesize;
    // 第五步：获取当前页面数据，并遍历显示
    $sql = "select * from products where proID>=(select proID from products limit $startno,1) limit $pagesize";
    $list = $db->fetchAll($sql);
    ?>
    <table>
        <thead>
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>规格</th>
                <th>价格</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $row) : ?>
                <tr>
                    <td><?= $row['proID'] ?></td>
                    <td><?= $row['proname'] ?></td>
                    <td><?= $row['proguige'] ?></td>
                    <td><?= $row['proprice'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="demo.php?pageno=1">首页</a>
    <a href="demo.php?pageno=<?=($pageno-1)<=1?1:$pageno-1?>">上一页</a>
    <?php for ($i = 1; $i <= $pagecount; $i++) : ?>
        <a href="demo.php?pageno=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
    <a href="?pageno=<?= $pageno + 1 ?>">下一页</a>
    <a href="demo.php?pageno=<?= $pagecount ?>">末页</a>
</body>

</html>