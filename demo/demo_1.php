<?php
function select($table, $cond = array())
{
    $sql = "select * from `{$table}` where 1";
    if (!empty($cond)) {
        foreach ($cond as $k => $v) {
            if (is_array($v)) {
                switch ($v[0]) {
                    case 'eq':
                        $op = '=';
                        break;
                    case 'gt':
                        $op = '>';
                        break;
                    case 'lt':
                        $op = '<';
                        break;
                    case 'egt':
                    case 'gte':
                        $op = '>=';
                        break;
                    case 'elt':
                    case 'lte':
                        $op = '<=';
                        break;
                    case 'neq'://neq不等于  数据库中的不等于为<>
                        $op = '<>';
                        break;
                }
                $sql .= " and `{$k}` {$op} '{$v[1]}'";
            } else {
                $sql .= " and `{$k}` = '{$v}'";
            }
        }
    }
    return $sql . ';';
}
$table = 'products';
$cond = [
    'proname' => '钢笔',
    'proprice' => array('gte', '12'),
    'aa'=>array('gte','20'),
    'bb'=>array('neq','100')
];
echo select($table) . '<br>';
echo select($table, $cond);
//select * from `{$table} where `proname`='' and `proprice`;
