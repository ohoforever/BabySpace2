<!--main-->
<section class="main">
    <div class="padm54 padt60">
        <?php foreach($list as $item):?>
        <form class="class-sure ajax-form" action="/scan/doAttend.html" method="post">
            <div class="class-sure-tit">耗课确认</div>
            <div class="class-sure-txt">
                <p>
                    宝宝名字：<?=$item['babyName']?><br>
                    课程名称：<?=$item['courseName']?><br>
                    耗课：<?=$item['courseNum']?>节<br>
                    时间：<?=date('Y-m-d H:i:s')?>
                </p>
            </div>
            <div class="class-sure-btn">
                <div class="cell btn">
                    <input type="hidden" name="childId" value="<?=$item['childId']?>" />
                    <input type="hidden" name="courseName" value="<?=$item['courseName']?>" />
                    <input type="hidden" name="courseNum" value="<?=$item['courseNum']?>" />
                    <input type="hidden" name="orderId" value="<?=$item['orderId']?>" />
                    <button type="submit" class="btn3">确认</button>
                </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</section>