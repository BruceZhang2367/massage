//菜单加载
$(function(){	
    var cubuk_seviye = $(document).scrollTop();
    var header_yuksekligi = $('.header-web').outerHeight();

    $(window).scroll(function() {
        var kaydirma_cubugu = $(document).scrollTop();

        if (kaydirma_cubugu > header_yuksekligi){$('.header-web').addClass('gizle');} 
        else {$('.header-web').removeClass('gizle');}

        if (kaydirma_cubugu > cubuk_seviye){$('.header-web').removeClass('sabit');} 
        else {$('.header-web').addClass('sabit');}				

        cubuk_seviye = $(document).scrollTop();	
     });
});

//分页加载
 jQuery(document).ready(function($) {
        var loading=false
        $('div#post-read-more a').click( function() {
            if(loading)return
            loading=true
            $this = $(this);
            $this.addClass('loading'); //给a标签加载一个loading的class属性，可以用来添加一些加载效果
            var href = $this.attr("href"); //获取下一页的链接地址
            if (href != undefined) { //如果地址存在
                $.ajax( { //发起ajax请求
                    url: href, //请求的地址就是下一页的链接
                    type: "get", //请求类型是get
                    error: function(request) {
                        loading=false
                    },
                    success: function(data) { //请求成功
                        loading=false
                        $this.removeClass('loading'); //移除loading属性
                        var $res = $(data).find(".list"); //从数据中挑出文章数据，请根据实际情况更改
                        $('.box').append($res); //将数据加载加进posts-loop的标签中。
                        var newhref = $(data).find("#post-read-more a").attr("href"); //找出新的下一页链接
                        if( newhref != undefined ){
                            $("#post-read-more a").attr("href",newhref);
							
                        }else{
							$("#post-read-more a").html("没有了").removeAttr("href");
							
                        }
                    }
        });   
    }   
    return false;   
});   
  
});  
 