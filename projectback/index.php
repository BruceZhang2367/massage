<?php
	header("Content-type: text/html; charset=utf-8");

    define ('APP_HOST',$_SERVER['HTTP_HOST']);

	$controller=isset($_GET['c'])? ucfirst($_GET['c']):'Back';//控制器

	$action=isset($_GET['a'])?$_GET['a']:'login';//方法

	$config=include ('./config.php');

	include ('./Common/function.php');

	use Controller\Controller;

	$controller = 'Controller\Admin\\'.$controller;
    //var_dump($controller);die;
	$cont=new $controller;

	$cont->$action();
