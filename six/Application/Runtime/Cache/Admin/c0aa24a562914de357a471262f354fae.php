<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="/six/Public/admin/" />
<title>SHOP 管理中心 - 属性管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Attribute/attribute_add');?>">添加属性</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品属性 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
    按商品类型显示：
    <select name="goods_type">
      <option value="0">所有商品类型</option>
      <?php if(is_array($arr)): foreach($arr as $key=>$v): ?><optionvalue="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
    </select>
  </form>
</div>

<form method="post" action="attribute.php?act=batch" name="listForm">
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    
		<tr>
			<th><input class="check" type="checkbox">编号 </th>
			<th>属性名称</th>
			<th>商品类型</th>
			<th>属性值的录入方式</th>
			<th>可选值列表</th>
			<th>操作</th>
		</tr> 
    <tbody id="body">
      <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
    			<td nowrap="true" valign="top">
            <span><input value="<?php echo ($v["attr_id"]); ?>" class="checkboxes" type="checkbox"><?php echo ($v["attr_id"]); ?></span>
          </td>
    			<td class="first-cell" nowrap="true" valign="top"><span><?php echo ($v["attr_name"]); ?></span></td>
    			<td nowrap="true"  valign="top"><span><?php echo ($v["type_name"]); ?></span></td>
    			<td nowrap="true" valign="top">
            <?php if($v["attr_input_type"] == 1): ?>手工录入 
            <?php else: ?>
              列表中选择<?php endif; ?>   
          </td>
    			<td valign="top"><span><?php echo ($v["attr_values"]); ?></span></td>
    			<td align="center" nowrap="true" valign="top">
    				<a href="?act=edit&amp;attr_id=1" title="编辑"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a>
    				<a href="javascript:;" onclick="removeRow(1)" title="移除"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
    			</td>
    		</tr><?php endforeach; endif; ?>
    </tbody>
    </table>

  <table cellpadding="4" cellspacing="0">
    <tbody>
      <tr>
        <td style="background-color: rgb(255, 255, 255);"><input type="submit" id="btnSubmit" value="删除" class="button" disabled="true"></td>
        <td align="right" style="background-color: rgb(255, 255, 255);">      <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
              <div id="turn-page">
          总计  <span id="totalRecords">12</span>
          个记录分为 <span id="totalPages">2</span>
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
        </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</form>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
<script src="/six/Public/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
  //ajax展示所选分类下的属性
  $(document).on("change","[name='goods_type']",function(){
    var goods_type_id=$(this).val();
    $.ajax({
      data:{goods_type_id:goods_type_id},
      url:"/six/index.php/Admin/Attribute/getAttr",
      success:function(data){
        $("#body").empty();
        $.each(data,function(k,obj){
          var tr=$("<tr></tr>");
          tr.append('<td nowrap="true" valign="top"><span><input value="'+obj.attr_id+'" class="checkboxes" type="checkbox">'+obj.attr_id+'</span></td>');
          tr.append('<td class="first-cell" nowrap="true" valign="top"><span>'+obj.attr_name+'</span></td>');
          tr.append('<td nowrap="true"  valign="top"><span>'+obj.type_name+'</span></td>');
          if(obj.attr_input_type==1){
            tr.append('<td nowrap="true" valign="top">手工录入</td>');
          }else{
            tr.append('<td nowrap="true" valign="top">列表中选择</td>');
          }
          
          tr.append('<td valign="top"><span>'+obj.attr_values+'</span></td>');
          tr.append('<td align="center" nowrap="true" valign="top"><a href="" title="编辑"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a><a href="javascript:;" title="移除"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a></td>');
          $("#body").append(tr);
        })
      }
    })
  })
  //批量删除
  $(document).on("click",".check",function(){
    
    $(".checkboxes").attr("checked",true);
    $(this).attr("class","checkout");
  })
  $(document).on("click",".checkout",function(){
    $(".checkboxes").attr("checked",false);
    $(this).attr("class","check");
  })
</script>
</html>