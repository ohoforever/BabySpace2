<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<div class="page-header">
    <h1>
        编辑
        <small>
            <i class="icon-double-angle-right"></i>
             {$model['title']}
        </small>
    </h1>
</div>
<!-- 标签页导航 -->
    <div class="tabbable">
        <ul class="nav nav-tabs padding-18">
            <li class="active">
                <a href="#tab1" data-toggle="tab">基本信息</a>
            </li>
            <li>
                <a href="#tab2" data-toggle="tab">活动图片</a>
            </li>
            <li>
                <a href="#tab3" data-toggle="tab">分享内容</a>
            </li>
        </ul>
        <!-- 表单 -->
        <form class="form-horizontal" method="post" action="/admin.php?s=/wonderful/edit/model/24.html" id="form">


            <div class="tab-content no-border padding-24">
                <!-- 基础文档模型 -->
                <div class="tab-pane active tab1" id="tab1">
                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">活动标题</label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" value="一起中秋做月饼" name="title" class="width-100">
                        </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">活动时间</label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="请选择时间" value="1970-01-01 08:00" class="width-100 time" name="act_time">
                        </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">状态</label>
                        <div class="col-xs-12 col-sm-6">
                            <label>
                                <input type="radio" checked="checked" name="status" value="0" class="ace">
                                <span class="lbl">OK#显示&nbsp;</span>
                            </label><label>
                                <input type="radio" name="status" value="1" class="ace">
                                <span class="lbl">OFF隐藏&nbsp;</span>
                            </label>                    </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">关键词,以逗号区分</label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" value="月饼" name="tag" class="width-100">                    </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">活动内容</label>
                        <div class="col-xs-12 col-sm-6">
                            <textarea class="form-control" name="content">一起中秋做月饼</textarea>
                        </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                </div>

                <div id="tab2" class="tab-pane tab2 active">

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片1</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image1" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433623" type="application/x-shockwave-flash" id="SWFUpload_3" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433623" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_3&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image1-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image1-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="426" id="cover_id_image1" name="image1">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe6677944b9.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image1").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage1,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage1(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image1").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image1").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片2</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image2" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433614" type="application/x-shockwave-flash" id="SWFUpload_2" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433614" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_2&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image2-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image2-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="425" id="cover_id_image2" name="image2">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe666e6b7e3.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image2").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage2,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage2(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image2").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image2").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片3</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image3" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433631" type="application/x-shockwave-flash" id="SWFUpload_4" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433631" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_4&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image3-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image3-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="427" id="cover_id_image3" name="image3">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe667fb9e9c.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image3").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage3,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage3(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image3").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image3").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片4</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image4" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433640" type="application/x-shockwave-flash" id="SWFUpload_5" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433640" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_5&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image4-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image4-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="428" id="cover_id_image4" name="image4">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe6696784a5.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image4").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage4,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage4(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image4").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image4").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片5</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image5" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433666" type="application/x-shockwave-flash" id="SWFUpload_8" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433666" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_8&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image5-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image5-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="431" id="cover_id_image5" name="image5">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe66a7d80ea.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image5").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage5,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage5(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image5").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image5").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片6</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image6" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433658" type="application/x-shockwave-flash" id="SWFUpload_7" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433658" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_7&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image6-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image6-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="430" id="cover_id_image6" name="image6">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe66a25acb0.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image6").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage6,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage6(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image6").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image6").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片7</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image7" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433650" type="application/x-shockwave-flash" id="SWFUpload_6" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433650" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_6&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image7-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image7-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="429" id="cover_id_image7" name="image7">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe669cb97fc.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image7").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage7,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage7(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image7").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image7").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片8</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image8" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433604" type="application/x-shockwave-flash" id="SWFUpload_1" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433604" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_1&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image8-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image8-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="424" id="cover_id_image8" name="image8">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe66613e8a3.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image8").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage8,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage8(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image8").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image8").parent().find('.upload-img-box').html(
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

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">照片9</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="controls">
                                <div id="upload_picture_image9" class="uploadify" style="height: 30px; width: 120px;"><object width="120" height="30" class="swfupload" data="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433593" type="application/x-shockwave-flash" id="SWFUpload_0" style="position: absolute; z-index: 1;"><param value="transparent" name="wmode"><param value="/Public/static/uploadify/uploadify.swf?preventswfcaching=1442736433593" name="movie"><param value="high" name="quality"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="movieName=SWFUpload_0&amp;uploadURL=%2Fadmin.php%3Fs%3D%2Ffile%2Fuploadpicture%2Fsession_id%2Fhf8rvqqjeqtpbm3ke7bd9qeab6.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2" name="flashvars"></object><div id="upload_picture_image9-button" class="btn btn-sm btn-purple " style="width: 120px;"><i class="icon-cloud-upload">上传图片</i></div></div><div id="upload_picture_image9-queue" class="uploadify-queue"></div>
                                <input type="hidden" value="423" id="cover_id_image9" name="image9">
                                <div class="upload-img-box">
                                    <div class="upload-pre-item"><img width="120" src="http://7xaw5p.com1.z0.glb.clouddn.com/55fe665988018.jpg"></div>									</div>
                            </div>
                            <script type="text/javascript">
                                //上传图片
                                /* 初始化上传插件 */
                                $("#upload_picture_image9").uploadify({
                                    "height"          : 30,
                                    "swf"             : "/Public/static/uploadify/uploadify.swf",
                                    "fileObjName"     : "download",
                                    "buttonText"      : "上传图片",
                                    "uploader"        : "/admin.php?s=/file/uploadpicture/session_id/hf8rvqqjeqtpbm3ke7bd9qeab6.html",
                                    "width"           : 120,
                                    'removeTimeout'	  : 1,
                                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                    "onUploadSuccess" : uploadPictureimage9,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
                                });
                                function uploadPictureimage9(file, data){
                                    var data = $.parseJSON(data);
                                    var src = '';
                                    if(data.status){
                                        $("#cover_id_image9").val(data.id);
                                        src = data.url || '' + data.path;
                                        $("#cover_id_image9").parent().find('.upload-img-box').html(
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

                </div>

                <div id="tab3" class="tab-pane tab3 active">

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">分享标题</label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" value="月饼做不停" name="share_title" class="width-100">                    </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">分享图片下标</label>
                        <div class="col-xs-12 col-sm-6">
                            <label>
                                <input type="radio" checked="checked" name="share_img_index" value="0" class="ace">
                                <span class="lbl">1&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="1" class="ace">
                                <span class="lbl">2&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="2" class="ace">
                                <span class="lbl">3&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="3" class="ace">
                                <span class="lbl">4&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="4" class="ace">
                                <span class="lbl">5&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="5" class="ace">
                                <span class="lbl">6&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="6" class="ace">
                                <span class="lbl">7&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="7" class="ace">
                                <span class="lbl">8&nbsp;</span>
                            </label><label>
                                <input type="radio" name="share_img_index" value="8" class="ace">
                                <span class="lbl">9&nbsp;</span>
                            </label>                    </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                    <div class="form-group cf">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">分享内容</label>
                        <div class="col-xs-12 col-sm-6">
                            <textarea class="form-control" name="share_content">宝宝今天和我们一起做月饼</textarea>                    </div>
                        <div class="help-block col-xs-12 col-sm-reset inline">
                        </div>
                    </div>

                </div>

                <div class="clearfix form-actions">
                    <div class="col-xs-12 center">
                        <input type="hidden" value="1" name="id">
                        <button id="sub-btn" class="btn btn-success ajax-post no-refresh" target-form="form-horizontal" type="submit">
                            <i class="icon-ok bigger-110"></i> 确认保存
                        </button>
                        <button id="reset-btn" class="btn" type="reset">
                            <i class="icon-undo bigger-110"></i> 重置
                        </button>
                        <a href="javascript:;" class="btn btn-info" onclick="history.go(-1)">
                            <i class="icon-reply"></i>返回上一页
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</block>

<block name="script">
<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
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
    <?php if(isset($active_menu)):?>
    //导航高亮
    highlight_subnav('<?=U($active_menu)?>');
    <?php else:?>
    highlight_subnav('{:U('Model/index')}');
    <?php endif;?>
});
</script>
</block>
