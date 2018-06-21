<?php 

namespace Controller\Admin;

use Controller\Controller;
use Model\DB;

Class User extends Controller
{
	public function login()
	{  
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];
		$db = new DB();
		$pdo = $db->db();
		//var_export($pdo);die;
		$sql = "select * from user where username='$username'";
	
		$res = $pdo->query($sql)->fetch(\PDO::FETCH_ASSOC);
		//var_dump($res);die;
		
		if (trim($username) == "" || trim($pwd) == "") {
			
			echo "<script>alert('请填写用户名或密码');location.href='index.php';</script>";
			    
		} elseif ($username != $res['username']) {
			echo "<script>alert('用户名不正确');location.href='index.php';</script>";

		} elseif($pwd != $res['pwd']){
			echo "<script>alert('密码不正确');location.href='index.php';</script>";

		} else{
			echo "<script>alert('登录成功');location.href='index.php?c=Back&a=index';</script>";
		}
	}
}
