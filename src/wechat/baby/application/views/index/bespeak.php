<!--main-->
<section class="main">
    <div class="padm54 padt60">
        <form id="FormDate" class="login-form ajax-form" action="/index/bespeak.html" method="post">
            <ul>
                <li>
                    <input type="tel" name="mobile" id="mobile" class="input1" placeholder="输入手机号码">
                </li>
                <li>
                    <div class="cell">
                        <input type="tel" name="sms_code" class="input1" placeholder="输入验证码">
                    </div>
                    <div class="cell getcode-cont">
                        <button type="button" class="getcode">获取验证码</button>
                    </div>
                </li>
                <li>
                    <input type="text" class="input1" name="baby_name" placeholder="输入宝宝姓名">
                </li>
                <li>
                    <div class="cell lab">宝宝性别</div>
                    <div class="cell radio-cont">
                        <div class="radio-li">
                            <input type="radio" checked="" name="baby_sex" class="radio" id="radio_1_1" value="MALE###">
                            <label class="trigger" for="radio_1_1"><span>男</span></label>
                        </div>
                        <div class="radio-li">
                            <input type="radio" name="baby_sex" class="radio" id="radio_1_2" value="FEMAIL#">
                            <label class="trigger" for="radio_1_2"> <span>女</span></label>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="cell lab">出生日期</div>
                    <div class="cell select-cont">
							<span  class="dk_wrap ">
								<select name="year" id="year" onchange="setDays(this,FormDate.month,FormDate.day)">
                                </select>
							</span>
                    </div>
                    <div class="cell select-cont">
							<span  class="dk_wrap ">
								<select name="month" id="month" onchange="setDays(FormDate.year,this,FormDate.day)">
                                </select>
							</span>
                    </div>
                    <div class="cell select-cont">
							<span  class="dk_wrap ">
								<select name="day" id="day">
                                </select>
							</span>
                    </div>
                </li>

                <li>
                    <div class="cell lab2">您所在的城市</div>
                    <div class="cell select-cont">
							<span class="dk_wrap">
								<select name="city" id="city">
                                </select>
							</span>
                    </div>
                    <div class="cell select-cont">
							<span  class="dk_wrap ">
								<select name="district" id="district">
                                </select>
							</span>
                    </div>
                </li>

                <li class="padt30">
                    <button type="submit" class="btn1"><?=isset($btn_text) ? $btn_text : '提交预约'?></button>
                </li>
            </ul>
        </form>
    </div>
</section>

<block name="script">
    <script type="text/javascript">
        var area_list = [];
        $(function(){
            $.getJSON('/public/district.html',function(data){
                //28是广东的代号
                $.each(data[28],function(k,city){
                    addOption(FormDate.city,city[1],city[0]+':'+city[1]);
                });
                delete data[28];
                area_list = data;
                $("#city").change();
            });

            $("#city").change(function(){
                FormDate.district.options.length = 0;
                var val = this.value.split(':');
                $.each(area_list[val[0]],function(k,city){
                    addOption(FormDate.district,city[1],city[1]);
                });
            });
        })

        $(function () {
            //添加年份，从今年的前5年开始
            for (var i = new Date().getFullYear()-5; i <= new Date().getFullYear(); i++) {
                addOption(FormDate.year, i, i);
            }
            //添加月份
            for (var i = 1; i <= 12; i++) {
                addOption(FormDate.month, i, i);
            }
            //添加天份，先默认31天
            for (var i = 1; i <= 31; i++) {
                addOption(FormDate.day, i, i);
            }
        });

        //设置每个月份的天数
        function setDays(year, month,day) {
            var monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            var yea = year.value;
            var mon = month.value;
            var num = monthDays[mon - 1];
            if (mon == 2 && isLeapYear(yea)) {
                num++;
            }

            day.options.length = 0;

            for (var i = 1; i <= num; i++) {
                addOption(FormDate.day,i,i);
            }
        }

        //判断是否闰年
        function isLeapYear(year) {
            return (year % 4 == 0 || (year % 100 == 0 && year % 400 == 0));
        }

        //向select尾部添加option
        function addOption(selectbox, text, value) {
            var option = document.createElement("option");
            option.text = text;
            option.value = value;
            selectbox.options.add(option);
        }
    </script>
</block>