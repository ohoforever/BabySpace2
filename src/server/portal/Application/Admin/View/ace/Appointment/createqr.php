<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->
	<form id="form" action="{:U('save')}" method="post" class="form-horizontal">
		<div class="form-group center">
		<img src="{:U('createQRfile')}" id="img" />
		</div>

		<div class="clearfix form-actions">
			<input type="hidden" name="id" value="{$data.id}"/>
            <div class="col-xs-12 center">
	    <button class="btn btn-info confirm" id="create">
                                    <i class="icon-refresh"></i>重新生成
                                </button>
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
	               <i class="icon-reply"></i>返回上一页
	            </a>  
            </div>
        </div>
	</form>
</block>

<block name="script">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" charset="utf-8">
	Think.setValue('type',{$type|default=1});
    //导航高亮
</script>
    <script src="__ACE__/js/date-time/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
            $(function(){
                    $('input.day-input').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                        $(this).prev().focus();
                    });
$("#create").click(function (){
$("#img").attr('src','<?php echo U("appointment/createQRfile?redo=true")?>');
return false;
});
                });
        </script>
</block>
<block name="style">
<link rel="stylesheet" href="__ACE__/css/datepicker.css" />
</block>
