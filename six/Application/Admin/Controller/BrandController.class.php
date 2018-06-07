<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends Controller {
	public function brandList()
	{
		$brand_name=I("brand_name","");
		$where=array();
		$where['brand_name']=array("like","%$brand_name%");
		$User = M('brand'); // 实例化User对象
		// 查询满足要求的总记录数			%".$brand_name."%
		$count      = $User->where($where)->count();	
		$Page       = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('next','下一页');
		$Page->setConfig('prev','上一页');
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		// $brand=D("brand")->select();
		if(IS_AJAX)
		{
			$data=array(
					"show"=>$show,
					"brand"=>$list
				);
			$this->ajaxReturn($data);
		}else{
			$this->assign("show",$show);
			$this->assign("brand",$list);
			$this->display("admin/brand_list");
		}
		
	}
	//既点即改
	public function changeShow()
	{
		$brand_id=I("brand_id");
		$is_show=I("is_show");
		if($is_show==1){
			$is_show=0;
		}else{
			$is_show=1;
		}
		$res=M("brand")->where("brand_id='$brand_id'")->save(array("is_show"=>$is_show));
		if($res){
			$data=array(
					"state"=>1,
					"msg"=>"修改成功"
				);
		}else{
			$data=array(
					"state"=>0,
					"msg"=>"修改失败"
				);
		}
		$this->ajaxReturn($data);
	}
	//文本框既点即改
	public function changeOrder()
	{
		$newOrder=I("newOrder");
		$brand_id=I("brand_id");
		$res=M("brand")->where("brand_id='$brand_id'")->save(array("sort_order"=>$newOrder));
		if($res){
			$data=array(
					"state"=>1,
					"msg"=>"修改成功"
				);
		}else{
			$data=array(
					"state"=>0,
					"msg"=>"修改失败"
				);
		}
		$this->ajaxReturn($data);
	}
	public function brandAdd()
	{
		$this->display("admin/brand_add");
	}
	public function brandAdd_do()
	{
		$data=I("post.");
		$upload = new \Think\Upload();// 实例化上传类    
		$upload->maxSize   =     3145728 ;// 设置附件上传大小    
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
		// 设置附件上传类型    
		$upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录
		$upload->rootPath  =      './';    
		// 上传单个文件     
		$info   =   $upload->uploadOne($_FILES['brand_logo']);    
		if(!$info) {
			// 上传错误提示错误信息        
			$this->error($upload->getError());    
		}else{
			// 上传成功 获取上传文件信息 
			$data['brand_logo']=$info['savepath'].$info['savename'];       
			$res=D("brand")->add($data);
			if($res)
			{
				$this->success("添加成功");
			}else{
				$this->error("添加失败");
			}
		}
	}
	//商品删除
	public function brandDel()
	{
		$brand_id=I("get.brand_id");
		if(D("brand")->where("brand_id='$brand_id'")->delete())
		{
			$this->success("删除成功");
		}else{
			$this->error("删除失败");
		}
	}
	//商品修改
	public function brandUpdate()
	{
		$brand_id=I("get.brand_id");
		$brand=D("brand")->where("brand_id='$brand_id'")->find();
		$this->assign("brand",$brand);
		$this->assign("brand_id",$brand_id);
		$this->display("admin/brand_save");
	}
	public function brandSave()
	{
		$brand_id=I("post.brand_id");
		$data=I("post.");
		$upload = new \Think\Upload();// 实例化上传类    
		$upload->maxSize   =     3145728 ;// 设置附件上传大小    
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
		// 设置附件上传类型    
		$upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录
		$upload->rootPath  =      './';    
		// 上传单个文件     
		$info   =   $upload->uploadOne($_FILES['brand_logo']);    
		if(!$info) {
			// 上传错误提示错误信息        
			$this->error($upload->getError());    
		}else{
			// 上传成功 获取上传文件信息 
			$data['brand_logo']=$info['savepath'].$info['savename'];       
			$res=D("brand")->where("brand_id='$brand_id'")->save($data);
			if($res)
			{
				$this->success("修改成功");
			}else{
				$this->error("修改失败");
			}
		}
	}
}
?>