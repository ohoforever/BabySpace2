<extend name="Public/base"/>

<block name="body">
    <!-- 标题栏 -->
    <div class="page-header">
        <h1>
            列表
            <small>
                <i class="icon-double-angle-right"></i>
                 {$model['title']}
            </small>
        </h1>
    </div>
    <!-- 数据列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">  
            <div class="row">
                <div class="col-sm-12">
                    <form action="" class="search-form">
                        <empty name="model.extend">
                        <label>
                            <a class="btn btn-sm btn-primary" href="{:U('add?model='.$model['id'])}"><i class="icon-plus"></i>新增</a>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-inverse ajax-post confirm" target-form="ids" url="{:U('del?model='.$model['id'])}">
                                <i class="icon-trash"></i>删 除
                            </button>
                        </label>
                        </empty>
				        <!-- 高级搜索 -->
				        <label> 
                            <input type="text" name="{$model['search_key']|default='title'}" class="search-input" value="{:I('title')}" placeholder="请输入关键字">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" id="search" url="{:U('Think/lists','model='.$model['name'],false)}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>  
                </div>
            </div>

            <include file="Think/lists_common"/>
            <include file="Public/page"/>
        </div>
    </div>
</block>

<block name="script">
<script type="text/javascript">
$(function(){

    //导航高亮
    <?php if(isset($active_menu)):?>
    highlight_subnav('<?=U($active_menu)?>');
    <?php else:?>
    highlight_subnav('{:U('Model/index')}');
    <?php endif;?>
})
</script>
</block>
