<!--main-->
<section class="main">
    <div class="padm54 padt40">
        <div class="ask-list">
            <ul>
                <?php foreach($list as $item):?>
                <li>
                    <div class="ask-date"><span class="right"><?=date('Y-m-d',strtotime($item['updateTime']))?></span><?=$item['orderId']?></div>
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