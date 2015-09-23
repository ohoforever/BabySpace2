<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
	                <label>
	                    <a class="btn btn-sm btn-primary" href="{:U('activeadd?cid='.$cid)}"><i class="icon-plus"></i>新增</a>
	                </label>
                        <label>动态标题
                            <input type="text" class="search-input" name="title" value="{:I('title')}" placeholder="请输入动态标题">
                        </label>
                        <label>动态关键词
                            <input type="text" class="search-input" name="tag" value="{:I('tag')}" placeholder="请输入动态关键词">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('activelist')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>  
                </div>
            </div>
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
<!--
                    <th class="row-selected center">
                       <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                       </label>
                    </th>
-->
					<th class="">活动标题</th>
					<th class="">活动关键字</th>
					<th class="">活动时间</th>
					<th class="">添加时间</th>
					<th class="">录入人</th>
					<th class="">分享标题</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
<!--
                        <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
-->
						<td>{$vo.title}</td>
						<td>{$vo.tag}</td>
						<td>{$vo.act_time}</td>
						<td>{$vo.insert_time}</td>
						<td>{$vo.operator}</td>
						<td>{$vo.share_title}</td>
						<td>
						<a href="{:U('space/activeedit?id='.$vo['id'])}">编辑</a>
						<a href="{:U('space/activedel?id='.$vo['id']).'&cid='.$vo['child_id']}" class="ajax-get"  >删除</a>
						<a href="{:U('space/activeshow?id='.$vo['id'])}">查看详细</a>
						<a href="{:U('space/commentlist?id='.$vo['id'])}">查看评论</a>
						</td>
					</tr>
					</volist>
					<else/>
					<td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
            </table>
            <include file="Public/page"/>
        </div>
    </div>
</block>

<block name="script">
	<script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

	<script type="text/javascript">
	//搜索功能
	$("#search").click(function(){
		var url = $(this).attr('url');
        var query  = $('.search-form').find('input').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
        if( url.indexOf('?')>0 ){
            url += '&' + query;
        }else{
            url += '?' + query;
        }
		window.location.href = url;
	});
	//回车搜索
	$(".search-input").keyup(function(e){
		if(e.keyCode === 13){
		    console.info($("#search"));
			$("#search").click();
			return false;
		}
	});
    //导航高亮
    highlight_subnav('{:U('space/index')}');
	</script>
</block>
