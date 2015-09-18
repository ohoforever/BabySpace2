<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form method="get" action="__SELF__" class="search-form">
                        <label>
                            <a class="btn btn-sm btn-primary" href="{:U('gunadd',['oil_station_id'=>$osid])}"><i class="icon-plus"></i>新增</a>
                        </label>
                        <label>油品：
                            <?php
                            echo form_dropdown('oil_type_id',$ot_list,I('oil_type_id'));
                            ?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="<?=U('gas/gunlists',['osid'=>$osid])?>">
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
					<th class="">ID</th>
					<th class="">油枪号码</th>
					<th class="">油品</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
						<td>{$vo.id} </td>
						<td><a href="{:U('gunedit',array('id'=>$vo['id']))}">{$vo.gun_no}</a></td>
                        <td><?=$ot_list[$vo['oil_type_id']]?></td>
						<td>
                            <a href="{:U('gunedit?id='.$vo['id'])}">编辑</a>
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
	<script type="text/javascript">
    //导航高亮
    highlight_subnav('{:U('gas/stations')}');
	</script>
</block>
