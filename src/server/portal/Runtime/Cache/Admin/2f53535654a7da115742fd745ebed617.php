<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
    <head>
        <meta charset="utf-8" />
        
        <title><?php echo ($meta_title); if(!empty($meta_title)): ?>|<?php echo C('WEB_SITE_TITLE'); endif; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- basic styles -->
        <link rel="stylesheet" href="/Public/Ace/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/Public/Ace/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="/Public/Ace/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="/Public/Ace/css/font-googleapis.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="/Public/Ace/css/ace.min.css" />
        <link rel="stylesheet" href="/Public/Ace/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="/Public/Ace/css/ace-skins.min.css" />
        <link rel="stylesheet" href="/Public/Admin/css/common.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="/Public/Ace/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->
        
        <!-- ace settings handler -->

        <script src="/Public/Ace/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/Public/Ace/js/html5shiv.js"></script>
        <script src="/Public/Ace/js/respond.min.js"></script>
        <![endif]-->
        
	    <!--[if lt IE 9]>
	    <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
	    <![endif]-->
	    <!--[if gte IE 9]><!-->
	    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
	    <!--<![endif]-->
    </head>
    
    <body>
        <!--top-->
        <div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>
            
            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <i class="icon-leaf"></i>
                            <?php echo C('WEB_SITE_TITLE');?>
                        </small>
                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->
            
                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
            
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="/Public/Ace/avatars/avatar2.png" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>欢迎光临,</small>
                                    <?php echo session('user_auth.username');?>
                                </span>
            
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="<?php echo U('User/updatePassword');?>">
                                        <i class="icon-key"></i>
                                                                                                  修改密码
                                    </a>
                                </li>
            
                                <li>
                                    <a href="<?php echo U('User/updatenickname');?>">
                                        <i class="icon-user"></i>
                                                                                                 修改昵称
                                    </a>
                                </li>
            
                                <li class="divider"></li>
            
                                <li>
                                    <a id="logout" href="javascript:">
                                        <i class="icon-off"></i>
                                                                                                        退出
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- /.ace-nav -->
                </div><!-- /.navbar-header -->
            </div><!-- /.container -->
        </div>
        <!--top-->
        <script>
        $(document).ready(function(){
            $("#logout").click(function(){
                layer.confirm('您确定退出？',function(index){
                    layer.close(index);
                    $.get('<?php echo U('Public/logout');?>',function(resp){
                        window.location = resp.url;
                    })
                });
                return false;
            })
        })
        </script>
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>
                
                <div class="sidebar" id="sidebar">
                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                    </script>

                    <ul class="nav nav-list">
		                <?php if(!empty($_extra_menu)): ?>
		                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                        <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>">
			                    <a <?php if(!empty($menu["child"])): ?>class="dropdown-toggle" href="javascript:"<?php else: ?>href="<?php echo (U($menu["url"])); ?>"<?php endif; ?>>
	                                <i class="<?php echo ($menu["class_fix"]); ?>"></i>
	                                <span class="menu-text"><?php echo ($menu["title"]); ?></span>
	                                <?php if(!empty($menu["child"])): ?><b class="arrow icon-angle-down"></b><?php endif; ?>
	                            </a>
	                            <?php if(!empty($menu["child"])): ?><ul class="submenu">
		                            <?php if(is_array($menu["child"])): foreach($menu["child"] as $key=>$sub_menu): ?><!-- 子导航 -->
		                            <?php if(!empty($sub_menu)): ?><li>
		                                <a href="<?php echo (U($sub_menu["url"])); ?>">
		                                <i class="icon-double-angle-right"></i>
		                                <?php echo ($sub_menu["title"]); ?>
		                                </a>
		                            </li><?php endif; ?>
		                            <!-- /子导航 --><?php endforeach; endif; ?>
                                </ul><?php endif; ?>
			                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><!-- /.nav-list -->

                    <div class="sidebar-collapse" id="sidebar-collapse">
                        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                    </div>

                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                    </script>
                </div>
                
                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>

                        <ul class="breadcrumb">
                            <?php $i = '1'; ?>
			                <?php if(is_array($__MENU__["_nav"])): foreach($__MENU__["_nav"] as $k=>$nav): if($i == 1 AND $nav["title"] != '首页'): ?><li class="active">
		                                <i class="icon-home home-icon"></i> 首页
		                            </li><?php endif; ?>
			                    <li <?php if($i == count(__MENU__._nav)): ?>class="active"<?php endif; ?>>
			                        <?php if($nav["title"] == '首页'): ?><i class="icon-home home-icon"></i><?php endif; ?>
	                                <?php echo ($nav["title"]); ?>
	                            </li>
			                    <?php $i = $i+1; endforeach; endif; ?>
                        </ul>
                        <!-- .breadcrumb -->
                    </div> 
                    <!--内容-->
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
						        <!-- PAGE CONTENT BEGINS -->
						
						        <!--[if lte IE 7]>
						        <div class="alert alert-block alert-warning">
						            <button type="button" class="close" data-dismiss="alert">
						                <i class="icon-remove"></i>
						            </button>
						
						            <i class="icon-lightbulb "></i>
						            <strong>您使用的浏览器版本过低,请使用IE8以上浏览器 浏览本后台</strong>
						        </div>
						        <![endif]--> 
						        <!--msg -->
                                
								<div id="top-alert" class="alert alert-danger" style="display: none;">
	                                <button data-dismiss="alert" class="close" type="button">
	                                    <i class="icon-remove"></i>
	                                </button>
	                                <div class="alert-content"></div>
	                            </div>
	                            
