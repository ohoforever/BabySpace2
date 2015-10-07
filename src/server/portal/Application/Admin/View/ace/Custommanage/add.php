<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->
	<form id="form" action="{:U('save')}" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">家长名称</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="parent_name" value="">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入家长姓名）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">家长电话</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="mobile_num" value="">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入家长手机号）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">宝宝名称</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="baby_name" value="">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入宝宝名称）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">宝宝性别</label>
			<div class="col-xs-12 col-sm-5">
				<select name="baby_sex">
					<option value="UNKNOWN"  >不详</option>
					<option value="MALE###" >男宝宝</option>
					<option value="FEMALE#"  >女宝宝</option>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（选择宝宝性别）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">宝宝生日</label>
			<div class="col-xs-12 col-sm-5">
                        <input type="text" name="baby_birthday" class="day-input width-100" id="baby_birthday" value="" />
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（选择宝宝生日）</span>
		</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span class="red">*</span>选择所在城区</label>
    <div class="col-xs-12 col-sm-5">
    <div id="city_1"></div>
    <script>
    $(document).ready(function() {
        <?php echo hook('H_XbDistrict', array('id'=>'city_1','district'=>'district','root'=>'28'));?>
    });
    </script>
    </div>
    <div class="help-block col-xs-12 col-sm-reset inline"></div>
    </div>
<!--
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">家庭所在城市</label>
			<div class="col-xs-12 col-sm-5">
				<input name="city" class="autosize-transition span12 form-control" value="">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入家庭所在城市）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">家庭所在城市区域</label>
			<div class="col-xs-12 col-sm-5">
				<input name="district" class="autosize-transition span12 form-control" value="">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入家庭所在城市区域）</span>
		</div>
-->
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">星数</label>
			<div class="col-xs-12 col-sm-5">
				<select name="star">
					<option value="1" >1星</option>
					<option value="2" >2星</option>
					<option value="3" >3星</option>
					<option value="4" >4星</option>
					<option value="5" >5星</option>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入星数）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">客户评级</label>
			<div class="col-xs-12 col-sm-5">
				<select name="level">
					<option value="" >未设置评级</option>
					<option value="A"  >A评级</option>
					<option value="B"  >B评级</option>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（选择客户评级）</span>
		</div>

		<div class="clearfix form-actions">
			<input type="hidden" name="id" value="{$data.id}"/>
            <div class="col-xs-12 center">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button> 
                <button type="reset" class="btn" id="reset-btn">
                    <i class="icon-undo bigger-110"></i> 重置
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
    highlight_subnav('{:U('custommanage/index')}');
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
