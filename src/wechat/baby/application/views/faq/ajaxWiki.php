<?php foreach($list as $item):?>
    <li>
        <a href="/faq/wikiDetail/id/<?=$item['id']?>.html">
            <div class="ask-date blue"><?=$item['title']?></div>
            <div class="ask-cont">
                <?=$item['describe']?>
            </div>
        </a>
    </li>
<?php endforeach;?>