<?php
namespace Admin\Controller;
use Think\Controller;
class GoodstypeController extends Controller 
{
	//商品类型展示
	public function goods_type_list()
	{

		$data=M("goods_type")->select();
		
		foreach($data as $k=>$v){
			$count=M("attribute")->join("goods_type on attribute.type_id=goods_type.goods_type_id")->where("type_id=".$v["goods_type_id"])->count();
			$data[$k]['count']=$count;
			$count="";
		}
		//print_r($data);die;
		$this->assign("data",$data);
		$this->display("admin/goods_type_list");
	}
	
	//商品类型添加
	public function goods_type_add()
	{
		if(IS_POST){
			$arr=I("post.");
			if(M("goods_type")->add($arr)){
				$this->success("添加成功",U("Goodstype/goods_type_list"));
			}else{
				$this->error("添加失败");
			}
		}
		$this->display("admin/goods_type_add");
	}
}