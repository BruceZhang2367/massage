<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="/six/Public/admin/" />
<title>SHOP 管理中心 - 类型管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="/six/index.php/Admin/Goodstype/goods_type_add">新建商品类型</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品类型 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start goods type list -->
<div class="list-div" id="listDiv">

	<table width="100%" cellpadding="3" cellspacing="1" id="listTable">
		<tbody>
			<tr>
				<th>商品类型名称</th>
				<th>属性分组</th>
				<th>属性数</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
      <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
				<td class="first-cell"><?php echo ($v["type_name"]); ?></td>
				<td></td>
				<td align="right"><?php echo ($v["count"]); ?></td>
				<td align="center"><img src="images/yes.gif"></td>
				<td align="center">
          <!-- <input type="hidden" name="goods_type_id" value="<?php echo ($v["goods_type_id"]); ?>" /> -->
				  <a href="/six/index.php/Admin/Attribute/attribute_list/goods_type_id/<?php echo ($v["goods_type_id"]); ?>" title="属性列表">属性列表</a> |
				  <a href="goods_type.php?act=edit&amp;cat_id=1" title="编辑">编辑</a> |
				  <a href="javascript:;" onclick="listTable.remove(1, '删除商品类型将会清除该类型下的所有属性。\n您确定要删除选定的商品类型吗？')" title="移除">移除</a>
				</td>
			</tr><?php endforeach; endif; ?>
      <tr>
      <td align="right" nowrap="true" colspan="6" style="background-color: rgb(255, 255, 255);">
            <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
            <div id="turn-page">
        总计  <span id="totalRecords">10</span>
        个记录分为 <span id="totalPages">1</span>
        页当前第 <span id="pageCurrent">1</span>
        页，每页 <input type="text" size="3" id="pageSize" value="10" onkeypress="return listTable.changePageSize(event)">
        <span id="page-link">
          <a href="javascript:listTable.gotoPageFirst()">第一页</a>
          <a href="javascript:listTable.gotoPagePrev()">上一页</a>
          <a href="javascript:listTable.gotoPageNext()">下一页</a>
          <a href="javascript:listTable.gotoPageLast()">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value="1">1</option>          </select>
        </span>
      </div>
      </td>
    </tr>
  </tbody></table>

</div>
<!-- end goods type list -->
</form>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>