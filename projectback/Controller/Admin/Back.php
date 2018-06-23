<?php 

namespace Controller\Admin;

use Controller\Controller;
use Model\DB;

Class Back extends Controller
{
	public function login()
	{
		$this->display('back/login');
	}

	public function index()
	{
		$this->display('back/index');
	}

	public function welcome()
	{
		$this->display('back/welcome');
	}
	public function admin_role()
	{
		$this->display('admin/admin_role');
	}

	public function admin_list()
    { 
       $db = new DB();
	   $data = $db->select('role');
	   $this->assign('data',$data);
	   $this->display('admin/admin_list');	
	  
	   // include('View/Admin/admin_list.php');
    }

	public function admin_add()
	{
		$this->display('admin/admin_add');
	}
	public function add(){
		
	}
}