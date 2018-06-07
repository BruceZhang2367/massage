<?php
namespace Home\Controller;
use Think\Controller;
class FindController extends Controller {
    public function index(){

    }
    
    public function sou(){
    	//$data=I("post.");
    	//echo "你好";
    	$res =D("brand")->select();
    	//var_dump($res);die;
    	$this->assign("res",$res);
    	$this->display('index/find');
    }
    public function find_do(){
    	//$find_id=I("get",$find_id);
    	// $goods_name =I('post.',"brand_name");
    	//$res= D("brand")->find('LIKE %$goods_name%');
         

    }
}
16:30 end;
































?>