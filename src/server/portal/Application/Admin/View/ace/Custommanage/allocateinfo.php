<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->

<?php
$sex = ['MALE###'=>'男宝宝','FEMALE#'=>'女宝宝','UNKNOWN'=>'不详'];
$status= ['CRT'=>'待开发','FLS'=>'开发失败','OK#'=>'开发完成'];
?>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header " style="color:#999;">
          <h5 class="bigger lighter"> 客户信息</h5>        
</div>

    <form id="form" action="{:U('allocatesave?id='.$item['id'])}" method="post" class="form-horizontal">
<div class="widget-body">
<div class=""> 
       <table class="table table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">家长名称:</span>{$item.parent_name}</td>
			<td><span style="color:#999;padding-right:8px;">家长电话:</span>{$item.mobile_num}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">宝宝名称:</span>{$item.baby_name}</td>
			<td><span style="color:#999;padding-right:8px;">宝宝性别:</span><?php echo $sex[$item['baby_sex']];?></td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">家庭所在城市:</span>{$item.city}</td>
			<td><span style="color:#999;padding-right:8px;">家庭所在城市区域:</span>{$item.district}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">宝宝生日:</span>{$item.baby_birthday}</td>
			<td><span style="color:#999;padding-right:8px;">星数:</span>{$item.star}星</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">状态:</span><?=$status[$item['status']];?></td>
			<td colspan="1"><span style="color:#999;padding-right:8px;">客户评级:</span>{$item.level}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">业务员:</span>
            <?php
            echo form_dropdown('current_assistant_id',[''=>'请选择']+$assi,[$item['current_assistant_id']],'class="chosen-select"');
            ?>
			</td>
<!--<td><span style="color:#999;padding-right:8px;">跟单人:</span><?=array_key_exists($item['current_assistant_id'],$assi) ? $assi[$item['current_assistant_id']] : ''?></td>
-->
		</tr>
	 </tbody>
	</table>
</div>
</div>
<?php foreach($list as $v){?>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
标注人:<?php echo $user[$v['assistant_id']]?>
</div>
<div class="widget-body">
<div class=""> 
       <table class="table table-striped table-bordered table-hover" style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">用户级别:</span><?php echo $v['level']?></td>
			<td><span style="color:#999;padding-right:8px;">星数:</span><?php echo $v['star']?></td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">内容:</span><?php echo $v['evaluation']?></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<?php }?>
            <div class="col-xs-12 center" style="margin-top:1em;">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button> 
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
	               <i class="icon-reply"></i>返回上一页
	            </a>  
            </div>
    </form>
        </div>
</block>

<block name="script">
<script type="text/javascript" charset="utf-8">
	Think.setValue('type',{$type|default=1});
    //导航高亮
    highlight_subnav('{:U('custommanage/allocate')}');
</script>
    <script src="__ACE__/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="__ACE__/js/chosen.jquery.min.js"></script>
    <script type="text/javascript">
            $(function(){
                $(".chosen-select").chosen();
                $('input.day-input').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                        $(this).prev().focus();
                    });
                });
        </script>
</block>
<block name="style">
<link rel="stylesheet" href="__ACE__/css/datepicker.css" />
<link rel="stylesheet" href="__ACE__/css/chosen.css" />
</block>
