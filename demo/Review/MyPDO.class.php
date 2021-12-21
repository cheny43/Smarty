<?php
class MyPDO
{
    private $type;
    private $link;
    private $host;
    private $port;
    private $user;
    private $pswd;
    private $dbname;
    private $charset;
    private static $instance;
    private function __construct($param)
    {
        $this->initParam($param);
        $this->initPDO();
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
    private function initParam($param)
    {
        $this->type = $param['type'] ?? 'mysql';
        $this->host = $param['host'] ?? '127.0.0.1';
        $this->port = $param['port'] ?? '3306';
        $this->user = $param['user'] ?? 'root';
        $this->pswd = $param['pswd'] ?? 'root';
        $this->dbname = $param['dbname'] ?? 'data';
        $this->charset = $param['charset'] ?? 'utf8';
    }
    // private function initConnect(){
    //    $this->link=@mysqli_connect($this->host,$this->pswd,$this->user,$this->dbname,$this->port);
    //    if(mysqli_connect_error()){
    //     echo '数据库连接失败<br>';
    //     echo '错误信息：'.mysqli_connect_error(),'<br>';
    //     echo '错误码：'.mysqli_connect_errno(),'<br>';
    //     exit;
    //    }
    //    mysqli_set_charset($this->link,$this->charset);
    // }
    private function initPDO()
    {
        try {
            $dsn = "{$this->type}:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";
            $this->link = new PDO($dsn, $this->user, $this->pswd);
        } catch (Exception $ex) {
            $this->showException($ex);
        }
    }
    private function showException($ex,$sql='')
    {
        if ($sql != '') {
            echo 'SQL语句执行失败<br>';
            echo '错误的SQL语句是：' . $sql, '<br>';
        }
        echo '错误编号：' . $ex->getCode(), '<br>';
        echo '错误行号：' . $ex->getLine(), '<br>';
        echo '错误文件：' . $ex->getFile(), '<br>';
        echo '错误信息：' . $ex->getMessage(), '<br>';
        exit;
    }
    private function exec($sql)
    {
        
    }
}
$param = [
    'user' => 'root',
    'pswd' => 'root',
    'dbname' => 'data'
];
$mypdo = MyPDO::getInstance($param);
echo '<pre>';
var_dump($mypdo);
