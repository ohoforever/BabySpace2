<!--main-->
<section class="main">

    <div class="ban1 swiper-container">
        <div class="swiper-wrapper">
            <?php foreach($item['images'] as $pic):?>
            <div class="swiper-slide"> <img class="img" src="<?=imageView2($pic,640,597)?>"> </div>
            <?php endforeach;?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="share-tips">
        <p class="share-txt">
            <?=$item['determine']?>
        </p>
        <div class="share-btn"><a href="javascript:;" class="btn1" data-toggle="share-btn">分享</a></div>
    </div>
</section>
<block name="script">
    <script type="text/javascript" src="/js/swiper.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var mySwiper = new Swiper('.ban1',{
                loop: true,
                speed:800,
                autoplay: 3000,
                pagination: '.swiper-pagination',
                paginationClickable: true
            });
            
            shareData = {
                title: '<?=$item['shareTitle']?>',
                desc: '<?=$item['shareContent']?>',
                link: window.location.href,
                imgUrl: '<?=(empty($item['sharePic']) ? DOMAIN.'/images/logo.jpg' : $item['sharePic'])?>',
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            };

            shareTimeLineData = {
                title: '<?=$item['shareContent']?>',
                link: window.location.href,
                imgUrl: '<?=(empty($item['sharePic']) ? DOMAIN.'/images/logo.jpg' : $item['sharePic'])?>',
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            };
        })
    </script>
</block>
<block name="style">
    <link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
</block>