<?php 
namespace Controller;
class Controller
{
	public function display($file)
	{
     include 'View/'.$file.'.php';
	}
}