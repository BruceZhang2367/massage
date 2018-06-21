<?php
namespace Model;
class DB
{

public function db()
 {

 	$db=C('db');
 	$host='mysql:host='.$db['host'].';dbname='.$db['dbname'].';charset='.$db['charset'].';';
 	$username=$db['username'];
 	$pwd=$db['password'];
 	$pdo= new \PDO($host,$username,$pwd);

 	return $pdo;
 }

 public function add($table,$values)
 { 

 	$pdo=$this->db();
    $val="";
    $bian="";
    foreach ($values as $k => $v) {
    	$val.=$k.',';
    	$bian.="'".$v."'".',';
    }
    $vals=rtrim($val,',');
    $binss=rtrim($bian,',');
 	$sql="insert into $table ($vals) values($binss)";
 	$gei=$pdo->exec($sql);
 	return $gei;
 }
 
}
