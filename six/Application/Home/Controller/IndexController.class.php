<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页
    public function index(){
    	$data=M("category")->select();
    	$data=$this->rollData($data);
    	//print_r($data);die;
    	$this->assign("data",$data);
    	$this->display();
    }
    //登录
    public function login()
    {   
        $this->display("Login");
    }
    public function loginDo()
    {
        $user_name=I("post.user_name");
        $user_pwd=I("post.user_pwd");
        $goods_id=session("goods_id");
        $res=D("user")->where("user_name='$user_name'")->find();
        if($res)
        {
            if($res['user_pwd']==$user_pwd)
            {
                session("user_id",$res['user_id']);
                if(!empty($goods_id)){
                    $this->success("登录成功",U("Home/Index/product/goods_id/$goods_id"));
                }else{
                    $this->success("登录成功",U("Index/index"));
                }
                
            }else{
                $this->error("密码错误");
            }
        }else{
            $this->error("用户名不存在");
        }
    }
   
    //递归
    public function rollData($data,$path=0)
    {
    	$arr=array();
    	foreach($data as $k=>$v){
    		if($path==$v['cat_pid']){
    			$arr[$k]=$v;
    			$arr[$k]['child']=$this->rollData($data,$v['cat_id']);
    		}
    	}
    	return $arr;
    }
    //商品详情页
    public function product()
    {
    	$goods_id=I("goods_id");//商品ID
    	$goods_data=M("goods")->where("goods_id='$goods_id'")->find();
        $user_id=session('user_id');//用户ID
        //查询该商品 对应的 规格 和属性
    	$attr_data=M("goods_attr g")->join("attribute a on g.attr_id=a.attr_id")->field("g.goods_attr_id,g.goods_id,g.attr_id,g.attr_values,g.price,a.attr_type,a.attr_name")->where("g.goods_id='$goods_id'")->select();
   
       $new_arr=array();//规格
       $arr=array();//参数
       foreach ($attr_data as $key => $value) {
        if($value['attr_type']==1){
        $arr[]=$value;
        }else{
            $new_arr[$value['attr_id']]['name']= $value['attr_name'];
           $new_arr[$value['attr_id']]['value'][$value['goods_attr_id']]=$value['attr_values'];
        }
          //dump($new_arr);
       }
    	$this->assign("new_attr",$new_arr);
    	$this->assign("value",$arr);
    	$this->assign("goods_data",$goods_data);
    	$this->display();
    }
}