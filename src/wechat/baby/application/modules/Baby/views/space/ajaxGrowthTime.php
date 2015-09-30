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
                        <a href="javascript:;" data-toggle="share-btn" item_id="<?=$item['matureId']?>" share_title="<?=$item['shareTitle']?>" share_content="<?=$item['shareContent']?>" share_pic="<?=$item['sharePic']?>"><i class="ico i-share"></i></a>
                        <a href="javascript:;" data-toggle="comment" item_id="<?=$item['matureId']?>"><i class="ico i-comments"></i> <?=count($item['comment'])?></a>
                    </div>
                </div>

                <?php if(!empty($item['images'])):?>
                    <p class=""><?=$item['determine']?></p>
                <?php endif;?>
                <?php if($item['comment']):?>
                    <div class="comments-cont" id="comment-cont<?=$item['matureId']?>">
                        <?php foreach($item['comment'] as $comment):?>
                            <p senderId="<?=$comment['senderId']?>" item_id="<?=$item['matureId']?>" reply_to="<?=$comment['senderId']?>" sender="<?=$comment['sender']?>">
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