<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller 
{
	//商品添加页
	public function goodsAdd()
	{
		if(IS_POST){
			$post=I("post.");
			//dump($post);die;
			$goods_id=M("goods")->add($post);
			if($goods_id){
				$data=array();
				foreach($post['attr_value_list'] as $k=>$v){
					$data[$k]['goods_id']=$goods_id;
					$data[$k]['attr_id']=$post['attr_id_list'][$k];
					$data[$k]['price']=$post['attr_price_list'][$k];
					$data[$k]['attr_values']=$v;
				}
				foreach($data as $k=>$v){
					if($v['attr_values']==""){
						unset($data[$k]);
					}
				}
				//dump($data);
				if(M("goods_attr")->addAll($data)){
					$this->success("添加成功",U("Admin/Goods/product/goods_id/$goods_id"));
				}else{
					$this->error("添加失败");
				}
			}
			die;
		}
		$data=M("goods_type")->select();
		$this->assign("data",$data);
		$this->display("admin/goods_add");
	}
	//添加库存
	public function product()
	{
		$goods_id=I("get.goods_id");
		//echo "$goods_id";die;
		if(IS_POST){
			$post=I("post.");
			//dump($post);
			$goods_attr=array();
			foreach($post['attr_values'] as $key=>$val){
				foreach($val as $k=>$v){
					$goods_attr[$k][]=$v;
				}
			}
			//dump($goods_attr);
			foreach($goods_attr as $k=>$v){
				$goods_attr[$k]=implode(',',$v);
			}
			//dump($goods_attr);
			foreach($goods_attr as $k=>$v){
				$data[$k]['goods_id']=$goods_id;
				$data[$k]['goods_attr']=$v;
				$data[$k]['product_number']=$post['product_number'][$k];
				$data[$k]['product_sn']=$post['product_sn'][$k];
			}
			//dump($data);
			if(M("product")->addAll($data)){
				$this->success("添加成功",U("Goods/goodsList"));
			}else{
				$this->error("添加失败");
			}
		}
		
		$data=M("goods_attr g")->field("g.goods_attr_id,g.goods_id,g.attr_id,g.attr_values,a.attr_name")->join("attribute a on g.attr_id=a.attr_id")->where("g.goods_id='$goods_id' and a.attr_type=2")->select();

		$new_data=array();
		foreach($data as $k=>$v){
			$new_data[$v['attr_id']]['attr_name']=$v['attr_name'];
			$new_data[$v['attr_id']]['values'][$v['goods_attr_id']]=$v['attr_values'];
		}
		//dump($new_data);
		$this->assign("data",$new_data);
		$this->display("admin/products_add");
	}
	//查询所选分类下的所有属性
	public function getAttr()
	{
		$type_id=I("type_id");
		$data=M("attribute")->where("type_id='$type_id'")->select();
		foreach($data as $k=>$v){
			$data[$k]['attr_values']=explode("\r\n",$v['attr_values']);
		}
		//print_r($data);
		$this->assign("arr",$data);
		$this->display("admin/get_attr");
	}
	//商品展示
	public function goodsList()
	{
		$this->display("admin/goods_list");
	}
}