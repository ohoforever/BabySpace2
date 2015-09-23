<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<div class="page-header">
    <h1>
        新增
        <small>
            <i class="icon-double-angle-right"></i>
             {$model['title']}
        </small>
    </h1>
</div>
<!-- 标签页导航 -->
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        
        <volist name=":parse_config_attr($model['field_group'])" id="group">
        <li <eq name="key" value="1">class="active"</eq>><a data-toggle="tab" href="#tab{$key}">{$group}</a></li>
        </volist>
    </ul>
    <!-- 表单 -->
    <form id="form" action="{:U('add?model='.$model['id'])}" method="post" class="form-horizontal">
    <div class="tab-content no-border padding-24">
        <!-- 基础文档模型 -->
        <div class="widget-box">
            <div class="widget-header">
                <h5>Default Widget Box</h5>

                <div class="widget-toolbar">
                    <a data-action="settings" href="#">
                        <i class="icon-cog"></i>
                    </a>

                    <a data-action="reload" href="#">
                        <i class="icon-refresh"></i>
                    </a>

                    <a data-action="collapse" href="#">
                        <i class="icon-chevron-up"></i>
                    </a>

                    <a data-action="close" href="#">
                        <i class="icon-remove"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <p class="alert alert-info">
                        Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur.
                    </p>
                    <p class="alert alert-success">
                        Raw denim you probably haven't heard of them jean shorts Austin.
                    </p>
                </div>
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-xs-12 center">
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
<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">

$(function(){
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    <?php if(isset($active_menu)):?>
    //导航高亮
    highlight_subnav('<?=U($active_menu)?>');
    <?php else:?>
    highlight_subnav('{:U('Model/index')}');
    <?php endif;?>
});
</script>
</block>
