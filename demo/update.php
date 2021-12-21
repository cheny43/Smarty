<?php
$table='products';
$data['proID']='111';
$data['proname']='钢笔';
$data['proprice']=120;

function getPrimaryKey($table){
    $link=mysqli_connect('localhost','root','root','data');
    mysqli_set_charset($link,'utf8');
    $rs=mysqli_query($link,"desc `{$table}`");
    while($rows=mysqli_fetch_assoc($rs)){
        if($rows['Key']=='PRI'){
            return $rows['Field'];
        }
    }
}
//获取键
$keys=array_keys($data);
$pk=getPrimaryKey($table);
$index=array_search($pk,$keys);
unset($keys[$index]);
$keys=array_map(function($key) use($data){
    return "`{$key}`='{$data[$key]}'";
},$keys);
$keys=implode(',',$keys);


echo "update `{$table}` set {$keys} where proid='{$data[$pk]}';";
