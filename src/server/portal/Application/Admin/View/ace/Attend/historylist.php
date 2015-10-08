<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  

            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
					<th class="hidden-480">订单号</th>
					<th class="">宝宝姓名</th>
					<th class="hidden-480">年龄（月）</th>
					<th class="">耗课课时</th>
					<th class="">剩余课时</th>
					<th class="">耗课时间</th>
					<th class="hidden-480">课程名称</th>
					<th class="hidden-480">学校名称</th>
					</tr>
			    </thead>
			    <tbody>
                    <?php $today = date('Y-m-d');?>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
						<td class="hidden-480"><?=$vo['order_id']?> </td>
						<td><?=$vo['baby_name']?></td>
						<td class="hidden-480"><?=getMonthNum($today,$vo['baby_birthday'])?></td>
						<td><?=$vo['course_count']?></td>
						<td><?=$vo['left_course_count']?></td>
						<td><?=$vo['act_time']?></td>
						<td class="hidden-480"><?=$vo['classname']?></td>
						<td class="hidden-480"><?=$vo['school_name']?></td>
					</tr>
					</volist>
					<else/>
					<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
            </table>
            <include file="Public/page"/>
        </div>
		<div class="clearfix form-actions">
            <div class="col-xs-12 center">
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
	               <i class="icon-reply"></i>返回上一页
	            </a>  
            </div>
        </div>
    </div>
</block>

<block name="script">
	<script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

	<script type="text/javascript">
    //导航高亮
    highlight_subnav('{:U('attend/index')}');
	</script>
</block>
