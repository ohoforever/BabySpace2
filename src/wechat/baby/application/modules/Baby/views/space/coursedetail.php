<!--main-->
<section class="main hei100">

    <?php if(empty($list)):?>
    <div class="padm54 padt40 padb90">
        <div class="class-sure-tit">当前课程还没有耗课历史记录！</div>
    </div>
    <?php else:?>
    <div class="timeline padt40" id="item-wrap">
    <?php
        require_once 'ajaxCourse.php';
    ?>
    </div>
    <input type="hidden" id="page" value="<?=$pageIndex?>" />
    <input type="hidden" id="surplus" value="<?=$total-count($list)?>" />

    <block name="script">
        <script src="/js/scroll.page.js"></script>
    </block>
    <?php endif;?>
</section>