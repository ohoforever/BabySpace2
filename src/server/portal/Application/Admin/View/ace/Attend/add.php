<extend name="Public/base" />

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">

            <div class="row">
                <form class="search-form">
                    <div class="col-sm-12">
                        <label>家长手机号码
                            <input type="text" class="search-input" name="mobile" value="<?=$mobile?>">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="<?=U('attend/add')?>">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>
                </form>
            </div>

            <div class="row">
                <?php if(!empty($mobile) && empty($list)){
                    echo '<div class="alert alert-block alert-success">没有找到手机号码'.$mobile.'相关的数据! </div>';
                }
                ?>
                <?php
                    $class_list = [
                        'header-color-red',
                        'header-color-blue',
                        'header-color-green',
                        'header-color-orange',
                        'header-color-dark',
                        'header-color-red2',
                        'header-color-pink',
                        'header-color-red3',
                    ];
                    $btn_class_list = [
                        'btn-danger',
                        'btn-primary',
                        'btn-success',
                        'btn-warning',
                        'btn-inverse',
                        'btn-grey',
                        'btn-grey',
                        'btn-grey',
                    ];
                    foreach($list as $key=>$item):?>
                <div class="col-xs-12 col-sm-6 col-md-4 pricing-box">
                    <div class="widget-box">
                        <div class="widget-header <?=$class_list[$key]?>">
                            <h5 class="bigger lighter"><?=$item['babyName']?></h5>
                        </div>

                        <form class="widget_form<?=$key?>" action="<?=U('add',['mobile'=>$mobile])?>" method="post">
                        <div class="widget-body">
                            <div class="widget-main">
                                <hr>
                                <ul class="list-unstyled spaced2">
                                    <li>
                                        订单号：
                                        <?=$item['orderId']?>
                                    </li>

                                    <li>
                                        课程名：
                                        <?=$item['courseName']?>
                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <label style="padding-top: 4px;">课时：</label>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" name="courseNum" value="1" class="width-100" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <label style="padding-top: 4px;">课程名：</label>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" name="courseName" value="" class="width-100" />
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <button class="confirm btn btn-block <?=$btn_class_list[$key]?> ajax-post no-refresh" type="submit" target-form="widget_form<?=$key?>">
                                    <i class="icon-shopping-cart bigger-110"></i>
                                    <span>确认耗课</span>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" value="<?=$item['childId']?>" name="childId" />
                        <input type="hidden" value="<?=$item['orderId']?>" name="orderId" />
                        </form>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
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
