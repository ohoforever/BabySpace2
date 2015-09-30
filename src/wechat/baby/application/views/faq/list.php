<!--main-->
<section class="main">
    <div class="padm54 padt40 padb90">
        <div class="ask-list">
            <?php if(is_array($list) && count($list) > 0):?>
            <ul id="item-wrap">
                <?php require_once 'ajaxFaq.php';?>
            </ul>
            <input type="hidden" id="page" value="<?=$pageIndex?>" />
            <input type="hidden" id="surplus" value="<?=$total-count($list)?>" />
            <block name="script">
                <script src="/js/scroll.page.js"></script>
            </block>
            <?php else:?>
                <div class="class-sure-tit">您还没有问题，请点击下面的提问按钮进行提问！</div>
            <?php endif;?>
        </div>
    </div>
</section>

<div class="ask-cont-btn">
    <a href="/faq/ask.html" class="ask-btn">立即问</a>
</div>