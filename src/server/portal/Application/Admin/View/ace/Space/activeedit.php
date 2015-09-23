<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
	<!-- 表单 -->
	<form id="form" action="{:U('save')}" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">发布标题</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="title" value="{$item.title}">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入标题）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">关键词</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="tag" value="{$item.tag}">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入关键词,多个关键词以逗号分隔）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">发布内容</label>
			<div class="col-xs-12 col-sm-5">
			<textarea name="content" rows="10" cols="15" style="width:100%;">{$item.content}</textarea>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入发布内容）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">宝宝获得红花数</label>
			<div class="col-xs-12 col-sm-5">
			<select name="redflower_count">
<?php for($i=1;$i<6;$i++){
echo '<option value="'.$i.'" '.($i==$item['redflower_count']?'selected':'').'>'.$i.'朵</option>';
}
?>
</select>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（选择宝宝红花数）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">活动时间</label>
			<div class="col-xs-12 col-sm-5">
				<input name="act_time" class="autosize-transition day-input span12 form-control" value="{$item.act_time}">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">(选择活动时间）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">老师评语</label>
			<div class="col-xs-12 col-sm-5">
			<textarea name="determine" rows="10" cols="15" style="width:100%;">{$item.determine}</textarea>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入老师评语）</span>
		</div>
<?php for($i=1;$i<10;$i++){

?>
                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">上传照片</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image{$i}" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433604" type="application/x-shockwave-flash" id="SWFUpload_{$i}" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433604" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_1&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image{$i}-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image{$i}-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="424" id="cover_id_image{$i}" name="image{$i}">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item">
<?php if(!empty($item['image'.$i])){?>
				    <img width="120" src="<?php echo $item['image'.$i];?>">
<?php }?>
				    </div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image{$i}").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage{$i},
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage{$i}(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image{$i}").val(src);
                                        $("#cover_id_image{$i}").parent().find('.upload-img-box').html(
                                            '&lt;div class="upload-pre-item"&gt;&lt;img width="120" src="' + src + '"/&gt;&lt;/div&gt;'
                                        );
                                    } else {
                                        updateAlert(data.info);
                                        setTimeout(function(){
                                            $('#top-alert').find('button').click();
                                            $(that).removeClass('disabled').prop('disabled',false);
                                        },1500);
                                    }
                                }
                            </script>
                        </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>
<?php  }?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">分享标题</label>
			<div class="col-xs-12 col-sm-5">
				<input name="share_title" class="autosize-transition span12 form-control" value="{$item.share_title}">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入分享标题）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">分享内容</label>
			<div class="col-xs-12 col-sm-5">
			<textarea name="share_content" rows="10" cols="15" style="width:100%;">{$item.share_content}</textarea>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入分享内容）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">分享的图片</label>
			<div class="col-xs-12 col-sm-5">
				<select name="share_img_index">
					<option value="1" <?php echo $item['share_img_index']==1?'selected':''?> >第1张</option>
					<option value="2" <?php echo $item['share_img_index']==2?'selected':''?> >第2张</option>
					<option value="3" <?php echo $item['share_img_index']==3?'selected':''?> >第3张</option>
					<option value="4" <?php echo $item['share_img_index']==4?'selected':''?> >第4张</option>
					<option value="5" <?php echo $item['share_img_index']==5?'selected':''?> >第5张</option>
					<option value="6" <?php echo $item['share_img_index']==6?'selected':''?> >第6张</option>
					<option value="7" <?php echo $item['share_img_index']==7?'selected':''?> >第7张</option>
					<option value="8" <?php echo $item['share_img_index']==8?'selected':''?> >第8张</option>
					<option value="9" <?php echo $item['share_img_index']==9?'selected':''?> >第9张</option>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（选择微信分享的时候用来显示的图片）</span>
		</div>

		<div class="clearfix form-actions">
			<input type="hidden" name="id" value="{$item.id}"/>
			<input type="hidden" name="child_id" value="{$item.child_id}"/>
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
