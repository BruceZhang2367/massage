<?php 
namespace Controller;
class Controller
{
    public $assign;

	public function display($file)
	{
	   if ($this->assign) {
	   	 extract($this->assign);
         include 'View/'.$file.'.php';
	   } else {
	   	 include 'View/'.$file.'.php';
	   }
       
	}
    
    public function assign($key,$value)
    {
        $this->assign[$key] = $value;
    }

}