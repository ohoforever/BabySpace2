<?php foreach($list as $item):?>
    <li>
        <a href="javascript:">
            <div class="ask-date"><?=$item['questionTime']?></div>
            <div class="ask-cont">

                <div class="blue desc" style="line-height: 23px;">
                    <p>问：<?=$item['title']?></p>
                    &nbsp; &nbsp; &nbsp; &nbsp;<?=$item['desc']?>
                </div>
                <div class="clear">
                    <div class="left wid60">答：</div>
                    <div class="auto"><?=$item['answer']?></div>
                </div>
            </div>
        </a>
    </li>
<?php endforeach;?>