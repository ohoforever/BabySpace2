<extend name="Public/base" />

<block name="body">
<link rel="stylesheet" href="__STATIC__/uploadify/uploadify.css" />
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<?php
    echo ace_form_open();
?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-2 control-label no-padding-right">文件</label>
        <div class="col-xs-12 col-sm-5">
            <div class="controls">
                <input type="file" id="upload_file_file_id">
                <input type="hidden" name="file_id" value=""/>
                <div class="upload-img-box">
                </div>
            </div>
            <script type="text/javascript">
                //上传图片
                /* 初始化上传插件 */
                $("#upload_file_file_id").uploadify({
                    "height"          : 30,
                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                    "fileObjName"     : "download",
                    "buttonText"      : "上传文件",
                    "uploader"        : "{:U('File/upload',array('session_id'=>session_id()))}",
                    "width"           : 120,
                    'removeTimeout'	  : 1,
                    'fileTypeExts'	  : '*.xls;',
                    "onUploadSuccess" : uploadFilefile_id,
                    'onFallback' : function() {
                        alert('未检测到兼容版本的Flash.');
                    }
                });
                function uploadFilefile_id(file, data){
                    var data = $.parseJSON(data);
                    if(data.status){
                        var name = "file_id";
                        $("input[name="+name+"]").val(data.data);
                        $("input[name="+name+"]").parent().find('.upload-img-box').html(
                                "<div class=\"upload-pre-file\"><span class=\"upload_icon_all\"></span>" + data.info + "</div>"
                        );
                    } else {
                        updateAlert(data.info);
                    }
                }
            </script>
        </div>
        <span class="help-block col-xs-12 col-sm-reset inline">（请选择要上传的文件，仅支持xls格式）</span>
    </div>
<?php
    echo ace_srbtn('确认导入');
    echo ace_form_close()
    ?>
</block>
<block name="script">
<script type="text/javascript" charset="utf-8">
	Think.setValue('type',{$type|default=1});
    //导航高亮
    highlight_subnav('{:U('custommanage/index')}');
</script>
</block>
