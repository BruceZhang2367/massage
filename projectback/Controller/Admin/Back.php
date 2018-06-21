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
}