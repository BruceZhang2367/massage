<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
	public function login()
	{
		$this->display();
	}
	public function code()
	{
		$Verify = new \Think\Verify();
		$Verify->fontSize = 18;
		$Verify->length   = 3;
		$Verify->useNoise = false;
		$Verify->useCurve = false;
		$Verify->codeSet = '0123456789'; 
		$Verify->entry();
	}
	public function login_do()
	{
		$username=I("post.username");
		$password=I("post.password");
		$code=I("post.code");
		$remember=I("post.remember",0);
		//echo "$remember";die;
		if($this->check_verify($code))
		{
			$res=D("admin_user")->where("username='$username'")->find();
			if($res)
			{
				if($res['pwd']==$password)
				{
					if($remember)
					{
						cookie("username",$username);
						cookie("password",$password);
					}
					session("user_id",$res['user_id']);
					$this->ajaxReturn(array("state"=>1,"msg"=>"登录成功"));
				}else{
					$this->ajaxReturn(array("state"=>2,"msg"=>"密码错误"));
				}
			}else{
				$this->ajaxReturn(array("state"=>0,"msg"=>"用户名不存在"));
			}
		}else{
			$this->ajaxReturn(array("state"=>-1,"msg"=>"验证码错误"));
		}
	}
	public function check_verify($code)
	{    
		$verify = new \Think\Verify();    
		return $verify->check($code, $id);
	}
	
}
?>