<?php
namespace Admin\Controller;
use Think\Controller;
class CouponController extends Controller 
{
	public function couponAdd()
	{
		if(IS_POST){
			$post_data=I("post.");
			$post_data['start_time']=time();
			$post_data['end_time']=time()+86400*7;
			M("coupon")->add($post_data);die;
		}
		$cat_data=M("category")->select();
		$condition=M("conditions")->select();

		$this->assign("cat_data",$cat_data);
		$this->assign("condition",$condition);
		$this->display("admin/admin");
	}
}