<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->
<?php foreach($_list as $item){?>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter"><?php echo $item['sender_type']=='USER'?'评论人:'.$users[$item['sender_id']]:$tech[$item['sender_id']].'老师回复 '.$users[$item['reply_to']];?></h5>        
	  <div class="widget-toolbar  no-border">
<?php if($item['sender_type']=='USER'){?>
	  <a  href="<?php echo  U('space/commentreply?id='.$item['id'].'&mid='.$item['mature_id']);?>" ><i class="icon-reply"></i></a>
<?php }?>
	  <a  href="<?php echo U('space/commentdel?id='.$item['id'].'&mid='.$item['mature_id'])?>" class="ajax-get confirm"><i class="icon-remove"></i></a>
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
<?php } ?>
<?php 
if(empty($_list)){
?>
<div class="center">暂无评论</div>
<?php } ?>
            <div class="col-xs-12 center" style="margin-top:1em;">
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
	               <i class="icon-reply"></i>返回上一页
	            </a>  
            </div>
        </div>
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
