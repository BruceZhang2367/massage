<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller 
{
	//商品列表页
	public function goodsList()
	{
		$cat_id=I("cat_id");
		//echo "$cat_id";die;
		//查询所有分类
		$data=D("category")->select();
		
		//查询当前分类下所有子分类
		$data_list=$this->rollChild($data,$cat_id);

		$data_arr=array();
		$data_arr[]=$cat_id;
		//取出查询到分类中的分类id
		foreach($data_list as $k=>$v){
			$data_arr[]=$v['cat_id'];
		}
		//处理分类id
		$cat_ids=implode(",",$data_arr);

		//查询商品在分类id中的所有商品
		$cat_data=M("goods")->where("cat_id in ($cat_ids)")->select();
		$cat_parent=$this->rollParents($data,$cat_id);
		krsort($cat_parent);

		//拼接字符串
		$nav_list="全部 >>";
		$nav_arr=array();
		foreach($cat_parent as $k=>$v){
			$nav_list .= $v['cat_name']." >>";
		}
		$this->assign("nav_list",$nav_list);
		$this->assign("cat_data",$cat_data);
		$this->display("Index/CategoryList");
	}
	//递归查询分类下的所有子分类
	public function rollChild($data,$cat_id)
	{
		static $arr=array();
		foreach($data as $k=>$v){
			if($v['cat_pid']==$cat_id){
				$arr[]=$v;
				$this->rollChild($data,$v['cat_id']);
			}
		}
		return $arr;
	}
	//递归逆查询当先分类的父级分类
	public function rollParents($data,$cat_id)
	{
		static $arr=array();
		foreach($data as $k=>$v){
			if($v['cat_id']==$cat_id){
				$arr[]=$v;
				$this->rollParents($data,$v['cat_pid']);
			}
		}
		return $arr;
	}
}