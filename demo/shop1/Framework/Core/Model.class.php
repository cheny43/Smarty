<?php
namespace Core;
//基础模型
class Model
{
	protected $mypdo;
	public function __construct($table = '')
	{
		$this->initMyPDO();
		$this->initTable($table);
	}
	//连接数据库
	private function initMyPDO()
	{
		$this->mypdo = MyPDO::getInstance($GLOBALS['config']['database']);
	}
	//获取表名
	private function initTable($table)
	{
		if ($table != '') {
			$this->table = $table;
		} else {
			$this->table = substr(basename(get_class($this)), 0, -5);
		}
	}
	//万能的插入
	public function insert($data)
	{
		$keys = array_keys($data);
		$keys = array_map(function ($key) {
			return "`{$key}`";
		}, $keys);
		$keys = implode(',', $keys);
		$values = array_values($data);
		$values = array_map(function ($value) {
			return "'{$value}'";
		}, $values);
		$values = implode(',', $values);
		//insert into news (`proId`,`proname`,`proprice`) values ('111','钢笔','1000');  
		echo "insert into `{$this->table}` ($keys) values ($values);"; 
	}
}
