<extend name="Public/base" />

<block name="body">
<?php $sex = ['MALE###'=>'男宝宝','FEMALE#'=>'女宝宝','UNKNOWN'=>'不详'];
$baby_sex  = I('baby_sex');
?>
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
	                    <label>
	                        <a class="btn btn-sm btn-primary" href="{:U('add')}"><i class="icon-plus"></i>新增</a>
	                    </label>
	                    <label>
	                        <a class="btn btn-sm btn-primary" href="{:U('batchadd')}"><i class="icon-plus"></i>批量导入</a>
	                    </label>
                        <label>家长名称
                            <input type="text" class="search-input" name="parent_name" value="{:I('parent_name')}" placeholder="请输入家长名称">
                        </label>
                        <label>宝宝性别
				<select name="baby_sex" class="search-input" >
					<option value="" >请选择</option>
					<option value="MALE###" <?php echo $baby_sex=='MALE###'?'selected':''?> >男宝宝</option>
					<option value="FEMALE#" <?php echo $baby_sex=='FEMALE#'?'selected':''?> >女宝宝</option>
					<option value="UNKNOWN" <?php echo $baby_sex=='UNKNOWN'?'selected':''?> >不详</option>
				</select>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('index')}">
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
					<th class="hidden-sm hidden-xs">宝宝性别</th>
					<th class="hidden-sm hidden-xs">宝宝生日</th>
					<th class="">所在城市</th>
					<th class="hidden-sm hidden-xs">所在区域</th>
					<th class="hidden-sm hidden-xs">用户级别</th>
					<th class="hidden-sm hidden-xs">候选人星数</th>
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
						<td><a href="{:U('Custommanage/info?id='.$vo['id'])}" >{$vo.parent_name} </a></td>
						<td>{$vo.mobile_num}</td>
						<td>{$vo.baby_name}</td>
						<td class="hidden-sm hidden-xs"><?php echo $sex[$vo['baby_sex']];?></td>
						<td class="hidden-sm hidden-xs">{$vo.baby_birthday}</td>
						<td class="">{$vo.city}</td>
						<td class="hidden-sm hidden-xs">{$vo.district}</td>
						<td class="hidden-sm hidden-xs">{$vo.level}</td>
						<td class="hidden-sm hidden-xs">{$vo.star}</td>
						<td>
						<a href="{:U('Custommanage/edit?id='.$vo['id'])}" >编辑</a>
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
         query  += '&'+$('.search-form').find('select').serialize();
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
    highlight_subnav('{:U('custommanage/index')}');
	</script>
</block>
