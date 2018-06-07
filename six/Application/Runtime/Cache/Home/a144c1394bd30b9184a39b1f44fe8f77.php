<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <base href="/six/Public/six/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <link rel="stylesheet" href="./layui-v2.1.5/layui/css/layui.css">
    <link rel="stylesheet" href="./css/yhj.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">10月月考技能前台</div>


        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    单身程序员qq 1193466971
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">退了</a></li>
        </ul>
    </div>



    <div class="layui-body">
        <!-- 内容主体区域  -->
        <div style="padding: 15px;">
            <!-- <div class="stamp stamp03">
                <div class="par"><p>XXXXXX折扣店</p><sub class="sign">￥</sub><span>50.00</span><sub>优惠券</sub><p>订单满100.00元</p></div>
                <div class="copy">副券<p>2015-08-13<br>2016-08-13</p><a href="#">立即使用</a></div>
                <i></i>
                <div class="layui-progress">
                    <div class="layui-progress-bar" lay-percent="60%"></div>
                </div>
            </div> -->
            <?php if(is_array($coupon_data)): foreach($coupon_data as $key=>$v): ?><div class="stamp stamp04">
                    <div class="par"><p>XXXXXX折扣店</p><sub class="sign">￥</sub><span><?php echo ($v["coupon_price"]); ?>.00</span><sub>优惠券</sub><p>订单满<?php echo ($v["condition_name"]); ?>.00元</p></div>
                    <div class="copy">副券<p><?php echo date('Y-m-d',$v['start_time']);?><br><?php echo date("Y-m-d",$v['end_time']);?></p><a href="javascript:void(0)" coupon_id="<?php echo ($v["coupon_id"]); ?>" class="add">立即使用</a></div>
                    <!-- <i></i> -->
                    <div class="layui-progress">
                        <div class="layui-progress-bar" lay-percent="<?php echo ($v["coupon_count"]); ?>%"></div>
                    </div>
                </div><?php endforeach; endif; ?>
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © www.bwie.net - 八维研究学院十月月考机试
    </div>
</div>
<script src="./layui-v2.1.5/layui/layui.js"></script>
<script src="/six/Public/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(document).on("click",".add",function(){
        var coupon_id=$(this).attr("coupon_id");

        $.ajax({
            url:"/six/index.php/Home/Coupon/ajaxGet",
            data:{coupon_id:coupon_id},
            success:function(res){
                // alert(res)
                if(res.state==1){
                    alert(res.msg);
                    location.href=location.href;
                }else{
                    alert(res.msg);
                    location.href=location.href;
                }
            }
        })
    })
</script>
<script>
    //Demo
    layui.use('element','form', function(){
        var form = layui.form;
        var element = layui.element;
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });
</script>
</body>
</html>