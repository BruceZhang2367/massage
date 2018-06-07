.<?php
namespace Admin\Controller;
use Think\Controller;
class AttributeController extends Controller 
{
	//类型属性展示
	public function attribute_list()
	{
		$goods_type_id=I("goods_type_id",0);
		//echo "$goods_type_id";die;
		if($goods_type_id==0){
			$where=1;
		}else{
			$where="goods_type_id='$goods_type_id'";
		}
		$arr=M("goods_type")->select();
		$data=M("attribute")->join("goods_type on attribute.type_id=goods_type.goods_type_id")->where($where)->select();
		foreach($data as $k=>$v){
			$data[$k]['attr_values']=str_replace("\r\n",',',$v['attr_values']);
		}
		//print_r($data);die;
		$this->assign("data",$data);
		$this->assign("arr",$arr);
		$this->display("admin/attribute_list");
	}
	//ajax查询所选分类下的属性
	public function getAttr()
	{
		$goods_type_id=I("goods_type_id");
		if($goods_type_id==0){
			$where=1;
		}else{
			$where="goods_type_id='$goods_type_id'";
		}
		$data=M("attribute")->join("goods_type on attribute.type_id=goods_type.goods_type_id")->where($where)->select();
		foreach($data as $k=>$v){
			$data[$k]['attr_values']=str_replace("\r\n",',',$v['attr_values']);
		}
		$this->ajaxReturn($data);
	}
	//类型属性添加
	public function attribute_add()
	{
		if(IS_POST){
			$data=I("post.");
			if(M("attribute")->add($data)){
				$this->success("添加成功",U("Attribute/attribute_list"));
			}else{
				$this->error("添加失败");
			}
		}
		$data=M("goods_type")->select();
		$this->assign("data",$data);
		$this->display("admin/attribute_add");
	}
}
?>