<?php 
namespace Controller\Home;
use Controller\Controller;
use Model\DB;
Class Show extends Controller
{
	 public function duanzi()
	 {
	 	$this->display('show/duanzi');
	 }

	 public function ganhuo()
	 {
	 	$this->display('show/ganhuo');
	 }
	 public function youduanzi()
	 {
        $this->display('show/youduanzi');
	 }
	  public function about()
	 {
        $this->display('show/about');
	 }
  
     public function D17()
	 {
        $this->display('show/D17');
	 }
}