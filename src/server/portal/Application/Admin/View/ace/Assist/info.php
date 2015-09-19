<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->

<?php $sex = ['MALE###'=>'男宝宝','FEMALE#'=>'女宝宝','UNKNOWN'=>'不详'];?>
	<form id="form" action="{:U('allocatesave')}" method="post" class="form-horizontal">
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">家长名称</label>
                <label class=" col-xs-12 col-sm-5 blue no-padding-right"><strong>{$item.parent_name}</strong></label>
                </div>
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">家长电话</label>
                <label class=" col-xs-12 col-sm-5 blue no-padding-right"><strong>{$item.mobile_num}</strong></label>
                </div>
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">宝宝姓名</label>
                <label class=" col-xs-12 col-sm-5 blue no-padding-right"><strong>{$item.baby_name}</strong></label>
                </div>
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">宝宝性别</label>
                <label class=" col-xs-12 col-sm-5 blue no-padding-right"><strong><?php echo $sex[$item['baby_sex']]?></strong></label>
                </div>
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">宝宝生日</label>
                <label class=" col-xs-12 col-sm-5 blue no-padding-right"><strong>{$item.baby_birthday}</strong></label>
                </div>
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">家庭所在城市</label>
                <label class=" col-xs-12 col-sm-5 blue no-padding-right"><strong>{$item.city}</strong></label>
                </div>
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">家庭所在城市区域</label>
                <label class=" col-xs-12 col-sm-5 blue no-padding-right"><strong>{$item.district}</strong></label>
                </div>
		<div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">候选人星数</label>
			<div class="col-xs-12 col-sm-5">
				<select name="current_assistant_id">
				<?php for ($i=0;$i<=5;$i++){?>
				<option value="<?php echo $v['id']?>" <?php echo $item['current_assistant_id']==$v['id']?'selected':''?> ><?php echo $v['username']?></option>
				<?php }?>
				</select>
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
