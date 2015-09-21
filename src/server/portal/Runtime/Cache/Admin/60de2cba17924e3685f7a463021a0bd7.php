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
	                            
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <li class="active"><a data-toggle="tab" href="#tab1"><i class="green icon-edit"></i>基 础</a></li>
        <li><a data-toggle="tab" href="#tab2"><i class="blue icon-rocket"></i>高 级</a></li>
    </ul>
	<!-- 表单 -->			
	<form id="form" action="<?php echo U('update');?>" method="post" class="form-horizontal doc-modal-form">
	    <div class="tab-content no-border padding-24">
			<!-- 基础 -->
            <div id="tab1" class="tab-pane active">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">字段名</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="name" value="<?php echo ($info["name"]); ?>">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（请输入字段名 英文字母开头，长度不超过30）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">字段标题</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="title" value="<?php echo ($info["title"]); ?>">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（请输入字段标题，用于表单显示）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">字段类型</label>
					<div class="col-xs-12 col-sm-5">
						<select name="type" id="data-type">
							<option value="">----请选择----</option>
							<?php $_result=get_attribute_type();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" rule="<?php echo ($type[1]); ?>"><?php echo ($type[0]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（用于表单中的展示方式）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">字段定义</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="field" value="<?php echo ($info["field"]); ?>" id="data-field">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（字段属性的sql表示）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">参数</label>
					<div class="col-xs-12 col-sm-5">
						<textarea name="extra" class="form-control"><?php echo ($info["extra"]); ?></textarea>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（布尔、枚举、多选字段类型的定义数据）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">默认值</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="value" value="<?php echo ($info["value"]); ?>">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（字段的默认值）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">字段备注</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="remark" value="<?php echo ($info["remark"]); ?>">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">(用于表单中的提示)</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">是否显示</label>
					<div class="col-xs-12 col-sm-5">
						<select name="is_show">
							<option value="1">始终显示</option>
							<option value="2">新增显示</option>
							<option value="3">编辑显示</option>
							<option value="0">不显示</option>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（是否显示在表单中）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">是否必填</label>
					<div class="col-xs-12 col-sm-5">
						<select name="is_must">
							<option value="0">否</option>
							<option value="1">是</option>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（用于自动验证）</span>
				</div>
                </div>
            <div id="tab2" class="tab-pane tab2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">验证方式</label>
					<div class="col-xs-12 col-sm-5">
						<select name="validate_type">
							<option value="regex">正则验证</option>
							<option value="function">函数验证</option>
							<option value="unique">唯一验证</option>
							<option value="length">长度验证</option>
                            <option value="in">验证在范围内</option>
                            <option value="notin">验证不在范围内</option>
                            <option value="between">区间验证</option>
                            <option value="notbetween">不在区间验证</option>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline"></span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">验证规则</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="validate_rule" value="<?php echo ($info["validate_rule"]); ?>">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（根据验证方式定义相关验证规则）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">出错提示</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="error_info" value="<?php echo ($info["error_info"]); ?>">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline"></span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">验证时间</label>
					<div class="col-xs-12 col-sm-5">
						<select name="validate_time">
                            <option value="3">始 终</option>
							<option value="1">新 增</option>
							<option value="2">编 辑</option>
							</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline"></span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">自动完成方式</label>
					<div class="col-xs-12 col-sm-5">
						<select name="auto_type">
							<option value="function">函数</option>
							<option value="field">字段</option>
							<option value="string">字符串</option>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline"></span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">自动完成规则</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="auto_rule" value="<?php echo ($info["auto_rule"]); ?>">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（根据完成方式订阅相关规则）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">自动完成时间</label>
					<div class="col-xs-12 col-sm-5">
						<select name="auto_time">
							<option value="3">始 终</option>
							<option value="1">新 增</option>
							<option value="2">编 辑</option>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline"></span>
				</div>
			</div>

			<!-- 按钮 -->
			<div class="clearfix form-actions">
                <div class="col-xs-12 center">
					<input type="hidden" name="id" value="<?php echo ($info['id']); ?>"/>
					<input type="hidden" name="model_id" value="<?php echo ($info['model_id']); ?>"/>
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
	    
<script type="text/javascript" charset="utf-8">
//导航高亮
highlight_subnav('<?php echo U('Model/index');?>');
Think.setValue('type', "<?php echo ((isset($info["type"]) && ($info["type"] !== ""))?($info["type"]):''); ?>");
Think.setValue('is_show', "<?php echo ((isset($info["is_show"]) && ($info["is_show"] !== ""))?($info["is_show"]):1); ?>");
Think.setValue('is_must', "<?php echo ((isset($info["is_must"]) && ($info["is_must"] !== ""))?($info["is_must"]):0); ?>");
Think.setValue('validate_time', "<?php echo ((isset($info["validate_time"]) && ($info["validate_time"] !== ""))?($info["validate_time"]):3); ?>");
Think.setValue('auto_time', "<?php echo ((isset($info["auto_time"]) && ($info["auto_time"] !== ""))?($info["auto_time"]):3); ?>");
Think.setValue('validate_type', "<?php echo ((isset($info["validate_type"]) && ($info["validate_type"] !== ""))?($info["validate_type"]):'regex'); ?>");
Think.setValue('auto_type', "<?php echo ((isset($info["auto_type"]) && ($info["auto_type"] !== ""))?($info["auto_type"]):'function'); ?>");
$(function(){
	showTab();
})
<?php if((ACTION_NAME) == "add"): ?>$(function(){
	$('#data-type').change(function(){
		$('#data-field').val($(this).find('option:selected').attr('rule'));
	});
})<?php endif; ?>
</script>

    </body>
</html>