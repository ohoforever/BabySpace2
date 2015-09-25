<extend name="Public/base" />

<block name="body">
    <form class="form-horizontal" method="post" action="<?=U('')?>" id="form">
        <div class="tab-content no-border padding-24">
            <!-- 基础文档模型 -->
            <div class="tab-pane active tab1" id="tab1">
                <div class="form-group cf">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">问题标题</label>
                    <div class="col-xs-12 col-sm-6">
                        <div class="line-height-2 blue">{$data['title']}</div>

                    </div>
                    <div class="help-block col-xs-12 col-sm-reset inline">
                    </div>

                </div>
                <div class="form-group cf">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">问题内容</label>
                    <div class="col-xs-12 col-sm-6">
                        <div class="line-height-2 ">{$data['question']}</div>

                    </div>
                    <div class="help-block col-xs-12 col-sm-reset inline">
                    </div>
                </div>
                <div class="form-group cf">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">回复内容</label>
                    <div class="col-xs-12 col-sm-6">
                        <textarea class="width-100" name="answer" >{$data['answer']}</textarea>
                    </div>
                    <div class="help-block col-xs-12 col-sm-reset inline">
                    </div>
                </div>
            </div>
            <div class="clearfix form-actions">
                <div class="col-xs-12 center">
                    <input type="hidden" value="{$data['id']}" name="id">
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
</block>

<block name="script">
    <script>
        //导航高亮
        highlight_subnav('{:U('knowledge/bbwdlist')}');
    </script>
</block>
