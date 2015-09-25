<!--main-->
<section class="main" xmlns="http://www.w3.org/1999/html">
    <div class="padm54 padt60">
        <form class="login-form ajax-form" action="/public/bind.html" method="post">
            <ul>
                <li>
                    <input type="tel" class="input1" id="mobile" name="mobile" placeholder="输入手机号码">
                </li>
                <li>
                    <div class="cell">
                        <input type="tel" class="input1" id="sms_code" name="sms_code" placeholder="输入验证码">
                    </div>
                    <div class="cell getcode-cont">
                        <button type="button" class="getcode" url="/public/sendBindSms.html">获取验证码</button>
                    </div>
                </li>
                <li>
                    <div class="class-sure-tit">小优提示：报课成功才能绑定手机号哦！</div>
                </li>
                <li class="padt30">
                    <button type="submit" class="btn1">绑定</button>
                </li>
            </ul>
        </form>
    </div>
</section>