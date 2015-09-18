<extend name="Public/base" />
<block name="body">

<div class="col-sm-12">
	<div class="tabbable">
	    <ul class="nav nav-tabs padding-18">
            <li class="active">
                <a data-toggle="tab" href="#addressdetail">
                    <span class="blue icon-asterisk "></span> 收货信息
                </a>
            </li>
	        <li>
                <a data-toggle="tab" href="#orderdetail">
                    <i class="green icon-bar-chart"></i> 订单信息
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#productsdetail">
                    <span class="blue icon-gift "></span> 订单商品
                </a>
            </li>
	    </ul>
	    <div class="tab-content no-border padding-24">
	        <div id="addressdetail" class="tab-pane active">
	           <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name">收货人</div>
                                <div class="profile-info-value">
                                    <div class="inline"><?php echo $item['consignee']?></div>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">联系电话</div>
                                <div class="profile-info-value">
                                    <div class="inline"><?php echo $item['mobile']?></div>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">身份证号</div>
                                <div class="profile-info-value">
                                    <div class="inline"><?php echo $item['idnum']?></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
	        </div>
	        <div id="orderdetail" class="tab-pane">
		    <?php 
		        echo ace_form_open();
                echo form_hidden('sn',$item['sn']);
                echo ace_group(ace_label('订单号'),'<div class="line-height-2 blue">'.$item['sn'].'</div>');
                echo ace_group(ace_label('购买用户ID'),'<div class="line-height-2 blue">'.$item['userid'].'</div>');
                echo ace_group(ace_label('购买用户'),'<div class="line-height-2 blue">'.$item['nickname'].'</div>');
                echo ace_group(ace_label('创建时间'),'<div class="line-height-2 blue">'.$item['create_time'].'</div>');
                echo ace_group(ace_label('订单金额'),'<div class="line-height-2 blue">'.price_format($item['amount']).'</div>');
                echo ace_group(ace_label('订单状态'),'<div class="line-height-2 blue">'.\Common\Service\OrdersService::$status_text[$item['status']].'</div>');
                echo ace_group(ace_label('付款状态'),'<div class="line-height-2 blue">'.\Common\Service\OrdersService::$pay_status_text[$item['pay_status']].'</div>');
                echo ace_group(ace_label('付款时间'),'<div class="line-height-2 blue">'.$item['pay_time'].'</div>');

                if($item['status'] == \Common\Service\OrdersService::STATUS_WATI_PAY && $item['pay_status'] == \Common\Service\OrdersService::PAY_STATUS_NO_PAY){
                	
                    $data = array('label_text'=>'修改付款状态','help'=>'未付款订单，可直接修改订单付款状态');
                    $options = array(
                                    ''=>'--请选择--',
                                    \Common\Service\OrdersService::PAY_STATUS_PAYD=>'已付款',
                                );
                    echo ace_dropdown($data,'pay_status',$options);
                }

                echo ace_group(ace_label('备注'),'<div class="line-height-2 blue">'.$item['remark'].'</div>');
                echo ace_srbtn();
                echo ace_form_close()
            ?>
	        </div>
	        
	        <div id="productsdetail" class="tab-pane">
	           <div class="row">
                    <!-- 数据列表 -->
                    <table class="table table-striped table-bordered table-hover dataTable">
        			    <thead>
        			        <tr>
        					<th class="">商品名称</th>
        					<th class="">购买单价</th>
        					<th class="">购买数量</th>
        					<th class="">小计</th>
        					</tr>
        			    </thead>
        			    <tbody>
        					<?php foreach ($item['products'] as $product):?>
        					<tr>
        						<td><a target="_blank" href="http://ttjy.mi360.me/product/detail/goods_id/<?=$product['product_id']?>.html"><?php echo $product['product_name']?></a></td>
        						<td><?php echo price_format($product['price'])?></td>
        						<td><?php echo $product['num']?></td>
        						<td><span><?php echo price_format($product['priceall'])?></span></td>
        					</tr>
        					<?php endforeach;?>
        				</tbody>
                    </table>
                </div>
	        </div>
	    </div>
	</div>
</div>
</block>

<block name="script">
<script type="text/javascript">
    //导航高亮
    highlight_subnav('{:U('orders/index')}');
</script>
</block>