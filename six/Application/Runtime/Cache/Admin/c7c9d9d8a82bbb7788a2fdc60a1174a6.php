<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="/six/Public/admin/" />
<title>SHOP 管理中心 - 品牌管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
<span class="action-span"><a href="/six/index.php/Admin/Brand/brandAdd">添加品牌</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品品牌 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
    <input type="text" name="brand_name" id="brand_name" size="15">
  <input type="button" value=" 搜索 " class="button">
</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>排序</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
    </tbody>
    <tbody id="body">
    <?php if(is_array($brand)): foreach($brand as $key=>$v): ?><tr>
			<td class="first-cell"><span style="float:right"><a href="../data/brandlogo/1240803062307572427.gif" target="_brank"><img src="/six/<?php echo ($v["brand_logo"]); ?>" width="16" height="16" border="0" alt="品牌LOGO"></a></span>
			<span title="点击修改内容" style=""><?php echo ($v["brand_name"]); ?></span>
			</td>
			<td><a href="http://www.nokia.com.cn/" target="_brank"><?php echo ($v["site_url"]); ?></a></td>
			<td align="left" ><?php echo ($v["brand_desc"]); ?></td>
			<td align="center">
        <span id="oldOrder" style="cursor: pointer;"><?php echo ($v["sort_order"]); ?></span>
        <input type="text" style="display:none" id="newOrder" brand_id="<?php echo ($v["brand_id"]); ?>"/>
      </td>
			<td align="center">
        <?php if($v["is_show"] == 1): ?><img src="images/yes.gif" class="changeShow" brand_id="<?php echo ($v["brand_id"]); ?>" is_show="1">
        <?php else: ?>
          <img src="images/no.gif" class="changeShow" brand_id="<?php echo ($v["brand_id"]); ?>" is_show="0"><?php endif; ?>
        </td>
			<td align="center">
				<a href="/six/index.php/Admin/Brand/brandUpdate?brand_id=<?php echo ($v["brand_id"]); ?>" title="编辑">编辑</a> |
				<a href="/six/index.php/Admin/Brand/brandDel?brand_id=<?php echo ($v["brand_id"]); ?>" title="编辑">移除</a> 
			</td>
		</tr><?php endforeach; endif; ?>
    <tr>
    </tbody>
		<td align="center" nowrap="true" colspan="6" id="page">
      <?php echo ($show); ?> 
       <!--      <div id="turn-page">
      			总计  <span id="totalRecords">11</span>
        个记录分为 <span id="totalPages">2</s}
pan>
        页当前第 <span id="pageCurrent">1</span>
        页，每页 <input type="text" size="3" id="pageSize" value="10" onkeypress="return listTable.changePageSize(event)">
        <span id="page-link">
          <a href="javascript:listTable.gotoPageFirst()">第一页</a>
          <a href="javascript:listTable.gotoPagePrev()">上一页</a>
          <a href="javascript:listTable.gotoPageNext()">下一页</a>
          <a href="javascript:listTable.gotoPageLast()">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value="1">1</option><option value="2">2</option>          </select>
        </span>
      </div> -->
      </td>
    </tr>
  </table>

<!-- end brand list -->
</div>
</form>


<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
<script src="/six/Public/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
  //既点即改
  $(document).on("click",".changeShow",function(){
    var brand_id=$(this).attr("brand_id");
    var is_show=$(this).attr("is_show");
    var _this=$(this);
    $.ajax({
      data:{brand_id:brand_id,is_show:is_show},
      url:"/six/index.php/Admin/Brand/changeShow",
      success:function(data){
        if(data.state==1){
          if(is_show==1){
            _this.attr("src","images/no.gif");
            _this.attr("is_show","0");
          }else{
            _this.attr("src","images/yes.gif");
            _this.attr("is_show","1");
          }
        }else{
          alert(data.msg)
        }
      }
    })
  })
  //文本框的既点即改
  //给文本框赋值
  $(document).on("click","#oldOrder",function(){
    var oldOrder=$(this).html();
    $(this).next().show();
    $(this).next().focus();
    $(this).next().val(oldOrder);
    $(this).hide();
  })
  //文本框失去焦点，触发ajax
  $(document).on("blur","#newOrder",function(){
    var oldOrder=$(this).prev().html();
    var newOrder=$(this).val();
    var _this=$(this);
    if(oldOrder==newOrder){
      alert("您没有修改数据");
      _this.prev().show();
      _this.prev().html(oldOrder);
      _this.hide();
      return false;
    }
    var brand_id=$(this).attr("brand_id");
    
    $.ajax({
      url:"/six/index.php/Admin/Brand/changeOrder",
      data:{newOrder:newOrder,brand_id:brand_id},
      success:function(data){
        if(data.state==1){
          _this.prev().show();
          _this.prev().html(newOrder);
          _this.hide();
        }else{
          alert(data.msg)
          _this.prev().show();
          _this.hide();
        }
      }
    })
  })
  //分页
  $(document).on("click","#page a",function(i){
    i.preventDefault();
    var url=$(this).attr("href");
    // alert(url);
    page(url);
  })
  //搜索
  $(document).on("click",".button",function(){
    var brand_name=$("#brand_name").val();
    //alert(brand_name)
    var url='<?php echo U("Brand/brandList");?>';
    page(url,brand_name);
  })
  //分页和搜索的公共方法
  function page(url,brand_name)
  {
    //alert(url);return false;
    $.ajax({
      data:{brand_name:brand_name},
      url:url,
      dataType:"json",
      success:function(data){
        $("#body").empty();
        
        $.each(data.brand,function(i,obj){
          var tr=$("<tr></tr>");
          tr.append("<td>"+obj.brand_name+"</td>");
          tr.append("<td>"+obj.site_url+"</td>");
          tr.append("<td align='left' >"+obj.brand_desc+"</td>");
          tr.append("<td align='center'>"+obj.sort_order+"</td>");
          if(obj.is_show==1)
          {
            tr.append('<td align="center"><img src="images/yes.gif"></td>');
          }else{
            tr.append('<td align="center"><img src="images/no.gif"></td>');
          }
          // tr.append("<td>"+obj.brand_name+"</td>");
          tr.append('<td align="center"><a href="/six/index.php/Admin/Brand/brandUpdate?brand_id='+obj.brand_id+'" title="编辑">编辑</a> | <a href="/six/index.php/Admin/Brand/brandDel?brand_id='+obj.brand_id+'" title="编辑">移除</a></td>');
          $("#body").append(tr);
        })
        $("#page").html(data.show);
      }
    })
  }
</script>
</html>