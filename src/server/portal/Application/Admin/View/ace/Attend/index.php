<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  

            <?php if(I('order_id') == ''):?>
            <div class="row">
                <form class="search-form">
                    <div class="col-sm-12">
                        <label>宝宝姓名
                            <input type="text" class="search-input" name="baby_name" value="<?=I('baby_name')?>">
                        </label>
                        <label>宝宝年龄
                            <input type="text" class="search-input" name="baby_age" value="<?=I('baby_age')?>" placeholder="单位：月">
                        </label>
                    </div>
                    <div class="col-sm-12">
                        <label>课程名称
                            <input type="text" class="search-input" name="classname" value="<?=I('classname')?>">
                        </label>
                        <label>学校名称
                            <input type="text" class="search-input" name="school_name" value="<?=I('school_name')?>">
                        </label>
                        <label>耗课月份
                            <?php
                            $month_list = [
                                0=>'--请选择月份--',
                                '01'=>'一月',
                                '02'=>'二月',
                                '03'=>'三月',
                                '04'=>'四月',
                                '05'=>'五月',
                                '06'=>'六月',
                                '07'=>'七月',
                                '08'=>'八月',
                                '09'=>'九月',
                                '10'=>'十月',
                                '11'=>'十一月',
                                '12'=>'十二月',
                            ];
                            echo form_dropdown('month',$month_list,I('month'));
                            ?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="<?=U('index')?>">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>
                </form>
            </div>
            <?php endif;?>
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
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
                    <?php $today = date('Y-m-d');?>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
						<td class="hidden-480"><a href="<?=U('index',array('order_id'=>$vo['order_id']))?>"><?=$vo['order_id']?> </td>
						<td><?=$vo['baby_name']?></td>
						<td class="hidden-480"><?=getMonthNum($today,$vo['baby_birthday'])?></td>
						<td><?=$vo['course_count']?></td>
						<td><?=$vo['left_course_count']?></td>
						<td><?=$vo['act_time']?></td>
						<td class="hidden-480"><?=$vo['classname']?></td>
						<td class="hidden-480"><?=$vo['school_name']?></td>
						<td>
                            <a href="<?=U('index',array('order_id'=>$vo['order_id']))?>">耗课历史</a> |
                            <a href="<?=U('edit',array('id'=>$vo['id']))?>">修改</a> |
                            <a class="ajax-get confirm" href="<?=U('delete',array('id'=>$vo['id']))?>">删除</a>
	                   </td>
					</tr>
					</volist>
					<else/>
					<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
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
    //导航高亮
    highlight_subnav('{:U('attend/index')}');
	</script>
</block>
