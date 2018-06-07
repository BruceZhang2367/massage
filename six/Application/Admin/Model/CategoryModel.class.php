<?php 
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model 
{
	public function getCategory($data,$path=0,$f=1)
	{
		static $arr=array();
		foreach($data as $k=>$v){
			if($v['cat_pid']==$path){
				$v['f']=$f;
				$arr[]=$v;
				$this->getCategory($data,$v['cat_id'],$f+1);
			}
		}
		return $arr;
	}
}
?>