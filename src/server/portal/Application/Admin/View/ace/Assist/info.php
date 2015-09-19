<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->
<?php $sex = ['MALE###'=>'男宝宝','FEMALE#'=>'女宝宝','UNKNOWN'=>'不详'];?>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header header-color-blue">
          <h5 class="bigger lighter"> 客户信息</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table table-striped table-bordered table-hover" style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td>家长名称:{$item.parent_name}</td>
			<td>家长电话:{$item.mobile_num}</td>
		</tr>
		<tr>
			<td>宝宝名称:{$item.baby_name}</td>
			<td>宝宝性别:<?php echo $sex[$item['baby_sex']];?></td>
		</tr>
		<tr>
			<td>家庭所在城市:{$item.city}</td>
			<td>家庭所在城市区域:{$item.district}</td>
		</tr>
		<tr>
			<td>宝宝生日:{$item.baby_birthday}</td>
			<td></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<?php foreach($list as $v){?>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header header-color-blue">
          <h5 class="bigger lighter">标注人:<?php echo $v['assistant_id'];?></h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table table-striped table-bordered table-hover" style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td>用户级别:<?php echo $v['level']?></td>
			<td>候选人星数:<?php echo $v['star']?></td>
		</tr>
		<tr>
			<td colspan="2">内容:<?php echo $v['evaluation']?></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<?php }?>

	<form id="form" action="{:U('allocatesave')}" method="post" class="form-horizontal">
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header header-color-blue">
          <h5 class="bigger lighter"> 添加评级</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table table-striped table-bordered table-hover" style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span>评级:</span>
				<select name="current_assistant_id">
				<option value="A" >A级</option>
				<option value="B" >B级</option>
				<option value="C" >C级</option>
				</select>
			</td>
			<td><span>候选人星数:</span>
				<select name="current_assistant_id">
				<?php for ($i=1;$i<=5;$i++){?>
				<option value="<?php echo $i?>" ><?php echo $i?></option>
				<?php }?>
				</select>&nbsp;<span>星</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">内容:
			<textarea name="evaluation" rows="10" cols="15" style="width:100%;">
			</textarea>
			</td>
		</tr>
	 </tbody>
	</table>
</div>
</div>

		<div class="clearfix form-actions">
			<input type="hidden" name="id" value="{$item.id}"/>
            <div class="col-xs-12 center">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
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
    highlight_subnav('{:U('custommanage/allocate')}');
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
