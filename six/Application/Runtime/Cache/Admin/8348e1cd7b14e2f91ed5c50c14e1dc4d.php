<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="/six/Public/admin/" />
<title>SHOP 管理中心 - 商品库存添加 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="javascript:void(0)">库存管理</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品库存添加 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
    <form method="post" action="" name="addForm" id="addForm">
<div class="list-div" id="listDiv">
  <table width="100%" cellpadding="3" cellspacing="1" id="table_list">
    <tbody><tr>
      <th colspan="20" scope="col">商品名称：iphone7&nbsp;&nbsp;&nbsp;&nbsp;货号：ECS000080</th>
    </tr>
    <tr>
      <!-- start for specifications -->
      <?php if(is_array($data)): foreach($data as $key=>$val): ?><td scope="col" style="background-color: rgb(255, 255, 255);">
       <div align="center">
       <strong>
        <?php echo ($val["attr_name"]); ?>
       </strong>
       </div></td><?php endforeach; endif; ?>
    <!-- end for specifications -->
      <td class="label_2" style="background-color: rgb(255, 255, 255);">货号</td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);">库存</td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);">&nbsp;</td>
    </tr>  
    <tr id="attr_row">
    <!-- start for specifications_value -->
      <?php if(is_array($data)): foreach($data as $key=>$val): ?><td align="center" style="background-color: rgb(255, 255, 255);">
            <select name="attr_values[<?php echo ($key); ?>][]">
             <option value="" selected="">请选择...</option>
              <?php if(is_array($val["values"])): foreach($val["values"] as $key=>$v): ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
            </select>
        </td><?php endforeach; endif; ?>
    <!-- end for specifications_value -->

      <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
      <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
      <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button jia" value=" + " ></td>
    </tr>

    <tr>
      <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="button" value=" 保存 ">
      </td>
    </tr>
  </tbody>
  </div>
  </table>
</form>
</div>
<script src="/six/Public/jquery-2.1.4.min.js"></script>
<script language=javascript>
    $(function(){
        $(document).on('click','.jia',function(){
            var curl = $(this).parent().parent().clone();
            $(this).parent().parent().after(curl);
            var length = $(this).parent().parent().index();
            $('tr').eq(length+1).find('input[type=button]').val(' - ');
            $('tr').eq(length+1).find('input[type=button]').attr('class','button jian');
        //alert(aa);
        });
        $(document).on('click','.jian',function(){
            $(this).parent().parent().remove();
        });
    });
</script>
</body>
</html>