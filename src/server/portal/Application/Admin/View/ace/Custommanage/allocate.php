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
                    <form class="search-form">
                        <label>家长名称
                            <input type="text" class="search-input" name="parent_name" value="{:I('parent_name')}" placeholder="请输入家长名称">
                        </label>
                        <label>家长电话
                            <input type="text" class="search-input" name="mobile_num" value="{:I('mobile_num')}" placeholder="请输入家长电话">
                        </label>
                        <label>宝宝名称
                            <input type="text" class="search-input" name="baby_name" value="{:I('baby_name')}" placeholder="请输入宝宝名称">
                        </label>
                        <label>开发状态
				<select name="status" class="search-input" >
					<option value="" >请选择</option>
					<option value="OK#" <?php echo $status=='OK##'?'selected':''?> >开发完成</option>
					<option value="FLS" <?php echo $status=='FLS'?'selected':''?> >开发失败</option>
					<option value="CRT" <?php echo $status=='CRT'?'selected':''?> >待开发</option>
				</select>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('allocate')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
                </div>
            </div>
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
                    <th class="row-selected center">
                       <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                       </label>
                    </th>
					<th class="">家长姓名</th>
					<th class="">家长电话</th>
					<th class="">宝宝名称</th>
					<th class="hidden-480 hidden-sm hidden-xs">宝宝性别</th>
					<th class="hidden-480 hidden-sm hidden-xs">宝宝生日</th>
					<th class="hidden-480 hidden-sm hidden-xs">所在城市</th>
					<th class="hidden-sm hidden-xs">所在区域</th>
					<th class="hidden-sm hidden-xs">用户级别</th>
					<th class="hidden-480 hidden-sm hidden-xs">星数</th>
					<th class="hidden-sm hidden-xs">开发状态</th>
					<th class="hidden-sm hidden-xs">业务员</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
                        <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td>{$vo.parent_name} </td>
						<td><a href="{:U('Custommanage/allocateinfo?id='.$vo['id'])}">{$vo.mobile_num}</a></td>
						<td>{$vo.baby_name}</td>
						<td class="hidden-480 hidden-sm hidden-xs"><?php echo $sex[$vo['baby_sex']];?></td>
						<td class="hidden-480 hidden-sm hidden-xs">{$vo.baby_birthday}</td>
						<td class="hidden-480 hidden-sm hidden-xs">{$vo.city}</td>
						<td class="hidden-sm hidden-xs">{$vo.district}</td>
						<td class="hidden-sm hidden-xs">{$vo.level}</td>
						<td class="hidden-480 hidden-sm hidden-xs">{$vo.star}</td>
						<td class="hidden-sm hidden-xs"><?php echo  $status[$vo['status']];?></td>
						<td class="hidden-sm hidden-xs">{$vo.username}</td>
						<td>
                            <?php if($vo['status']=='CRT'){?>
                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                <a href="<?php echo U('Custommanage/allocateinfo?id='.$vo['id'])?>" >调配</a>
                                |
                                <a href="<?php echo U('Custommanage/setStatus?type=F&id='.$vo['id'])?>" class="ajax-get confirm " >
                                    开发失败
                                </a>
                                |
                                <a href="<?php echo U('Custommanage/setStatus?type=S&id='.$vo['id'])?>" class="ajax-get confirm" >
                                    开发完成
                                </a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="inline position-relative">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="<?php echo U('Custommanage/allocateinfo?id='.$vo['id'])?>" >调配</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo U('Custommanage/setStatus?type=F&id='.$vo['id'])?>" class="ajax-get confirm " >
                                                开发失败
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo U('Custommanage/setStatus?type=S&id='.$vo['id'])?>" class="ajax-get confirm" >
                                                开发完成
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php }?>
						</td>
					</tr>
					</volist>
					<else/>
					<td colspan="11" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
            </table>

            <div class="row">
                <div class="col-sm-4">
                    <button type="button" id="batch-allocate-btn" class="btn btn-sm btn-pink">
                        <i class="icon-beaker"></i>批量调配
                    </button>
                </div>
                <div class="col-sm-8">
                    <div class="dataTables_paginate paging_bootstrap">
                        <ul class="pagination">
                            {$_page}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</block>

<block name="script">
	<script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

    <script src="__ACE__/js/chosen.jquery.min.js"></script>
	<script type="text/javascript">
    //导航高亮
    highlight_subnav('{:U('custommanage/allocate')}');

    var _box_html = '<div style=" padding: 15px;">' +
        '<select name="yewuyuan" id="yewuyuan">';
        $.each(<?=json_encode($assi)?>, function (k,v) {
            _box_html += '<option value="'+k+'">'+v+'</option>'
        })
        _box_html += '</select>' +
        '</div>';

    function show_box(){
        var data = $(".ids:checked").serializeArray();

        if(data.length == 0){

            layer.alert('请选择要批量处理的数据！',{icon:2});
            return false;
        }

        //页面层
        layer.open({
            type: 1,
            title:'您选择业务员',
            content: _box_html,
            btn: ['确认','取消'],
            yes: function(index, layero){
                //按钮【按钮一】的回调
                var assi_id = $.trim($("#yewuyuan").val());
                if(assi_id == ''){
                    layer.alert('请选择业务员！',{icon:2});
                    return false;
                }
                var $this = $(this);
                $this.prop('disabled',true);
                data.push({name:'assi_id',value:assi_id});

                $.post('<?=U('custommanage/batchalloca')?>',data,function(resp){
                    if(resp.status == 1){
                        layer.alert(resp.info,{icon:1},function(ii){
                            layer.close(ii);
                            window.location = window.location;
                        });
                        layer.close(index);
                    }else{
                        layer.alert(resp.info,{icon:2});
                    }
                },'json').always(function(){
                    $this.prop('disabled',false);
                });
            },
            cancel: function(index){
                //按钮【按钮二】的回调
            },
            success: function () {
                $("#yewuyuan").chosen();
                $(".layui-layer-content").css({'overflow':'visible'});
            }
        });
        return false;
    }

    $("#batch-allocate-btn").click(show_box);
	</script>
</block>
<block name="style">
    <link rel="stylesheet" href="__ACE__/css/chosen.css" />
</block>