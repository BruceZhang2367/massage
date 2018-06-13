<?php
    define ('APP_HOST',$_SERVER['HTTP_HOST']);

	$controller=isset($_GET['c'])? ucfirst($_GET['c']):'User';

	$action=isset($_GET['a'])?$_GET['a']:'register';

	$config=include ('./config.php');

	include ('./Common/function.php');

	use Controller\Controller;

	$controller = 'Controller\Home\\'.$controller;
// var_dump($controller);die;
	$cont=new $controller;

	$cont->$action();
