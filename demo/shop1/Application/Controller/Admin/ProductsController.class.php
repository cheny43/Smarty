<?php
namespace Controller\Admin;
//商品模块

class ProductsController {
	//获取商品列表
	//引入Jump类
	use \Traits\Jump;
	public function listAction() {
		//实例化模型
		$model=new \Model\ProductsModel();
		$list=$model->getList();
		//加载视图
		require __VIEW__.'products_list.html';
	}
	//删除商品
	public function delAction() {
		$id=(int)$_GET['proid'];	//如果参数明确是整数，要强制转成整形
		$model=new \Model\ProductsModel();
		if($model->del($id)){
		    $this->success('location:index.php?p=Admin&c=Products&a=list','删除成功');
		}	
		else {
			$this->error('location:index.php?p=Admin&c=Products&a=list','删除失败');
		}
	}
}

