<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="format-detection" content="telephone=no"/>
    <title>全优加<?=empty($meta_title) ? '' : '|' ?><?=$meta_title?></title>
    <link rel="stylesheet" type="text/css" href="/css/reset.css?<?=md5_file('css/reset.css')?>"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css?<?=md5_file('css/main.css')?>"/>
    <?php if(isset($block['style'])) echo $block['style']; ?>
</head>

<body>
<?php if(isset($title)):?>
<!--header-->
<header>
    <a href="javascript:history.go(-1);" class="head-left padm15"><i class="ico i-arr-left"></i> 返回</a>
    <p class="head-txt"><?=$title?></p>
</header>
<?php endif;?>

<?php echo $content?>
<?php if(isset($block['alert'])) echo $block['alert']; ?>
<div class="error-box" id="error-box">
    <div class="error-body">
        <p id="alert-content">
        </p>
        <a href="javascript:;" class="btn1 close-box" id="close-alert-btn"></a>
    </div>
</div>
<!--脚本加载-->
<script type="text/javascript" src="/js/jquery.js?<?=md5_file('js/jquery.js')?>"></script>
<script type="text/javascript" src="/js/common.js?<?=md5_file('js/common.js')?>"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    wx.config({
        appId: '<?php echo $js_sign['appid']?>',
        timestamp: <?php echo $js_sign['timestamp']?>,
        nonceStr: '<?php echo $js_sign['noncestr']?>',
        signature: '<?php echo $js_sign['signature']?>',
        jsApiList: [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo'
        ]
    });

    var shareData = {
        title: '全优加',
        desc: '专注0-3岁的宝宝潜能开发，引领中国早期教育行业专业标准',
        link: window.location,
        imgUrl: '/images/logo.jpg',
        fail: function (res) {
            alert(JSON.stringify(res));
        }
    };

    var shareTimeLineData = {
        title: '专注0-3岁的宝宝潜能开发，引领中国早期教育行业专业标准',
        link: window.location,
        imgUrl: '/images/logo.jpg',
        fail: function (res) {
            alert(JSON.stringify(res));
        }
    };
    wx.ready(function () {

        wx.onMenuShareAppMessage(shareData);
        wx.onMenuShareTimeline(shareTimeLineData);
        wx.onMenuShareQQ(shareData);
        wx.onMenuShareWeibo(shareData);
    });

    wx.error(function (res) {
        alert('wx.error: '+JSON.stringify(res));
    });
</script>
<?php if(isset($block['script'])) echo $block['script']; ?>
</body>
</html>