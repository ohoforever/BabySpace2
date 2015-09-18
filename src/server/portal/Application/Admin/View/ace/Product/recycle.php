<extend name="Public/base" />

<block name="body">

	<!-- 数据列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">  
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>
                            <button url="{:U('product/clear')}" class="btn btn-sm btn-primary ajax-get confirm">
                                <i class="icon-trash"></i>清 空
                            </button>
                        </label>
                        <label>
                            <button url="{:U('product/permit')}" class="btn btn-sm btn-success ajax-post ajax-post" target-form="ids">
                                <i class="icon-undo"></i>还 原
                            </button>
                        </label>
                    </div>  
                </div>
            </div>
            
            <table class="table table-striped table-bordered table-hover dataTable">
                <!-- 表头 -->
                <thead>
                    <tr>
            		<th class="row-selected row-selected">
            		    <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                        </label>
        		    </th>
            		<th class="">编号</th>
            		<th class="">产品名称</th>
            		<th class="">创建时间</th>
            		<th class="">删除时间</th>
            		<th class="">操作</th>
            		</tr>
                </thead>
                <tbody>
            		<volist name="list" id="vo">
            		<tr>
                        <td>
                            <label>
                                <input class="ace ids" type="checkbox" name="ids[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
            			<td>{$vo.id} </td>
            			<td>{$vo.name}</td>
            			<td><span>{$vo.create_time|time_format}</span></td>
            			<td><span>{$vo.update_time|time_format}</span></td>
            			<td><a href="{:U('product/permit?ids='.$vo['id'])}" class="ajax-get">还原</a>
                            </td>
            		</tr>
            		</volist>
            	</tbody>
            </table> 
            <include file="Public/page"/>
        </div>
    </div>
</block>
