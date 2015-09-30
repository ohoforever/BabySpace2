<!--main-->
<?php if(empty($list)):?>
<section class="main">
    <div class="padm54 padt40 padb90">
        <div class="class-sure-tit">老师还没有为您的宝宝添加成长时光！</div>
    </div>
</section>
<?php else:?>
<section class="main">
    <!--lesson-->
    <div class="timeline padt40" id="item-wrap">
        <?php
        require_once 'ajaxGrowthTime.php';
        ?>
        <input type="hidden" id="page" value="<?=$pageIndex?>" />
        <input type="hidden" id="surplus" value="<?=$total-count($list)?>" />
    </div>
</section>
<div class="reply">
    <div class="table">
        <div class="cell"><input type="text" id="comment-content" placeholder="评论" class="input2"></div>
        <div class="cell reply-btncont">
            <input type="hidden" name="item_id" id="item_id" />
            <input type="hidden" name="reply_to" id="reply_to" />
            <input type="submit" value="发送" class="btn1" data-toggle="close-reply">
        </div>
    </div>
</div>
<block name="script">
    <script>
        //comment
        $(document).ready(function(){

            $(document).on("click", '[data-toggle="comment"],.comments-cont p', function() {
                $("#item_id").val($(this).attr('item_id'));
                var sender = $(this).attr('sender');
                if(sender != null){
                    $("#comment-content").attr('placeholder','回复'+sender);
                }
                $(".reply").show();
                $(".reply .input2").focus();
            });

            $(document).on("click", '[data-toggle="close-reply"]', function() {

                var content = $.trim($("#comment-content").val());
                if(content == ''){
                    show_error('请填写评论内容！');
                    return false;
                }
                var item_id = $("#item_id").val();
                var reply_to = $("#reply_to").val();
                $.post('/baby/space/comment.html',{item_id:item_id,content:content,reply_to:reply_to},function(resp){
                    if(resp.status == '0'){
                        show_success('评论成功！')
                        setTimeout(function () {
                            window.location = window.location;
                        },1000)
                    }else{
                        show_error(resp.msg);
                    }
                })
                $(".reply").hide();
            });

            $(document).on("click", '[data-toggle="share-btn"]', function() {
                var $this = $(this);
                var item_id = $this.attr('item_id');
                var share_content = $this.attr('share_content');
                var share_title = $this.attr('share_title');
                var share_pic = $this.attr('share_pic');

                shareData.title = share_title;
                shareData.link = '<?=DOMAIN?>/index/index/growthtime/id/'+item_id+'.html'
                shareData.desc = share_content;
                shareData.imgUrl = share_pic || '<?=DOMAIN?>/images/logo.jpg';

                shareTimeLineData.link = shareData.link;
                shareTimeLineData.title = share_title;
                shareTimeLineData.imgUrl = share_pic;
            });

        });
    </script>
    <script src="/js/scroll.page.js"></script>
</block>
<?php endif;?>