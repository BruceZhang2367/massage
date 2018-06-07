<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function __construct()
	{
		parent::__construct();
		// $session=session("role_id");
		// if(empty($session))
		// {
		// 	$this->error("非法登录",U("admin/login"));die;
		// }
		$power=D("r_p r")->join("power p on r.power_id=p.power_id")->where("role_id=".$session)->select();
		//print_r($power);die;
		$controller_name=CONTROLLER_NAME;
		$action_name=ACTION_NAME;
		// echo $controller_name;
		// echo $action_name;die;
		$f=false;
		foreach($power as $k=>$v)
		{
			if(strtolower($controller_name) == strtolower($v['controller_name']) && strtolower($action_name) == strtolower($v['action_name']))
			{
				$f=true;
			}
		}
		// if(!$f)
		// {
		// 	echo "无此权限";die;
		// }
	}
}