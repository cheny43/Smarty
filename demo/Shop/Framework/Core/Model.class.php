<?php

namespace Core;
//基础模型
class Model
{
	protected $mypdo;
	private $table;
	private $pk;
	public function __construct($table = '')
	{
		$this->initMyPDO();
		$this->initTable($table);
		$this->getPrimaryKey();
	}
	//连接数据库
	private function initMyPDO()
	{
		$this->mypdo = MyPDO::getInstance($GLOBALS['config']['database']);
	}
	//获取表名
	private function initTable($table)
	{
		if ($table != '')		//直接给基础模型传递表名
			$this->table = $table;
		else {				//实例化子类模型
			$this->table = substr(basename(get_class($this)), 0, -5);
		}
	}
	//获取主键
	private function getPrimaryKey()
	{
		//查看表结构
		$rs = $this->mypdo->fetchAll("desc `{$this->table}`");
		//循环判断主键
		foreach ($rs as $rows) {
			if ($rows['Key'] == 'PRI') {
				$this->pk = $rows['Field'];
				break;
			}
		}
	}
	//万能的插入
	public function insert($data)
	{
		$keys = array_keys($data);		//获取所有的字段名
		$keys = array_map(function ($key) {	//在所有的字段名上添加反引号
			return "`{$key}`";
		}, $keys);
		$keys = implode(',', $keys);		//字段名用逗号连接起来

		//第二步：拼接值
		$values = array_values($data);	//获取所有的值
		$values = array_map(function ($value) {	//所有的值上添加单引号
			return "'{$value}'";
		}, $values);
		$values = implode(',', $values);	//值通过逗号连接起来

		//第三步：拼接SQL语句

		$sql = "insert into `{$this->table}` ($keys) values ($values)";
		return $this->mypdo->exec($sql);
	}
	//万能的更新
	public function update($data)
	{
		$keys = array_keys($data);	//获取所有键	
		$index = array_search($this->pk, $keys);	//返回主键在数组中的下标
		unset($keys[$index]);		//删除主键
		//第二步：拼接`键`='值'的形式
		$keys = array_map(function ($key) use ($data) {
			return "`{$key}`='{$data[$key]}'";
		}, $keys);
		$keys = implode(',', $keys);
		//第三步：拼接SQL语句
		$sql = "update `{$this->table}` set $keys where {$this->pk}='{$data[$this->pk]}'";
		return $this->mypdo->exec($sql);
	}
	//万能的删除
	public function delete($id)
	{
		$sql = "delete from `{$this->table}` where  `{$this->pk}` = '{$id}'";
		return $this->mypdo->exec($sql);
	}
	//万能的查询(查询二维数组)
	public function select($cond = array())
	{
		$sql = "select * from `{$this->table}` where 1";
		//拼接条件
		if (!empty($cond)) {
			foreach ($cond as $k => $v) {
				if (is_array($v)) {	//条件的值是数组类型
					switch ($v[0]) {	//$v[0]保存的是符号，$v[1]是值
						case 'eq':		//等于  equal
							$op = '=';
							break;
						case 'gt':		//大于  greater than
							$op = '>';
							break;
						case 'lt':
							$op = '<';
							break;
						case 'gte':
						case 'egt':
							$op = '>=';
							break;
						case 'lte':
						case 'elt':
							$op = '<=';
							break;
						case 'neq':
							$op = '<>';
							break;
					}
					$sql .= " and `$k` $op '$v[1]'";
				} else {
					$sql .= " and `$k`='$v'";
				}
			}
		}

		return $this->mypdo->fetchAll($sql);
	}
	//查询一维数组
	public function find($id)
	{
		$sql = "select * from `{$this->table}` where `{$this->pk}`='{$id}'";
		return $this->mypdo->fetchRow($sql);
	}
}
