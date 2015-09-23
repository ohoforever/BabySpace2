<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->

<?php $sex = ['MALE###'=>'男宝宝','FEMALE#'=>'女宝宝','UNKNOWN'=>'不详'];?>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">宝宝资料</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">家长名称:</span>{$baby.user_name}</td>
			<td><span style="color:#999;padding-right:8px;">家长电话:</span>{$baby.mobile_num}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">宝宝名称:</span>{$baby.baby_name}</td>
			<td><span style="color:#999;padding-right:8px;">宝宝性别:</span><?php echo $sex[$baby['baby_sex']];?></td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">宝宝生日:</span>{$baby.baby_birthday}</td>
			<td></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>

<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">宝宝动态</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">标题:</span>{$item.title}</td>
			<td><span style="color:#999;padding-right:8px;">关键词:</span>{$item.tag}</td>
		</tr>
		<tr>
			<td colspan="2" ><span style="color:#999;padding-right:8px;">活动时间:</span>{$item.act_time}</td>
		</tr>
		<tr>
			<td colspan="2" ><span style="color:#999;padding-right:8px;">内容:</span>{$item.content}</td>
		</tr>
		<tr>
			<td colspan="2" ><span style="color:#999;padding-right:8px;">活动图片:</span><div style="margin-left:5em;">
<?php 
for($i=1;$i<10;$i++){
if(!empty($item['image'.$i]))
{
echo '<img src="'.$item['image'.$i].'" style="width:80%;margin-bottom:0.3em;"/>';
}
}

?>
			</div></td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">红花数:</span>{$item.redflower_count}</td>
			<td><span style="color:#999;padding-right:8px;">录入人:</span>{$item.operator}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">发布时间:</span>{$item.insert_time}</td>
			<td><span style="color:#999;padding-right:8px;">更新时间:</span>{$item.update_time}</td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">分享标题:</span>{$item.share_title}</td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">分享内容:</span>{$item.share_content}</td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">分享图片:</span>
			<div style="margin-left:5em;" ><img src="<?php echo $item['image'.$item['share_img_index']];?>" style="width:80%" /></div>
			</td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
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
