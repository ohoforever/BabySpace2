<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="format-detection" content="telephone=no"/>
    <title>全优加</title>
</head>
<body>
<script>
    function jsonpCallback(status,url){
        if(status == 0){
            //alert(url);
            window.location.href = url;
        }else{
            alert('登录失败，请返回重新再试！');
        }
    }
</script>
<script src="http://120.25.62.186:8089/admin.php?s=/public/autologin/wx_id/<?=$wx_user['userid']?>.html"></script>
</body>
</html>
