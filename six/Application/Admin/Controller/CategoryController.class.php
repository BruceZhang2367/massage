<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller 
{
	//分类展示
	public function CategoryList()
	{
		$data=M("category")->where("cat_pid=0")->select();
		//$data=D("category")->getCategory($data);
		//print_r($data);
		$this->assign("data",$data);
		$this->display("admin/cat_list");
	}
	//折叠菜单的查询
	public function searchChild()
	{
		$cat_id=I("cat_id");
		$data=M("category")->where("cat_pid='$cat_id'")->select();
		$this->ajaxReturn($data);
	}
	//分类添加
	public function CategoryAdd()
	{
		if(IS_POST){
			$arr=I("post.");
			if(M("category")->add($arr)){
				$this->success("添加成功",U("Category/CategoryList"));
			}
			die;
		}
		$data=M("category")->select();
		$data=D("category")->getCategory($data);
		$this->assign("data",$data);
		$this->display("admin/cat_add");
	}
}