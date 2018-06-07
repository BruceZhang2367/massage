<?php
namespace Home\Controller;
use Think\Controller;
 class OrderController extends Controller
 {
 	public function addOrder()
 	{
 		//1.将数据添加到商品配送表  2.根据添加成功的商品配送表的id添加到订单商品表
 		$post_data=I("post.");

 		$user_id=session("user_id");
 		// print_r($post_data);die;
 		//查询当前用 户选择的收货地址
 		//定义配送方式
 		$postType=array("","申通快递","城际快递","邮局平邮");
 		$payType=array("","余额支付","银行亏款/转账","货到付款","支付宝");
 		$address=M("user_address")->where("user_id='$user_id' and address_id=".$post_data['address'])->find();
 		//查询订单表，计算商品价格
 		$cart_data=M("cart")->where("user_id='$user_id'")->select();
 		//print_r($cart_data);die;
 		$goods_amount=0;
 		foreach($cart_data as $k=>$v){
 			$goods_amount+=$v['goods_number']*$v['goods_price'];
 		}
		
 		if(!empty($post_data['coupon_id'])){
 			$coupon_price=M("coupon")->where("coupon_id=".$post_data['coupon_id'])->find();
 			$order_amount=$goods_amount-$coupon_price['coupon_price'];
 		}else{
 			$order_amount=$goods_amount;
 		}
 		//echo "$goods_amount";die;
 		//开启事务
 		M()->startTrans();
 		$order_data=array(
 				"order_sn"=>time().rand(0,10000),
 				"user_id"=>$user_id,
 				"order_status"=>1,//订单的确认状态  1为确认
 				"pay_status"=>0,//订单的支付状态  0为未支付
 				"shipping_name"=>$postType[$post_data['postType']],//配送方式
 				"shipping_id"=>$post_data['postType'],//配送方式id
 				"consignee"=>$address['consignee'],
 				"country"=>$address['country'],
 				"province"=>$address['province'],
 				"city"=>$address['city'],
 				"district"=>$address['district'],	
 				"tel"=>$address['tel'],
 				"address"=>$address['address'],
 				"pay_id"=>$post_data['pay_id'],
				"pay_name"=>$payType[$post_data['pay_id']],
 				"goods_amount"=>$goods_amount,//商品总价
 				"order_amount"=>$order_amount//实际付款
 			);
 		$order_id=M("order_info")->add($order_data);
 		if($order_id){
 			//添加到订单商品表  由于订单商品表中的字段和购物车表的字段大致相同，所以只需要在购物车数据中加一个order_id字段
 			foreach($cart_data as $k=>$v){
 				$cart_data[$k]['order_id']=$order_id;
 			}
      //dump($cart_data);die;
 			$res=M("order_goods")->addAll($cart_data);

 			if($res){
 				//订单创建成功，从库存表中减去购买数量
 				foreach($cart_data as $k=>$v){
 					$goods_product=array();
 					$goods_product=M("product")->where("goods_id=".$v['goods_id']." and goods_attr='".$v['goods_attr_id']."'")->find();
 					$goods_product['product_number']=$goods_product['product_number']-$v['goods_number'];
 					M('product')->save($goods_product);
 				}
				
 				//M("cart")->where("user_id='$user_id'")->delete();
 				//事务提交
 				M()->commit();
 				// print_r($order_data);die;
 				$this->redirect("sellOrder",array("order_sn"=>$order_data['order_sn']));
 			}else{
 				//事务回滚
 				M()->rollback();
 				$this->error("生成订单失败");
 			}
 		}
 	}
 	//付款
 	public function sellOrder()
 	{
 		// ******************************************************配置 start*************************************************************************************************************************
 		//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
 		//合作身份者id，以2088开头的16位纯数字
    // dump($_GET);die;
 		$alipay_config['partner']		= '2088121321528708';
 		//收款支付宝账号
 		$alipay_config['seller_email']	= 'itbing@sina.cn';
 		//安全检验码，以数字和字母组成的32位字符
 		$alipay_config['key']			= '1cvr0ix35iyy7qbkgs3gwymeiqlgromm';
 		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
 		//签名方式 不需修改
 		$alipay_config['sign_type']    = strtoupper('MD5');
 		//字符编码格式 目前支持 gbk 或 utf-8
 		//$alipay_config['input_charset']= strtolower('utf-8');
 		//ca证书路径地址，用于curl中ssl校验
 		//请保证cacert.pem文件在当前文件夹目录中
 		//$alipay_config['cacert']    = getcwd().'\\cacert.pem';
 		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';
 		// ******************************************************配置 end*************************************************************************************************************************

		// ******************************************************请求参数拼接 start*************************************************************************************************************************
		// $order_id = time().rand(100000,999999);
//	$order_sn=I("get.order_sn");
	// echo "$order_sn";die;
	$parameter = array(
	    "service" => "create_direct_pay_by_user",
		    "partner" => $alipay_config['partner'], // 合作身份者id
		    "seller_email" => $alipay_config['seller_email'], // 收款支付宝账号
		    "payment_type"	=> '1', // 支付类型
		    "notify_url"	=> "http://localhost/res.php", // 服务器异步通知页面路径
		    "return_url"	=> "http://localhost/six/index.php/Home/Cart/buyCar_three", // 页面跳转同步通知页面路径
		    "out_trade_no"	=> I('get.order_sn'), // 商户网站订单系统中唯一订单号
		    "subject"	=> "订单", // 订单名称
 		    "total_fee"	=> "0.02", // 付款金额
 		    "body"	=> "1512C", // 订单描述 可选
 		    "show_url"	=> "", // 商品展示地址 可选
 		    "anti_phishing_key"	=> "", // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
 		    "exter_invoke_ip"	=> "", // 客户端的IP地址
 		    "_input_charset"	=> 'utf-8', // 字符编码格式
  		);
  		// 去除值为空的参数
  		foreach ($parameter as $k => $v) {
  		    if (empty($v)) {
  		        unset($parameter[$k]);
  		    }
  		}
  		// 参数排序
  		ksort($parameter);
 		reset($parameter);
 		// 拼接获得sign
  		$str = "";
  		foreach ($parameter as $k => $v) {
  		    if (empty($str)) {
  		        $str .= $k . "=" . $v;
  		    } else {
  		        $str .= "&" . $k . "=" . $v;
  		    }
  		}
  		$parameter['sign'] = md5($str . $alipay_config['key']);	// 签名
  		$parameter['sign_type'] = $alipay_config['sign_type'];
  		// ******************************************************请求参数拼接 end*************************************************************************************************************************
 	// ******************************************************模拟请求 start*************************************************************************************************************************
  		$sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='https://mapi.alipay.com/gateway.do?_input_charset=utf-8' method='get'>";
  		foreach ($parameter as $k => $v) {
  		    $sHtml.= "<input type='text' name='" . $k . "' value='" . $v . "'/>";
  		}
 		$sHtml .= '<input type="submit" value="去支付">';
 		//$sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";
 		// ******************************************************模拟请求 end*************************************************************************************************************************
  		//var_dump($sHtml);
  		echo $sHtml;
 	}
  	//修改订单支付状态
  	public function changeOrder()
  	{
  		$order_sn=I("get.out_trade_no");
  		echo "$order_sn";
  		$res=M("order_info")->where("order_sn='$order_sn'")->save(array("pay_status"=>1));
  		if($res){
        M("cart")->where("user_id='$user_id'")->delete();
  			echo "成功";die;
  		}
  	}
 } 