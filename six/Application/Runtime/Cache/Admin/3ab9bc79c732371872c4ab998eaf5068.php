<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="/month6/1031/Public/admin/" />
<title>myshop管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<frameset rows="51,*" framespacing="0" border="0">
  <frame src="<?php echo U('index/top');?>" id="header-frame" name="header-frame" frameborder="no" scrolling="no">
  <frameset cols="180, 10, *" framespacing="0" border="0" id="frame-body">
    <frame src="<?php echo U('index/menu');?>" id="menu-frame" name="menu-frame" frameborder="no" scrolling="yes">
    <frame src="<?php echo U('index/drag');?>" id="drag-frame" name="drag-frame" frameborder="no" scrolling="no">
    <frame src="<?php echo U('index/main');?>" id="main-frame" name="main-frame" frameborder="no" scrolling="yes">
  </frameset>
</frameset>
  <frameset rows="0, 0" framespacing="0" border="0">
  <frame src="http://api.ecshop.com/record.php?mod=login&url=<?php echo ($shop_url); ?>" id="hidd-frame" name="hidd-frame" frameborder="no" scrolling="no">
  </frameset>
</head>
</html>