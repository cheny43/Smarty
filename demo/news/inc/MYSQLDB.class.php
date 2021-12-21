<?php
class MYSQLDB
{
    private $host;
    private $port;
    private $user;
    private $pwd;
    private $dbname;
    private $charset;
    private $link;
    private static $instance;
    private function __construct($param)
    {
        $this->initParam($param);
        $this->initConnect($param);
    }
    private function __clone()
    {
    }
    public static function getInstance($param = array())
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($param);
        }
        return self::$instance;
    }
    //初始化参数
    private function initParam($param)
    {
        $this->host = $param['host'] ?? '127.0.0.1';
        $this->port = $param['port'] ?? '3306';
        $this->user = $param['user'] ?? '';
        $this->pwd = $param['pwd'] ?? '';
        $this->dbname = $param['dbname'] ?? '';
        $this->charset = $param['charset'] ?? 'utf8';
    }
    private function initConnect()
    {
        $this->link = @mysqli_connect($this->host, $this->user, $this->pwd, $this->dbname);
        if (mysqli_connect_error()) {
            echo '数据库连接失败<br>';
            echo '错误版号: ' . mysqli_connect_errno() . '<br>';
            echo '错误信息: ' . mysqli_connect_error() . '<br>';
            exit;
        } else {
            mysqli_set_charset($this->link, $this->charset);
        }
    }
    private function execute($sql)
    {
        if (!$rs = mysqli_query($this->link, $sql)) {
            echo 'SQL语句执行失败<br>';
            echo '错误号: ' . mysqli_errno($this->link) . '<br>';
            echo '错误信息: ' . mysqli_error($this->link) . '<br>';
            echo '错误的SQL语句: ' . $sql . '<br>';
            exit;
        }
        return $rs;
    }
    //执行增删改
    public function exec($sql)
    {
        $key = substr($sql, 0, 6);
        if (in_array($key, array('insert', 'delete', 'update'))) {
            return $this->execute($sql);
        } else {
            echo '非法访问<br>';
            exit;
        }
    }
    //获得自动增长的编号
    public function getLastInsertId()
    {
        return mysqli_insert_id($this->link);
    }
    // 查询语句
    private function query($sql)
    {
        if (substr($sql, 0, 6) == 'select' || substr($sql, 0, 4) == 'desc' || substr($sql, 0, 4) == 'show') {
            return $this->execute($sql);
        } else {
            echo '非法访问<br>';
            exit;
        }
    }
    //执行查询语句,返回二维数组
    public function fetchAll($sql, $type = 'assoc')
    {
        $rs = $this->query($sql);
        $type = $this->getType($type);
        return mysqli_fetch_all($rs, $type);
    }
    public function fetchRow($sql, $type = 'assoc')
    {
        $list = $this->fetchAll($sql, $type);
        if (!empty($list))
            return $list[0];
        return array();
    } 
    public function fetchColumn($sql){
        $list = $this->fetchRow($sql,'num');
        if(!empty($list))
        return $list[0];
        return null;
    }

    private function getType($type)
    {
        switch ($type) {
            case 'num':
                return  MYSQLI_NUM;
            case 'both':
                return  MYSQLI_BOTH;
            default:
                return  MYSQLI_ASSOC;
        }
    }
}
// require 'config/config.php';
//获取单例
// $DB = MYSQLDB::getInstance($param);
// if ($MYSQLDB->exec("insert into news values (null,'aa','bb',unix_timestamp())")) {
//     echo '编号是：' . $MYSQLDB->getLastInsertId();
// }
// echo  '<pre>';
// $list = $MYSQLDB->fetchColumn('select count(*) from news');
// var_dump($list);
