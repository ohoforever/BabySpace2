function show_error(msg,title){
    show_box(msg,title,'#45b0e6');
}
function show_success(msg,title){
    show_box(msg,title,'#90ee7e');
}
function show_box(msg,title,color){
    $("#alert-content").html(msg);
    $("#close-alert-btn").text(title || '确认').css('background',color);;
    $(".error-body").css('border-color',color);
    $("#error-box").fadeIn();
}

function goback(){
    if(document.referrer == ''){
        window.location = '/';
    }else{
        history.back();
    }
}
$(function() {
    $(".ajax-form").submit(function(){

        //$this.prop("disabled", true);
        //$this.addClass('disabled');
        $.post(this.action,$(this).serializeArray(),function(resp){
            if(resp.status == '0'){
                if(resp.url != ''){
                    window.location = resp.url;
                }else{
                    show_success(resp.msg);
                }
            }
            else{
                show_error(resp.msg);
            }
        },'json');

        return false;
    });

	//验证码
	$(".getcode").click(function() {
        var mobile = $.trim($("#mobile").val());
        if(mobile == ''){
            show_error('请输入手机号码！');
            return false;
        }

        if(!/^(1[0-9])\d{9}$/i.test(mobile))
        {
            show_error('手机号码不合法！');
            return false;
        }

        var $this = $(this);

        $this.prop("disabled", true);
        $this.addClass('disabled');
        $.post($this.attr('url') || '/public/sendSmsCode.html',{mobile:mobile}, function (resp) {
            if(resp.status == '0'){
                show_success(resp.msg);
                time($this);
            }else{
                show_error(resp.msg);
                $this.prop("disabled", false);
                $this.removeClass('disabled');
            }
        },'json');
	});

    $("#close-alert-btn").click(function() {
        $(this).parents(".error-box").fadeOut();
    });

	//share click
	$(document).on("click", '[data-toggle="share-btn"]', function() {
		var html = '<div class="share">\
		<img src="/images/share.png" width="100%"/>\
		</div>'
		$(html).appendTo('.main,.scroll')
		$(".share").fadeIn();
	});

	//share
	$(".scroll,.main").on("click", ".share", function() {
		$(".share").fadeOut();
		$(".share").remove();
	})

	//zan
	$(document).on("click", ".zan", function() {
        var $this = $(this);
		var num = $this.find('.num').html();
        var item_id = $this.attr('item_id');
		if (!$(this).hasClass('on')) {
            $.post('/wonderfull/praise.html',{item_id:item_id}, function (resp) {
                if(resp.status == '0'){
                    $this.addClass('on');
                    $this.find('.num').html(Number(num) + 1)
                }
            },'json');
		}
	})
	
})
var wait = 30;
function time(o) {
	if (wait == 0) {
        o.prop("disabled",false).removeClass('disabled').text('获取校验码');
		wait = 30;
	} else {
        o.text("获取校验码"+wait)
		wait--;
		setTimeout(function() {time(o)},1000)
	}
}