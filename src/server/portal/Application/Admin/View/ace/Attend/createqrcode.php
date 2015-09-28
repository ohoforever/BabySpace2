<extend name="Public/base"/>

<block name="body"> 
    <?php 
        echo ace_form_open('',['class' => '','method'=>'get']);
        $options = array(
            'label_text'=>'耗课课时',
            'help'=>'',
        );
        echo ace_input_m($options ,array('name'=>'course_count','class'=>'width-100'),2);

        $options = array(
            'label_text'=>'课程名称',
        );
        echo ace_input($options ,'class_name');

        echo ace_dropdown(['label_text'=>'请选择图片尺寸'],'img_size',[20=>'超大图',4=>小图,8=>'中图',14=>'大图']);
    ?>
    <div class="clearfix form-actions">
        <div class="col-xs-12 center">
            <button type="submit" class="btn btn-success" id="sb-btn">
                <i class="icon-ok bigger-110"></i> 生成二维码
            </button>
            <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
                <i class="icon-reply"></i>返回上一页
            </a>
        </div>
    </div>
    <?php
        echo ace_form_close()
    ?>
</block>
<block name="script">
    <script>
        $("form").submit(function(){
            window.location = this.action+'&'+$(this).serialize();
            return false;
        })
    </script>
</block>
