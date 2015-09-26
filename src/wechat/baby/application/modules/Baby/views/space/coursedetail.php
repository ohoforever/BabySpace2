<!--main-->
<section class="main hei100">
    <div class="timeline padt40" id="item-wrap">
        <?php
        require_once 'ajaxCourse.php';
        ?>
    </div>
    <input type="hidden" id="page" value="<?=$pageIndex?>" />
    <input type="hidden" id="surplus" value="<?=$total-count($list)?>" />
</section>
<block name="script">
    <script src="/js/scroll.page.js"></script>
</block>