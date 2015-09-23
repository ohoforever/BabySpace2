<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter"><?php echo $item['sender_type']=='USER'?'评论人:'.$users[$item['sender_id']]:'';?></h5>        
	  <div class="widget-toolbar  no-border">
	</div>
	  </div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">评论时间:</span><?php echo $item['insert_time']?></td>
		</tr>
		<tr>
			<td colspan="2" ><span style="color:#999;padding-right:8px;">内容:</span><?php echo $item['content'];?></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
	<form id="form" action="{:U('commentsave')}" method="post" class="form-horizontal">
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter"><?php echo '回复'.$users[$item['sender_id']];?></h5>        
	  <div class="widget-toolbar  no-border">
	</div>
	  </div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td colspan="2" ><textarea name="content" rowspan="10" colspan="15" style="width:100%;height:7em;"></textarea></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<input type="hidden" name="reply_to" value="<?php echo $item['sender_id']?>">
<input type="hidden" name="mature_id" value="<?php echo $item['mature_id']?>">

            <div class="col-xs-12 center" style="margin-top:1em;">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 回复
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
    highlight_subnav('{:U('space/index')}');
</script>
    <script src="__ACE__/js/date-time/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
            $(function(){
                    $('input.day-input').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                        $(this).prev().focus();
                    });
                });
        </script>
</block>
<block name="style">
<link rel="stylesheet" href="__ACE__/css/datepicker.css" />
</block>
