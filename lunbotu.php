<?php 
header("content-type:text/html;charset=utf-8");

	mysql_connect('127.0.0.1','root','') or die('连接数据库失败1');

	$res=mysql_select_db("daka");
   
	if (!$res) {
		die ("没有选择任何数据库");
		}else{
		echo "数据库daka已经选择，可以使用该数据库了";
	}
    
	mysql_query('set names','utf8');
    
	$user=$_POST['user'];
	$desc=$_POST['desc'];
	$time=time();
	echo $user;
	echo $desc;
	echo $time; die;
 ?>