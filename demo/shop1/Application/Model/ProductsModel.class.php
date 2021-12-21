<?php
namespace Model;
//products模型用来操作products表
class ProductsModel extends \Core\Model{
	//获取products表的数据
	public function getList() {
		return $this->mypdo->fetchAll('select * from products');
	}
	//删除商品
	public function del($proid) {
		return $this->mypdo->exec("delete from products where proid=$proid");
	}
}
