<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>用户昵称
                            <input type="text" class="search-input" name="nickname" value="{:I('nickname')}" />
                        </label>
                        <label>订单号
                            <input type="text" class="search-input" name="sn" value="{:I('sn')}" />
                        </label>
                        <label>状态：
                            <?php
                            echo form_dropdown('status',[''=>'--请选择--']+\Common\Service\OrdersService::$status_text,I('status'));
                            ?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('index')}">
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
					<th class="">订单编号</th>
					<th class="">用户</th>
					<th class="">金额</th>
					<th class="">商品数量</th>
					<th class="">创建时间</th>
					<th class="">IP</th>
					<th class="">状态</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<?php if(empty($_list)):?>
					<tr>
					<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
					</tr>
					<?php else:?>
					<?php foreach ($_list as $item):?>
					<tr>
                        <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="<?php echo $item['id']?>" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td><?php echo $item['sn']?> </td>
						<td><a href="<?php echo U('user/dtwechat',array('userid'=>$item['userid']))?>"><?php echo $item['nickname']?></a></td>
						<td><?php echo price_format($item['amount'])?></td>
						<td><?php echo $item['count_num']?></td>
						<td><span><?php echo $item['create_time']?></span></td>
						<td><span><?php echo $item['add_ip']?></span></td>
						<td><?php echo \Common\Service\OrdersService::$status_text[$item['status']]; ?></td>
						<td>
							<a href="<?php echo U('detail',array('sn'=>$item['sn'])) ?>">查看</a>
		                </td>
					</tr>
					<?php endforeach;?>
					<?php endif;?>
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
    highlight_subnav('{:U('User/index')}');
	</script>
</block>
