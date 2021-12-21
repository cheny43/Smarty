<?php
//update products set proname='钢笔',proprice='1000' where proid=111;
$table='products';
$date['proname']='钢笔';
$date['proprice']='1000';
$date['proID']='111';
function getPrimaryKey($table){
    $link=mysqli_connect('localhost','root','root','data');
    mysqli_set_charset($link,'utf8');
    $rs=mysqli_query($link,"desc {$table}");
    while($rows=mysqli_fetch_assoc($rs)){
        if($rows['Key']=='PRI'){
            return $rows['Field'];
        }
    }
}
$PRI=getPrimaryKey($table);
$keys=array_keys($date);
$index=array_search($PRI,$keys);
unset($keys[$index]);

echo $PRI.'<br>';

$keys=array_map(function($key) use($date) {
    return "`{$key}`= '{$date[$key]}'";
},$keys);
//var_dump($keys);
$keys=implode(',',$keys);
echo "update `{$table}` set {$keys} where `{$PRI}`='$date[$PRI]';";
?>