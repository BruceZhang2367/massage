<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<center>
		<div><input type="text" name="find" value="">
         <a href="<?php echo U('Find/find_do');?>"><button id="find">搜索</button></a>
         <input type="text" name="find_t" value="">
         <a href=""><button id="find">搜索</button></a>
		</div>
		<table border="1">
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品网址</th>
			<th>商品简介</th>
			<?php if(is_array($res)): foreach($res as $key=>$v): ?><tr>
					<td><?php echo ($v["brand_id"]); ?></td>
					<td><?php echo ($v["brand_name"]); ?></td>
					<td><?php echo ($v["site_url"]); ?></td>
					<td><?php echo ($v["brand_desc"]); ?></td>
				</tr><?php endforeach; endif; ?>
		</table>
		</center>
	
</body>