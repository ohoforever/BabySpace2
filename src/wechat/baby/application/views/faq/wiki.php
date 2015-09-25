<!--main-->
<section class="main">
    <div class="padm54">
        <div class="search-cont">
            <form action="/faq/wiki.html" method="get">
            <div class="table">
                <div class="cell">
                    <input type="text" name="keyword" class="input1" value="<?=$keyword?>" placeholder="搜索">
                </div>
                <div class="cell search-btncont">
                    <input type="submit"  class="search-btn" value="搜索">
                </div>
            </div>
            </form>
        </div>
        <div class="ask-list">
            <ul>
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
            </ul>
        </div>
    </div>
</section>