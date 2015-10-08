<!--main-->
<section class="main">

    <div class="padm54 padt40">
        <?php if(empty($list)):?>
            <div class="class-sure-tit">您目前还没有课程，请先购买！</div>
        <?php endif;?>
        <div class="ask-list">
            <ul>
                <?php foreach($list as $item):?>
                <li>
                    <div class="ask-date">
                        <div><?=date('Y-m-d',strtotime($item['updateTime']))?></div>
                        <div><?=$item['orderId']?></div>
                    </div>
                    <div class="ask-cont">
                        <p class="txt1"><?=$item['courseName']?></p>
                        <p class="blue txt2">剩余<?=$item['courseCount']?>节课</p>
                        <div class="btn4-cont"><a href="/baby/space/courseDetail/order_id/<?=$item['orderId']?>.html" class="btn4">耗课历史</a></div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</section>