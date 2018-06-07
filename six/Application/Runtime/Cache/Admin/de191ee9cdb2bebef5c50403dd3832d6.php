<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<table width="100%" id="attrTable">
	<tbody>	
		<?php if(is_array($arr)): foreach($arr as $key=>$val): if($val['attr_type']==1 && $val['attr_input_type']==1){ ?>	
		<tr>
			<td class="label"><?php echo ($val["attr_name"]); ?></td>
			<td>
				<input type="hidden" name="attr_id_list[]" value="<?php echo ($val["attr_id"]); ?>">
				<input name="attr_value_list[]" type="text" value="" size="40">  
				<input type="hidden" name="attr_price_list[]" value="">
			</td>
		</tr>
		<?php }elseif($val['attr_type']==1 && $val['attr_input_type']==2){ ?>
		<tr>
			<td class="label"><?php echo ($val["attr_name"]); ?></td>
			<td>
				<input type="hidden" name="attr_id_list[]" value="<?php echo ($val["attr_id"]); ?>">
				<select name="attr_value_list[]">
					<option value="">请选择...</option>
					<?php if(is_array($val['attr_values'])): foreach($val['attr_values'] as $key=>$v): ?><option value="<?php echo ($v); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
				</select>  
				<input type="hidden" name="attr_price_list[]" value="0">
			</td>
		</tr>
		<?php }elseif($val['attr_type']==2 && $val['attr_input_type']==1){ ?>
		<tr>
			<td class="label"><a href="javascript:;" class="addRow">[+]</a><?php echo ($val["attr_name"]); ?></td>
			<td>
				<input type="hidden" name="attr_id_list[]" value="<?php echo ($val["attr_id"]); ?>">
				<input name="attr_value_list[]" type="text" value="" size="40"> 
				属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">
			</td>
		</tr>
		<?php }elseif($val['attr_type']==2 && $val['attr_input_type']==2){ ?>
		<tr>
			<td class="label"><a href="javascript:;" class="addRow">[+]</a><?php echo ($val["attr_name"]); ?></td>
			<td>
				<input type="hidden" name="attr_id_list[]" value="<?php echo ($val["attr_id"]); ?>">
				<select name="attr_value_list[]">
					<option value="">请选择...</option>
					<?php if(is_array($val['attr_values'])): foreach($val['attr_values'] as $key=>$v): ?><option value="<?php echo ($v); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
				</select> 
				属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">
			</td>
		</tr>
		<?php } endforeach; endif; ?>
	</tbody>
</table>
</body>
</html>