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
        <?php if(empty($list)):?>
        <div class="class-sure-tit">没有找到与“<?=$keyword?>”相匹配的数据！</div>
        <?php else:?>
        <div class="ask-list">
            <ul id="item-wrap">
                <?php require_once 'ajaxWiki.php';?>
            </ul>
            <input type="hidden" id="page" value="<?=$pageIndex?>" />
            <input type="hidden" id="surplus" value="<?=$total-count($list)?>" />
            <block name="script">
                <script src="/js/scroll.page.js"></script>
            </block>
        </div>
        <?php endif;?>
    </div>
</section>