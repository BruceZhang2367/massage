<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="/six/Public/admin/" />
<title>SHOP 管理中心 - 商品分类 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<style type="text/css">
  img{
    cursor: pointer;
  }
</style>
<h1>
<span class="action-span"><a href="<?php echo U('Category/CategoryAdd');?>">添加分类</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品分类 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>
					<th>分类名称</th>
					<th>操作</th>
				</tr>
        <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr align="center" class="0" id="0_1">
  					<td align="left" class="first-cell">
  						<img src="images/menu_minus.gif" width="9" height="9" border="0" style="margin-left:0em" class="searchChild" cat_id=<?php echo ($v["cat_id"]); ?> controller_name="<?php echo ($v["controller_name"]); ?>">
  						<span><a href="goods.php?act=list&amp;cat_id=1"><?php echo ($v["cat_name"]); ?></a></span>
  					 </td>
  					<td width="24%" align="center">
  						<a href="category.php?act=move&amp;cat_id=1">转移商品</a> |
  						<a href="category.php?act=edit&amp;cat_id=1">编辑</a> |
  						<a href="javascript:;" onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">移除</a>
  					</td>
  				</tr><?php endforeach; endif; ?>
	    </tbody>
    </table>
  </div>
</form>
</div>
<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
<script src="/six/Public/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
  $(document).on("click",".searchChild",function(){
    var cat_id=$(this).attr("cat_id");
    var _this=$(this);
    $.ajax({
      url:"/six/index.php/Admin/Category/searchChild",
      data:{cat_id:cat_id},
      success:function(data){
        
        $.each(data,function(k,obj){
          var tr=$("<tr></tr>");
          //tr="&nbsp;&nbsp;"+tr;
          tr.append('<td align="left" class="first-cell">&nbsp;&nbsp;<img src="images/menu_minus.gif" width="9" height="9" border="0" style="margin-left:0em" class="'+obj.controller_name+'" cat_id='+obj.cat_id+'><span><a href="goods.php?act=list&amp;cat_id=1">'+obj.cat_name+'</a></span></td>');
          tr.append('<td width="24%" align="center">&nbsp;&nbsp;<a href="category.php?act=move&amp;cat_id=1">转移商品</a> | <a href="category.php?act=edit&amp;cat_id=1">编辑</a> | <a href="javascript:;" title="移除">移除</a></td>');
          _this.parent().parent().after(tr);
        })
      }
    })
  })
</script>
</html>