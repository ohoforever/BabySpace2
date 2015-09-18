<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<!-- 标签页导航 -->
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <?php foreach($field_group as $key=>$group):?>
        <li <eq name="key" value="1">class="active"</eq>><a data-toggle="tab" href="#tab{$key}">{$group}</a></li>
        <?php endforeach;?>
    </ul>
    <!-- 表单 -->
    <form id="form" action="{:U('edit?model='.$model['id'])}" method="post" class="form-horizontal">
    <div class="tab-content no-border padding-24">
        <!-- 基础文档模型 -->
		<?php foreach($field_group as $key=>$group):?>
		<div id="tab{$key}" class="tab-pane <eq name="key" value="1">active</eq> tab{$key}">
            <?php if(isset($fields[$key])):?>
            <volist name="fields[$key]" id="field">
                <php>$field['name'] = strtolower($field['name']);</php>
                <if condition="$field['is_show'] == 1 || $field['is_show'] == 3">
                <div class="form-group cf">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">{$field['title']}</label>
                    <div class="col-xs-12 col-sm-6">
                        <switch name="field.type">
                            <case value="num">
                                <input type="text" class="width-100" name="{$field.name}" value="{$data[$field['name']]}">
                            </case>
                            <case value="string">
                                <input type="text" class="width-100" name="{$field.name}" value="{$data[$field['name']]}">
                            </case>
                            <case value="textarea">
                                <textarea name="{$field.name}" class="form-control">{$data[$field['name']]}</textarea>
                            </case>
                            <case value="date">
                                <input type="text" name="{$field.name}" class="width-100 date" value="{$data[$field['name']]|date='Y-m-d',###}" placeholder="请选择日期" />
                            </case>
                            <case value="datetime">
                                <input type="text" name="{$field.name}" class="width-100 time" value="{$data[$field['name']]|date='Y-m-d H:i',###}" placeholder="请选择时间" />
                            </case>
                            <case value="bool">
                                <select name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="data[$field['name']]" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="select">
                                <select name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="data[$field['name']]" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="radio">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
                                        <input type="radio" class="ace" value="{$key}" name="{$field.name}" <eq name="data[$field['name']]" value="$key">checked="checked"</eq>>
                                        <span class="lbl"> {$vo}&nbsp;</span> 
                                	</label>
                                </volist>
                            </case>
                            <case value="checkbox">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
                                        <input type="checkbox" class="ace" value="{$key}" name="{$field.name}[]" <if condition="check_document_position($data[$field['name']],$key)">checked="checked"</if>>
                                        <span class="lbl"> {$vo}&nbsp;</span> 
                                	</label>
                                </volist>
                            </case>
                            <case value="editor">
                                <textarea name="{$field.name}">{$data[$field['name']]}</textarea>
                                {:hook('adminArticleEdit', array('name'=>$field['name'],'value'=>$data[$field['name']]))}
                            </case>
                            <case value="picture">
                                <div class="controls">
									<input type="file" id="upload_picture_{$field.name}">
									<input type="hidden" name="{$field.name}" id="cover_id_{$field.name}" value="{$data[$field['name']]}"/>
									<div class="upload-img-box">
									<notempty name="data[$field['name']]">
										<div class="upload-pre-item"><img width="120" src="{$data[$field['name']]|get_cover='path'}"/></div>
									</notempty>
									</div>
								</div>
								<script type="text/javascript">
								<?php 
								    $thumb = array();
								    foreach (explode("\r\n", $field['extra']) as $k=>$v){
                                        if(empty($v) && !intval($v)){
                                            continue;
                                        }
                                        $thumb[] = "'thumb[$k]':'$v'";
                                    }
								?>
								//上传图片
							    /* 初始化上传插件 */
								$("#upload_picture_{$field.name}").uploadify({
// 								    'debug'           : true,
							        "height"          : 30,
							        "swf"             : "__STATIC__/uploadify/uploadify.swf",
							        "fileObjName"     : "download",
							        "buttonText"      : "上传图片",
							        'formData'        : {<?php echo implode(',', $thumb)?>},
							        "uploader"        : "{:U('File/uploadPicture',array('session_id'=>session_id()))}",
							        "width"           : 120,
							        'removeTimeout'	  : 1,
							        'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
							        "onUploadSuccess" : uploadPicture{$field.name},
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
							    });
								function uploadPicture{$field.name}(file, data){
							    	var data = $.parseJSON(data);
							    	var src = '';
							        if(data.status){
							        	$("#cover_id_{$field.name}").val(data.id);
							        	src = data.url || '__ROOT__' + data.path;
							        	$("#cover_id_{$field.name}").parent().find('.upload-img-box').html(
							        		'<div class="upload-pre-item"><img width="120" src="' + src + '"/></div>'
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
                            </case>
                            <case value="file">
								<div class="controls">
									<input type="file" id="upload_file_{$field.name}">
									<input type="hidden" name="{$field.name}" value="{$data[$field['name']]}"/>
									<div class="upload-img-box">
										<present name="data[$field['name']]">
											<div class="upload-pre-file"><span class="upload_icon_all"></span>{$data[$field['name']]|get_table_field=###,'id','name','File'}</div>
										</present>
									</div>
								</div>
								<script type="text/javascript">
								//上传图片
							    /* 初始化上传插件 */
								$("#upload_file_{$field.name}").uploadify({
							        "height"          : 30,
							        "swf"             : "__STATIC__/uploadify/uploadify.swf",
							        "fileObjName"     : "download",
							        "buttonText"      : "上传附件",
							        "uploader"        : "{:U('File/upload',array('session_id'=>session_id()))}",
							        "width"           : 120,
							        'removeTimeout'	  : 1,
							        "onUploadSuccess" : uploadFile{$field.name},
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
							    });
								function uploadFile{$field.name}(file, data){
									var data = $.parseJSON(data);
							        if(data.status){
							        	var name = "{$field.name}";
							        	$("input[name="+name+"]").val(data.data);
							        	$("input[name="+name+"]").parent().find('.upload-img-box').html(
							        		"<div class=\"upload-pre-file\"><span class=\"upload_icon_all\"></span>" + data.info + "</div>"
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
                            </case>
                            <case value="district">
                                <div id="city_{$field.name}"></div>
                                <script>
                                    <?php echo hook('H_XbDistrict', array('id'=>'city_'.$field['name'],'district'=>$field['name'],'selected'=>$data[$field['name']]));?>
                                </script>
                            </case>
                            <default/>
                            <input type="text" class="width-100" name="{$field.name}" value="{$data[$field['name']]}">
                        </switch>
                    </div>
                    <div class="help-block col-xs-12 col-sm-reset inline"><notempty name="field['remark']">（{$field['remark']}）</notempty>
                    </div>
                </div>
                </if>
            </volist>
            <?php elseif(file_exists(APP_PATH.MODULE_NAME.'/View/ace/Modules/'.$data['name'].'.php')):?>
                <?php require_once APP_PATH.MODULE_NAME.'/View/ace/Modules/'.$data['name'].'.php';?>
            <?php endif;?>

        </div>
		<?php endforeach;?>

        <div class="clearfix form-actions">
            <div class="col-xs-12 center">
                <input type="hidden" name="id" value="{$data.id}">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button> <button type="reset" class="btn" id="reset-btn">
                    <i class="icon-undo bigger-110"></i> 重置
                </button>   <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
               <i class="icon-reply"></i>返回上一页
            </a>  </div>
        </div>
    </div>
    </form>
</div>
</block>

<block name="script">
<link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<php>if(C('COLOR_STYLE')=='blue_color') echo '<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">';</php>
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
$('#submit').click(function(){
    $('#form').submit();
});

$(function(){
	$('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    showTab();
    //导航高亮
    highlight_subnav('{:U('modules/lists')}');
});
</script>
</block>
