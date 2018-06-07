<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <base href="/six/Public/six/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <link rel="stylesheet" href="./layui-v2.1.5/layui/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">10月月考技能</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">优惠卷添加</a></li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    贤心
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


            <form class="layui-form" action="" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">优惠卷名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="coupon_name" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">优惠卷张数</label>
                    <div class="layui-input-block">
                        <input type="text" name="coupon_number" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">优惠券金额</label>
                    <div class="layui-input-block">
                        <input type="text" name="coupon_price" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">优惠券对应的分类</label>
                    <div class="layui-input-block">
                        <select name="cat_id" lay-verify="required"> 
                            <option value="">请选择</option>
                            <?php if(is_array($cat_data)): foreach($cat_data as $key=>$v): ?><option value="<?php echo ($v["cat_id"]); ?>"><?php echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">优惠卷使用条件</label>
                    <div class="layui-input-block">
                        <?php if(is_array($condition)): foreach($condition as $key=>$v): ?><input type="checkbox" name="condition_id" value="<?php echo ($v["condition_id"]); ?>" title="满<?php echo ($v["condition_name"]); ?>可用"><?php endforeach; endif; ?>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <!-- <button class="layui-btn" lay-submit lay-filter="formDemo">立即添加</button> -->
                        <input type="submit" value="立即添加" class="layui-btn">
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © www.bwie.net - 八维研究学院十月月考机试
    </div>
</div>
<script src="./layui-v2.1.5/layui/layui.js"></script>
<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;

        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });
</script>
</body>
</html>