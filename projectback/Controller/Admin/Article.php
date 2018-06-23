<?php 

namespace Controller\Admin;

use Controller\Controller;
use Model\DB;

Class Article extends Controller
{
	public function article_list()
	{   $db = new DB();
		$data = $db->select('article');
		$this->assign('data',$data);
		$this->display('article/article_list');
	}

	public function article_add()
	{
		$this->display('article/article_add');
	}

	public function add()
	{
		$db = new DB();
       
		$arr['articletitle'] = $_POST['articletitle'];
		$arr['title'] = $_POST['title'];
		$arr['articlecolumn'] = $_POST['articlecolumn'];
		$arr['articletype'] = $_POST['articletype'];
		$arr['articlesort'] = $_POST['articlesort'];
		$arr['keywords'] = $_POST['keywords'];
		$arr['abstract'] = $_POST['abstract'];
		$arr['author'] = $_POST['author'];
		$arr['sources'] = $_POST['sources'];
		$arr['allowcomments'] = $_POST['allowcomments'];
		$arr['commentdatemin'] = $_POST['commentdatemin'];
		$arr['commentdatemax'] = $_POST['commentdatemax'];
        $arr['time'] = time();
		$data = $db->add('article',$arr);
		if ($data) {
			echo "<script>alert('提交资讯成功');location.href='index.php?c=Article&a=article_list';</script>";
		} else {
			echo "<script>alert('提交资讯失败');location.herf='';</script>";
		}
	}
}