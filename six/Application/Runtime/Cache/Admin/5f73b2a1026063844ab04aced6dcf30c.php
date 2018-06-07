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
<span class="action-span"><a href="attribute.php?act=list">商品属性</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加属性 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
  <form action="" method="post" name="theForm" onsubmit="return validate();">
  <table width="100%" id="general-table">
      <tbody><tr>
        <td class="label">属性名称：</td>
        <td>
          <input type="text" name="attr_name" value="" size="30">
          <span class="require-field">*</span>        </td>
      </tr>
      <tr>
        <td class="label">所属商品类型：</td>
        <td>
          <select name="type_id" onchange="onChangeGoodsType(this.value)">
          <option value="0">请选择...</option>
          <?php if(is_array($data)): foreach($data as $key=>$v): ?><option value="<?php echo ($v["goods_type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
          </select> <span class="require-field">*</span>        
        </td>
      </tr>
      <tr id="attrGroups" style="display: none;">
        <td class="label">属性分组：</td>
        <td>
          <select name="attr_group">
                    </select>
        </td>
      </tr>
      
      <tr>
        <td class="label"><a href="javascript:showNotice('noticeAttrType');" title="点击此处查看提示信息"><img src="images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a>属性是否可选</td>
        <td>
          <input type="radio" name="attr_type" value="1" checked="true"> 参数          
          <input type="radio" name="attr_type" value="2"> 规格
          <br>
        </td>
      </tr>
      <tr>
        <td class="label">该属性值的录入方式：</td>
        <td>
          <input type="radio" name="attr_input_type" value="1" checked="true" onclick="radioClicked(1)">手工录入          
          <input type="radio" name="attr_input_type" value="2" onclick="radioClicked(2)">
          从下面的列表中选择（一行代表一个可选值）          
        </td>
      </tr>
      <tr>
        <td class="label">可选值列表：</td>
        <td>
          <textarea name="attr_values" cols="30" rows="5" disabled></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        <div class="button-div">
          <input type="submit" value=" 确定 " class="button">
          <input type="reset" value=" 重置 " class="button">
        </div>
        </td>
      </tr>
      </tbody></table>
    <input type="hidden" name="act" value="insert">
    <input type="hidden" name="attr_id" value="0">
  </form>
</div>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>
<script src="/six/Public/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
  function radioClicked(i)
  {
    if(i==1){
      $("[name='attr_values']").attr("disabled",true);
    }else{
      $("[name='attr_values']").removeAttr("disabled");
    }
  }
</script>
</body>
</html>