<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="/six/Public/admin/" />
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
  color: white;
}
</style>

</head>
<body style="background: #278296">
  <table cellspacing="0" cellpadding="0" style="margin-top: 100px" align="center">
  <tr>
    <td><img src="images/login.png" width="178" height="256" border="0" alt="ECSHOP" /></td>
    <td style="padding-left: 50px">
      <table>
      <tr>
        <td>管理员姓名：</td>
        <td><input type="text" id="username" value="<?php echo (cookie('username')); ?>" /></td>
      </tr>
      <tr>
        <td>管理员密码：</td>
        <td><input type="password" id="password" value="<?php echo (cookie('password')); ?>"/></td>
      </tr>
      <tr>
        <td>验证码：</td>
        <td><input type="text" id="captcha" class="capital" /></td>
      </tr>
      <tr>
      <td colspan="2" align="right"><img src="/six/index.php/Admin/Admin/code" width="145" height="25" alt="CAPTCHA" border="1" onclick= this.src="/six/index.php/Admin/Admin/code/id/"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。" id="code" />
      </td>
      </tr>
      <tr><td colspan="2"><input type="checkbox" value="1" name="remember" id="remember" /><label for="remember">请保存我这次的登录信息</label></td></tr>
      <tr><td>&nbsp;</td><td><input type="submit" value="进入管理中心" class="button" /></td></tr>
      <tr>
        <td colspan="2" align="right">&raquo; <a href="../" style="color:white">返回首页</a> &raquo; <a href="get_password.php?act=forget_pwd" style="color:white">你忘记了密码吗？</a></td>
      </tr>
      </table>
    </td>
  </tr>
  </table>
  <input type="hidden" name="act" value="signin" />
<script src="/six/Public/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
  $(document).on("click",".button",function(){
    var username=$("#username").val();
    var password=$("#password").val();
    var code=$("#captcha").val();
    var remember=$(":checked").val();
    //alert(remember)
    // alert(password)
    // alert(code)
    //return false;
    $.ajax({
      type:"post",
      url:"/six/index.php/Admin/Admin/login_do",
      data:{username:username,password:password,code:code,remember:remember},
      success:function(n){
        alert(n.msg);
        if(n.state!=1)
        {
          $("#code").attr("src","/six/index.php/Admin/Admin/code");
        }else{
          location.href="/six/index.php/Admin/Index/index";
        }
      }
    })
  })
</script>
</body>