<?php
namespace Controller\Admin;
//商品模块

class ProductsController extends \Core\Controller {
	//获取商品列表
	//引入Jump类
	
	public function listAction() {
		//实例化模型
		$model=new \Model\ProductsModel();
		$list=$model->select();
		//加载视图
		require __VIEW__.'products_list.html';
	}
	//删除商品
	public function delAction() {
		$id=(int)$_GET['proid'];	//如果参数明确是整数，要强制转成整形
		$model=new \Model\ProductsModel();
		if($model->delete($id)){
		    $this->success('location:index.php?p=Admin&c=Products&a=list','删除成功');
		}	
		else {
			$this->error('location:index.php?p=Admin&c=Products&a=list','删除失败');
		}
	}
	public function addAction(){
		//执行添加逻辑
		$model=new \Core\Model('products');
		if(!empty($_POST)){
			if($model->insert($_POST))
				$this->success ('index.php?p=Admin&c=Products&a=list', '插入成功');
			else
				$this->error ('index.php?p=Admin&c=Products&a=add', '插入失败');
		}
		//显示添加页面
		require __VIEW__.'products_add.html';
	}
	public function editAction(){
    $proid=$_GET['proid'];  //需要修改的商品id
    $model=new \Core\Model('products');
    //执行修改逻辑
    if(!empty($_POST)){
        $_POST['proID']=$proid;
        if($model->update($_POST))
            $this->success ('index.php?p=Admin&c=Products&a=list', '修改成功');
        else
            $this->error ('index.php?p=Admin&c=Products&a=edit&proid='.$proid, '修改失败');
    }
    //显示商品
    $info=$model->find($proid);
    require __VIEW__.'products_edit.html';
}
}

