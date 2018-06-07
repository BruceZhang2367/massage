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
<span class="action-span"><a href="/six/index.php/Admin/Goodstype/goods_type_list">商品类型列表</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 新建商品类型 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
  <form action="" method="post" name="theForm" onsubmit="return validate();">
    <table cellspacing="1" cellpadding="3" width="100%">
      <tbody><tr>
        <td class="label">商品类型名称:</td>
        <td><input type="text" name="type_name" value="" size="40">
        <span class="require-field">*</span></td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <input type="hidden" name="cat_id" value="">
          <input type="submit" value=" 确定 " class="button">
          <input type="reset" value=" 重置 " class="button">
          <input type="hidden" name="act" value="insert">
        </td>
      </tr>
    </tbody></table>
  </form>
</div>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>