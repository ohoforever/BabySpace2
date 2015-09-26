<extend name="Public/base" />

<block name="body">
<?php $sex = ['MALE###'=>'男宝宝','FEMALE#'=>'女宝宝','UNKNOWN'=>'不详'];
$baby_sex  = I('baby_sex');
$status= ['CRT'=>'待开发','FLS'=>'开发失败','OK#'=>'开发完成'];
?>
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>家长名称
                            <input type="text" class="search-input" name="parent_name" value="{:I('parent_name')}" placeholder="请输入家长名称">
                        </label>
                        <label>家长电话
                            <input type="text" class="search-input" name="mobile_num" value="{:I('mobile_num')}" placeholder="请输入家长电话">
                        </label>
                        <label>宝宝名称
                            <input type="text" class="search-input" name="baby_name" value="{:I('baby_name')}" placeholder="请输入宝宝名称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('allocate')}">
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
					<th class="">家长姓名</th>
					<th class="">家长电话</th>
					<th class="">宝宝名称</th>
					<th class="hidden-480">宝宝性别</th>
					<th class="hidden-480">宝宝生日</th>
					<th class="hidden-480">所在城市</th>
					<th class="">所在区域</th>
					<th class="">用户级别</th>
					<th class="hidden-480">候选人星数</th>
					<th class="">开发状态</th>
					<th class="">跟单人</th>
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
						<td>{$vo.parent_name} </td>
						<td>{$vo.mobile_num}</td>
						<td>{$vo.baby_name}</td>
						<td class="hidden-480"><?php echo $sex[$vo['baby_sex']];?></td>
						<td class="hidden-480">{$vo.baby_birthday}</td>
						<td class="hidden-480">{$vo.city}</td>
						<td>{$vo.district}</td>
						<td>{$vo.level}</td>
						<td class="hidden-480">{$vo.star}</td>
						<td><?php echo  $status[$vo['status']];?></td>
						<td>{$vo.username}</td>
						<td>
						<a href="{:U('Custommanage/allocateinfo?id='.$vo['id'])}" >调配</a>
						<a href="{:U('Custommanage/setStatus?type=F&id='.$vo['id'])}" class="ajax-get confirm " >开发失败</a>
						<a href="{:U('Custommanage/setStatus?type=S&id='.$vo['id'])}" class="ajax-get confirm" >开发完成</a>
						</td>
					</tr>
					</volist>
					<else/>
					<td colspan="11" class="text-center"> aOh! 暂时还没有内容! </td>
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
    highlight_subnav('{:U('custommanage/allocate')}');
	</script>
</block>
