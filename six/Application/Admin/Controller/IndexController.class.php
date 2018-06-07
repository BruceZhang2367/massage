<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index()
    {
    	$this->display("index/index");
    }
    public function top()
    {
    	$this->display();
    }
    public function drag()
    {
    	$this->display();
    }
    public function main()
    {
    	$this->display();
    }
    public function menu()
    {
    	$this->display();
    }
}