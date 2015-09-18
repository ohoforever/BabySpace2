<extend name="Public/base" />

<block name="body">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-block alert-success">
                <button data-dismiss="alert" class="close" type="button">
                    <i class="icon-remove"></i>
                </button>

                <i class="icon-exclamation-sign green"></i>
                请点击下面的按钮进入CNZZ统计网站，输入密码 <span class="red">fengniao@sz</span> ，
                点击查看数据
            </div>
            <button id="show-btn" class="btn btn-primary btn-block">请点我</button>
        </div>
    </div>
</block>
<block name="script">
    <script>

        $("#show-btn").click(showbox);
        
        function showbox(){

            $.layer({
                type   : 2,
                offset: ['0px', '0px'],
                shadeClose  : true,
                shade  : [0.5 , '#000' , true],
                title  : ['统计报表',true],
                iframe : {src : 'http://new.cnzz.com/v1/login.php?siteid=1256154074'},
                area   : ['100%' , '100%']
            });
        }
    </script>
</block>