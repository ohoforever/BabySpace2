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
            <ul id="item-wrap">
                <?php require_once 'ajaxWiki.php';?>
            </ul>
            <input type="hidden" id="page" value="<?=$pageIndex?>" />
            <input type="hidden" id="surplus" value="<?=$total-count($list)?>" />
        </div>
    </div>
</section>
<block name="script">
    <script src="/js/scroll.page.js"></script>
</block>