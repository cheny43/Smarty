<?php
namespace Lib;
class Session{
    private $mypdo;
    public function __construct() {
        session_set_save_handler(
            [$this,'open'],
            [$this,'close'],
            [$this,'read'],
            [$this,'write'],
            [$this,'destroy'],
            [$this,'gc']
        );
        session_start();
    }
    public function open() {
        $this->mypdo= \Core\MyPDO::getInstance($GLOBALS['config']['database']);
        return true;
    }
    //关闭会话
    public function close() {
        return true;
    }
    //读取会话
    public function read($sess_id) {
        $sql="select sess_value from sess where sess_id='$sess_id'";
        return (string)$this->mypdo->fetchColumn($sql);
    }
    //写入会话
    public function write($sess_id,$sess_value) {
        $sql="insert into sess values ('$sess_id','$sess_value',unix_timestamp()) on duplicate key update sess_value='$sess_value',sess_time=unix_timestamp()";
        return $this->mypdo->exec($sql)!==false;
    }
    //销毁会话
    public function destroy($sess_id) {
        $sql="delete from sess where sess_id='$sess_id'";
        return $this->mypdo->exec($sql)!==false;
    }
    //垃圾回收
    public function gc($lifetime) {
        $expires=time()-$lifetime;	//过期时间点
        $sql="delete from sess where sess_time<$expires";
        return $this->mypdo->exec($sql)!==false;
    }
}
