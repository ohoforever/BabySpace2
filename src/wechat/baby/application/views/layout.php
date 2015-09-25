<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="format-detection" content="telephone=no"/>
    <title>全优加<?=empty($meta_title) ? '' : '|' ?><?=$meta_title?></title>
    <link rel="stylesheet" type="text/css" href="/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
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
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<?php if(isset($block['script'])) echo $block['script']; ?>
</body>
</html>