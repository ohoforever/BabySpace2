<!--main-->
<section class="main">
    <div class="padm54 padt40 padb90">
        <div class="ask-list">
            <?php if(is_array($list) && count($list) > 0):?>
            <ul>
                <?php foreach($list as $item):?>
                <li>
                    <a href="javascript:">
                        <div class="ask-date"><?=$item['questionTime']?></div>
                        <div class="ask-cont">
                            <p class="blue">问：<?=$item['title']?></p>
                            <div class="clear">
                                <div class="left wid60">答：</div>
                                <div class="auto"><?=$item['answer']?></div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
            <?php else:?>
                <div class="class-sure-tit">您还没有问题，请点击下面的提问按钮进行提问！</div>
            <?php endif;?>
        </div>
    </div>
</section>

<div class="ask-cont-btn">
    <a href="/faq/ask.html" class="ask-btn">立即问</a>
</div>