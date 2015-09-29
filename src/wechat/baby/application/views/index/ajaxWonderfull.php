<?php
$class_list = ['bg-red','bg-blue'];
foreach($wonderfulLs as $key=>$item):
    ?>
    <li class="<?=$class_list[$key%2]?>">
        <div class="class-list-tit clear">
            <span class="left"><?=subtext($item['title'],12)?></span>
            <a href="javascript:;" class="right zan <?=$item['isUserLike'] ? 'on' : ''?>" item_id="<?=$item['recordId']?>"><i class="ico i-heart"></i> <span class="num"><?=$item['likeNum']?></span></a>
        </div>
        <div class="lesson-pic">
            <a href="/wonderfull/detail/id/<?=$item['recordId']?>.html">
                <div class=" table">
                    <div class="cell lesson-img">
                        <img src="<?=imageView2($item['pic'][0],235,235)?>" class="img">
                    </div>
                    <?php if(isset($item['pic'][1])):?>
                        <div class="cell lesson-img">
                            <img src="<?=imageView2($item['pic'][1],235,235)?>" class="img">
                        </div>
                    <?php endif;?>
                    <div class="cell lesson-arrbox">
                        <i class="ico i-arr-right2"></i>
                    </div>
                </div>
            </a>
        </div>
    </li>
<?php endforeach;?>