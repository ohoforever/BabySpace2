<!--main-->
<section class="main padb312" style="padding-top: 0px;">
    <div class="ban2 swiper-container">
        <div class="swiper-wrapper">
            <?php foreach($banners as $banner):?>
            <div class="swiper-slide">
                <a href="<?=empty($banner['url']) ? '/banner/detail/id/'.$banner['id'].'.html' : $banner['url']?>">
                    <img class="img" src="<?=imageView2($banner['pic'],640,291)?>">
                </a>
            </div>
            <?php endforeach;?>
        </div>
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="ico swiper-button-next"></div>
        <div class="ico swiper-button-prev"></div>
    </div>
    <!--ban-end-->
    <div class="class-list">
        <ul>
            <?php
            $class_list = ['bg-red','bg-blue'];
            foreach($wonderfulLs as $key=>$item):
            ?>
            <li class="<?=$class_list[$key%2]?>">
                <div class="class-list-tit clear">
                    <span class="left"><?=$item['title']?></span>
                    <a href="javascript:;" class="right zan <?=$item['isUserLike'] ? 'on' : ''?>" item_id="<?=$item['recordId']?>"><i class="ico i-heart"></i> <span class="num"><?=$item['likeNum']?></span></a>
                </div>
                <div class="lesson-pic">
                    <a href="/wonderfulL/detail/id/<?=$item['recordId']?>.html">
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
        </ul>
    </div>
</section>

<div class="free"><a href="/index/bespeak.html" ><img src="/images/free.png" class="img"></a></div>
<footer class="footer clear">
    <a href="/">
        <i class="ico footnav1"></i>
        <p>首 页</p>
    </a>
    <a href="/baby/space/index.html">
        <i class="ico footnav2"></i>
        <p>宝宝空间</p>
    </a>
    <a href="/faq/index.html">
        <i class="ico footnav3"></i>
        <p>宝宝问答</p>
    </a>
    <a href="/">
        <i class="ico footnav4"></i>
        <p>全优加课程</p>
    </a>
</footer>
<block name="script">
<script type="text/javascript" src="/js/swiper.min.js"></script>
<script type="text/javascript">
    $(function() {
        var swiper = new Swiper('.ban2', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 30,
            autoplay:3000,
            loop: true
        });

    })
</script>
</block>
<block name="style">
    <link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
</block>