<?php 

namespace Controller\Admin;

use Controller\Controller;
use Model\DB;

Class Admin extends Controller
{
	public function add()
	{
		// echo "13213";die;

		 $db = new DB();
        
        
		$arr['admin_name'] = $_POST['admin_name'];
		$arr['admin_pwd'] = md5($_POST['admin_pwd']);
		$arr['sex'] = $_POST['sex'];
		$arr['phone'] = $_POST['phone'];
		$arr['email'] = $_POST['email'];
		$arr['time'] = time();
		$arr['admin_role'] = $_POST['admin_role'];
		$arr['desc'] = $_POST['desc'];

		$data = $db->add('role',$arr);
		//var_dump($data);die;
		if($data){
			echo "<script>alert('添加管理员成功');location.href='index.php?c=Back&a=admin_list';</script>";
		} else{
			echo "<script>alert('添加管理员失败');location.href='index.php?c=Admin&a=add';</script>";
		}
	}

	public function search()
	{
     
	}
}
