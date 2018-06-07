<?php
  namespace Home\Controller;
  use Think\Controller;
  class CartController extends Controller 
  {
  	public function cartAdd()
  	{
  		$user_id=session("user_id");
  		$goods_id=I("get.goods_id");
  		$num=I("get.num");
  		$goods_attr_id=implode(",",I("get.goods_attr_id"));
  		$goods_values=implode(",",I("get.goods_values"));
    
  		//判断是否登录
  		if(empty($user_id)){
  			session("goods_id",$goods_id);
  			$this->ajaxReturn(array("state"=>0,"msg"=>"请先登录才能加入购物车","url"=>U("Index/login")));
  			die;
  		}
  		//查商品表
  		$goods_data=M("goods")->where("goods_id='$goods_id'")->find();
 		//查属性值表，计算价格
  		$attr_data=M("goods_attr")->field("sum(price) as price")->where("goods_attr_id in ($goods_attr_id)")->select();
  		//计算商品价格
  		foreach($attr_data as $k=>$v){
  			$goods_price = $v['price']+$goods_data['shop_price'];
  		}
  		//查库存表，查询库存数量
  		$product_data=M("product")->where("goods_id='$goods_id' and goods_attr='$goods_attr_id'")->find();
  		//判断库存和购商品的数量
  		if($product_data['product_number']<$num){
  			$this->ajaxReturn(array("state"=>-1,"msg"=>"库存不足，请减少购买数量或购买其他商品"));
  			die;
  		}
  		//查购物车表，查看是否同一个用户购买过同一种属性的同一种商品
  		$cart_data=M("cart")->where("user_id='$user_id' and goods_id='$goods_id' and goods_attr_id='$goods_attr_id'")->find();
  		//如果查询到购买过同样的商品，执行修改语句，让数量修改
  		if($cart_data){
  			$cart_data['goods_number']=$cart_data['goods_number']+$num;
  			$save=M("cart")->save($cart_data);
  			if($save){
  				$this->ajaxReturn(array("state"=>1,"msg"=>"加入购物车成功","url"=>U("Cart/buyCar")));
  				die;
  			}
  		}
  		//拼接数组
  		$data=array(
  				"user_id"=>$user_id,
  				"goods_id"=>$goods_id,
  				"goods_sn"=>$goods_data['goods_sn'],
  				"product_id"=>$product_data['product_id'],
 				"goods_name"=>$goods_data['goods_name'],
  				"goods_price"=>$goods_price,
  				"goods_number"=>$num,
  				"goods_attr"=>$goods_values,
  				"goods_attr_id"=>$goods_attr_id
  			);
  		//添加到购物车表
  		$res=M("cart")->add($data);
  		if($res){
  			$this->ajaxReturn(array("state"=>1,"msg"=>"加入成功","url"=>U("Cart/buyCar")));
  			die;
  		}
  	}
 	//购物车列表页
      public function buyCar()
      {
         $cart_data=M("cart")->select();
          $goods_price=0;
         //计算每一种商品的价格
         foreach($cart_data as $k=>$v){
         	$goods_price += $v['goods_price']*$v['goods_number'];
          }
          $this->assign("goods_price",$goods_price);
          $this->assign("cart_data",$cart_data);
          $this->display("Index/BuyCar");
      }
      //商品数量的既点即改
      public function changeNum()
      {
          $user_id=session("user_id");
      	$arr['goods_number']=I("get.num");
      	$arr['cart_id']=$cart_id=I("get.cart_id");
      	//print_r($arr);die;
   	
      	if(M("cart")->save($arr)){
      		$cart_data=M("cart")->where("user_id='$user_id'")->select();
      		// $data=M("cart")->where("cart_id='$cart_id'")->find();
              $small_price=0;
      		$goods_price=0;
          	//计算每一种商品的价格
          	foreach($cart_data as $k=>$v){
                  if($v['cart_id']==$arr['cart_id']){
                      $small_price=$v['goods_price']*$v['goods_number'];
                  }
          		$goods_price += $v['goods_price']*$v['goods_number'];
        		}
         		$data=array(
                      "small_price"=>$small_price,
                      "goods_price"=>$goods_price
                  );
      		$this->ajaxReturn($data);
      	}
      }
      public function buyCar_two()
      {
      	//查询当前登录用户的配送地址
          $user_id=session("user_id");
          $address_data=M("user_address")->where("user_id='$user_id'")->select();
          foreach($address_data as $k=>$v){
          	$new_arr=array();
          	$new_str="";
          	$new_arr['country']=$v['country'];
          	$new_arr['province']=$v['province'];
          	$new_arr['city']=$v['city'];
          	$new_arr['district']=$v['district'];
          	$new_str=implode(",",$new_arr);
         	$new_address=M("region")->where("region_id in ($new_str)")->select();
         	$str="";
          	foreach($new_address as $key=>$val){
          		$str.=$val['region_name']."-";
          	}
          	//print_r($new_address);
         	$address_data[$k]['new_address']=$str.$v['address'];
          }
          //print_r($address_data);die;
          //查询当前用户购物车中的商品
     	$cart_data=M("cart")->select();
          $goods_price=0;
          foreach($cart_data as $k=>$v){
          	$goods_price += $v['goods_price']*$v['goods_number'];
          }
          //查询当前用户拥有的优惠券
          $coupon_data="SELECT * FROM user_c u LEFT JOIN coupon c ON u.coupon_id=c.coupon_id LEFT JOIN conditions cc ON c.condition_id=cc.condition_id WHERE user_id='$user_id'";
          $coupon_data=M("user_c")->query($coupon_data);
          foreach($coupon_data as $k=>$v){
             //判断总价格是否满足红包使用条件1
             if($v['condition_name']>$goods_price){
                 unset($coupon_data[$k]);
             }
         }
         // print_r($coupon_data);die;
         //多级联动
         $region=M("region")->where("parent_id=0")->select();
         // print_r($region);die;
         $this->assign("coupon_data",$coupon_data);
         $this->assign("address_data",$address_data);
         $this->assign("goods_price",$goods_price);
         $this->assign("cart_data",$cart_data);
     	$this->assign("region",$region);
     	$this->display("Index/BuyCar_two");
     }
      //多级联动
      public function selectRegoin()
      {
      	$region=I("get.region");
      	$region_data=M("region")->where("parent_id='$region'")->select();
      	$this->ajaxReturn($region_data);
      }
      public function buyCar_three()
      {
      
          $order_sn=I("get.order_sn");
          $this->assign("order_sn",$order_sn);
     	$this->display("Index/BuyCar_three");
     }
 } 