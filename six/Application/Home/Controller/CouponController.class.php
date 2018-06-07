<?php
 namespace Home\Controller;
 use Think\Controller;
 class CouponController extends Controller 
 {
 	public function getCoupon()
 	{
 		$coupon_data=M("coupon c")->join("conditions con on c.condition_id=con.condition_id")->select();
 		//print_r($coupon_data);die;
 		//计算优惠券领取百分比
 		foreach($coupon_data as $k=>$v){
 			$user_c_num=M("user_c")->where("coupon_id=".$v['coupon_id'])->count();
			$coupon_data[$k]['coupon_count']=$user_c_num/$v['coupon_number']*100;
 		}
 		$this->assign("coupon_data",$coupon_data);
 		$this->display("Index/Coupon");
 	}
 	//用户领取优惠券
 	public function ajaxGet()
 	{
 		$coupon_id = I("get.coupon_id");
 		$user_id=session("user_id");
 		//计算优惠券是否剩余
 		$coupon_count=M("coupon")->where("coupon_id='$coupon_id'")->find();
 		$user_coupon_count=M("user_c")->where("coupon_id='$coupon_id'")->count();
 		if($user_coupon_count==$coupon_count['coupon_number']){
 			$this->ajaxReturn(array("state"=>-2,"msg"=>"优惠券已领取完，请等待下次活动"));
 			die;
 		}
 		//判断该用户是否领取了该优惠券
 		$user_c=M("user_c")->where(array("coupon_id"=>$coupon_id,"user_id"=>$user_id))->find();
 		if($user_c){
 			$this->ajaxReturn(array("state"=>-1,"msg"=>"您已经拥有此优惠券，请不要重复领取"));
 			die;
 		}
 		//领取优惠券
 		$res=M("user_c")->add(array("coupon_id"=>$coupon_id,"user_id"=>$user_id));
 		if($res){
 			$this->ajaxReturn(array("state"=>1,"msg"=>"领取成功"));
 		}else{
 			$this->ajaxReturn(array("state"=>0,"msg"=>"领取失败"));
 		}
 	}
} 