<!--main-->
<section class="main padb110">
    <div class="swiper-container ppic">
        <div class="swiper-wrapper">
            <?php foreach($item['pic'] as $pic):?>
            <div class="swiper-slide"><img src="<?=imageView2($pic,489,376)?>" class="img" ></div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="class-info">
        <div class="info-tit"><?=$item['title']?></div>
        <?=$item['content']?>
    </div>
</section>
<div class="footbar clear">
    <a href="javascript:" class="zan <?=$item['isUserLike'] ? 'on' : ''?>" item_id="<?=$item['recordId']?>">
        <i class="ico i-heart2"></i>
        <span class="num"><?=$item['likeNum']?></span>
    </a>
    <a href="javascript:;" data-toggle="share-btn" ><i class="ico i-share2"></i></a>
</div>

<block name="script">
    <script type="text/javascript" src="/js/swiper.min.js"></script>
    <script type="text/javascript">
        $(function(){
            var swiper = new Swiper('.ppic', {
                slidesPerView: 'auto',
                watchSlidesProgress: !0,
                speed:800,
                centeredSlides: true,
                onProgress: function(a) {
                    var b, c, d;
                    for (b = 0; b < a.slides.length; b++) c = a.slides[b], d = c.progress, scale = 1 - Math.min(Math.abs(.2 * d), 1), es = c.style, es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = "translate3d(0px,0," + -Math.abs(150 * d) + "px)"
                },
                onSetTransition: function(a, b) {
                    for (var c = 0; c < a.slides.length; c++) es = a.slides[c].style, es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = b + "ms"
                }
            });
        })
    </script>
</block>
<block name="style">
    <link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
    <style>
        .class-info img{ width: 100%;}
    </style>
</block>