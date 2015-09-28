<!--main-->
<section class="scroll">
    <!--lesson-->
    <div class="timeline padt40">
        <?php
            $year = date('Y');
            $class_list = ['bg-red','bg-blue'];
        ?>
        <?php foreach($list as $key=>$item):?>
        <div class="table lesson-box">
            <div class="cell date-cont">
                <span class="date">
                    <?php
                        if(date('Y') == $year){
                            echo date('m.d',strtotime($item['matrueDate']));
                        }else{
                            echo date('Y.m.d',strtotime($item['matrueDate']));
                        }
                    ?>
                </span>
            </div>
            <div class="cell lesson <?=$class_list[$key%2]?>">
                <div class="lesson-tit"><?=$item['title']?></div>
                <div class="pad10 lesson-info">
                    <div class="lesson-pic">
                        <a href="/index/index/growthtime/id/<?=$item['matureId']?>.html" >
                            <div class="table">

                            <?php if(!empty($item['images'])):?>

                                <div class="cell lesson-img">
                                    <img src="<?=imageView2($item['images'][0],235,235)?>" class="img">
                                </div>
                                <?php if(isset($item['images'][1])):?>
                                <div class="cell lesson-img">
                                    <img src="<?=imageView2($item['images'][1],235,235)?>" class="img">
                                </div>
                                <?php endif;?>

                            <?php else:?>
                                <div class="cell">
                                    <?=$item['determine']?>
                                </div>
                            <?php endif;?>
                                <div class="cell lesson-arrbox">
                                    <i class="ico i-arr-right2"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="clear comments-box">
							<span class="left flower-box">
								<i class="ico i-flower <?=($item['redflower'] > 0) ? 'on' : ''?>"></i>
                                <i class="ico i-flower <?=($item['redflower'] > 1) ? 'on' : ''?>"></i>
								<i class="ico i-flower <?=($item['redflower'] > 2) ? 'on' : ''?>"></i>
                                <i class="ico i-flower <?=($item['redflower'] > 3) ? 'on' : ''?>"></i>
								<i class="ico i-flower <?=($item['redflower'] > 4) ? 'on' : ''?>"></i>
							</span>
                        <div class="right">
                            <a href="javascript:;" data-toggle="share-btn" item_id="<?=$item['matureId']?>"><i class="ico i-share"></i></a>
                            <a href="javascript:;" data-toggle="comment" item_id="<?=$item['matureId']?>"><i class="ico i-comments"></i> <?=count($item['comment'])?></a>
                        </div>
                    </div>

                    <?php if(!empty($item['images'])):?>
                    <p class=""><?=$item['determine']?></p>
                    <?php endif;?>
                    <?php if($item['comment']):?>
                    <div class="comments-cont" id="comment-cont<?=$item['matureId']?>">
                        <?php foreach($item['comment'] as $comment):?>
                        <p senderId="<?=$comment['senderId']?>" item_id="<?=$item['matureId']?>" reply_to="<?=$item['senderId']?>" sender="<?=$comment['sender']?>">
                            <strong class="color1"><?=$comment['sender']?></strong>：<?=$comment['content']?>
                        </p>
                        <?php endforeach;?>
                    </div>
                    <?php endif;?>

                </div>
            </div>
        </div>
        <!--lesson-->
        <?php endforeach;?>
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
        $(document).on("click", '[data-toggle="comment"],.comments-cont p', function() {
            $("#item_id").val($(this).attr('item_id'));
            var sender = $(this).attr('sender');
            if(sender != null){
                $("#comment-content").attr('placeholder','回复'+sender);
            }
            $(".reply").show();
            $(".reply .input2").focus();
        });


        var data_list = <?php echo json_encode($list);?>;

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
                    show_success('评论成功！');
                }else{
                    show_error(resp.msg);
                }
            })
            $(".reply").hide();
        });

        $(document).ready(function(){

            $(document).on("click", '[data-toggle="share-btn"]', function() {
                var item_id = $(this).attr('item_id');
                $.each(data_list,function(k,item){
                    if(item.matureId == item_id){
                        shareData.title = item.shareTitle;
                        shareData.link = '<?=DOMAIN?>/index/index/growthtime/id/'+item_id+'.html'
                        shareData.desc = item.shareContent;
                        shareData.imgUrl = item.sharePic || '<?=DOMAIN?>/images/logo.jpg';

                        shareTimeLineData.link = shareData.link;
                        shareTimeLineData.title = shareData.desc;
                        shareTimeLineData.imgUrl = shareData.imgUrl;
                    }
                })
            })
            $('.J_closeOrder').css('margin-right','10px');
        });
    </script>
</block>
