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
        <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php if($menu['id'] == 2) :?>active open<?php endif;?>" id="menu-<?php echo ($menu["id"]); ?>">
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
        <?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
            <?php if(!empty($sub_menu)): ?><li class="<?php if(($sub_menu['current']) == "1"): ?>active open<?php endif; ?>">
                    <a <?php if(!empty($sub_menu["_child"])): ?>class="dropdown-toggle" href="javascript:"<?php else: ?>href="<?php echo (U($sub_menu["url"])); ?>"<?php endif; ?>>
                        <i class="<?php echo ($sub_menu["groups"]); ?>"></i>
                        <span class="menu-text"><?php echo ($sub_menu["title"]); ?></span>
                        <?php if(!empty($sub_menu["_child"])): ?><b class="arrow icon-angle-down"></b><?php endif; ?>
                    </a>
                
                    <ul class="submenu <?php if(($sub_menu["current"]) != "1"): ?>open<?php endif; ?>">
                        <?php if(is_array($sub_menu['_child'])): $i = 0; $__LIST__ = $sub_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li <?php if($menu['id'] == $cate_id or $menu['current'] == 1): ?>class="active"<?php endif; ?>>
                                <?php if(($menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (U($menu["url"])); ?>"><i class="icon-double-angle-right"></i><?php echo ($menu["title"]); ?></a>
                                <?php else: ?>
                                <a class="item" href="javascript:void(0);"><i class="icon-double-angle-right"></i><?php echo ($menu["title"]); ?></a><?php endif; ?>
        
                                <!-- 一级子菜单 -->
                                <?php if(isset($menu['_child'])): ?><ul class="submenu" style="display: block;">
                                	<?php if(is_array($menu['_child'])): foreach($menu['_child'] as $key=>$three_menu): ?><li>
                                        <?php if(($three_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (U($three_menu["url"])); ?>"><?php echo ($three_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($three_menu["title"]); ?></a><?php endif; ?>
                                        <!-- 二级子菜单 -->
                                        <?php if(isset($three_menu['_child'])): ?><ul class="submenu" style="display: block;">
                                        	<?php if(is_array($three_menu['_child'])): foreach($three_menu['_child'] as $key=>$four_menu): ?><li>
                                                <?php if(($four_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo U('index','cate_id='.$four_menu['id']);?>"><?php echo ($four_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($four_menu["title"]); ?></a><?php endif; ?>
                                                <!-- 三级子菜单 -->
                                                <?php if(isset($four_menu['_child'])): ?><ul class="submenu" style="display: block;">
                                                	<?php if(is_array($four_menu['_child'])): $i = 0; $__LIST__ = $four_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$five_menu): $mod = ($i % 2 );++$i;?><li>
                                                    	<?php if(($five_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo U('index','cate_id='.$five_menu['id']);?>"><?php echo ($five_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($five_menu["title"]); ?></a><?php endif; ?>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </ul><?php endif; ?>
                                                <!-- end 三级子菜单 -->
                                            </li><?php endforeach; endif; ?>
                                        </ul><?php endif; ?>
                                        <!-- end 二级子菜单 -->
                                    </li><?php endforeach; endif; ?>
                                </ul><?php endif; ?>
                                <!-- end 一级子菜单 -->
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li><?php endif; ?>
            <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- 回收站 -->
    	<?php if(($show_recycle) == "1"): ?><li>
            <a href="<?php echo U('article/recycle');?>">
                <i class="icon-trash"></i>
                <span class="menu-text">回收站</span>
            </a>
        </li><?php endif; ?>
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
	                            

<!-- 数据表格 -->
<div class="table-responsive">
    <div class="dataTables_wrapper"> 
        <div class="row">
            <button url="<?php echo U('article/clear');?>" class="btn btn-sm btn-danger ajax-get">清 空</button>
            <button url="<?php echo U('article/permit');?>" class="btn btn-sm btn-success ajax-post" target-form="ids">还 原</button>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable">  
            <thead>
                <tr>
        		<th class="row-selected">
	               <label>
                       <input class="ace check-all" type="checkbox"/>
                       <span class="lbl"></span>
                   </label>
        		</th>
        		<th class="">编号</th>
        		<th class="">标题</th>
        		<th class="">创建者</th>
        		<th class="">类型</th>
        		<th class="">分类</th>
        		<th class="">删除时间</th>
        		<th class="">操作</th>
        		</tr>
            </thead>
            <tbody>
        		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <label>
                            <input class="ace ids" type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>" />
                            <span class="lbl"></span>
                        </label>
                    </td>
        			<td><?php echo ($vo["id"]); ?> </td>
        			<td><?php echo ($vo["title"]); ?></td>
        			<td><?php echo ($vo["username"]); ?> </td>
        			<td><span><?php echo get_document_type($vo['type']);?></span></td>
        			<td><span><?php echo get_cate($vo['category_id']);?></span></td>
        			<td><span><?php echo (time_format($vo["update_time"])); ?></span></td>
        			<td><a href="<?php echo U('article/permit?ids='.$vo['id']);?>" class="ajax-get">还原</a>
                        </td>
        		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
        	</tbody>
        </table> 
               <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                <div class="dataTables_paginate paging_bootstrap">
                    <ul class="pagination">
                    <?php echo ($_page); ?>
                    </ul>
                </div>
            </div>
        </div>
	</div>
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
	    
    </body>
</html>