<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
<div class="page-header">
    <h1>
        编辑
        <small>
            <i class="icon-double-angle-right"></i>
             <?php echo ($model['title']); ?>
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

                            </div>
                        </div>
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->

            </div><!-- /.main-container-inner -->

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
	    
	    <script type="text/javascript">
	    (function(){
	        var ThinkPHP = window.Think = {
	            "ROOT"   : "", //当前网站地址
	            "APP"    : "/admin.php?s=", //当前项目地址
	            "PUBLIC" : "/Public", //项目公共目录地址
	            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
	            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
	            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	        }
	    })();
	    </script>
	    <script type="text/javascript" src="/Public/static/think.js"></script>
	    <script type="text/javascript" src="/Public/static/layer/layer.min.js"></script>
	    
        <script type="text/javascript">
            if("ontouchend" in document) document.write('<script src="/Public/Ace/js/jquery.mobile.custom.min.js">'+'</'+'script>');
        </script>
        <script src="/Public/Ace/js/bootstrap.min.js"></script>
        <script src="/Public/static/respond.js"></script>
        <!-- 自动补全输入框 js -->
        <script src="/Public/Ace/js/typeahead-bs2.min.js"></script>
        
        <!-- page specific plugin scripts -->

        <script src="/Public/Ace/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="/Public/Ace/js/jquery.ui.touch-punch.min.js"></script>

        <!-- ace scripts -->

        <script src="/Public/Ace/js/ace-elements.min.js"></script>
        <script src="/Public/Ace/js/ace.min.js"></script>
        <!-- inline scripts related to this page -->
        
	    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
	    <script type="text/javascript" src="/Public/static/common.js"></script>
	    <script type="text/javascript">
	        +function(){
	            /* 左边菜单高亮 */
	            var $subnav = $("#sidebar");
	            url = window.location.pathname + window.location.search;
	            url = url.replace(/(\/(p)\/\d+)|(&\w*=.+)/, "");
	            $subnav.find("a[href='" + url + "']").parent().addClass("active");
	        }();
	    </script>
	    
<link href="/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
<link href="/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
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
    highlight_subnav('<?php echo U('Model/index');?>');
    <?php endif;?>
});
</script>

    </body>
</html>