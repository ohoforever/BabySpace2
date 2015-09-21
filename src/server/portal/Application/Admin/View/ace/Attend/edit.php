<extend name="Public/base"/>

<block name="body"> 
    <?php 
        echo ace_form_open();

        echo ace_group(ace_label('宝宝姓名'),'<div class="line-height-2 blue">'.$item['baby_name'].'</div>');
        echo ace_group(ace_label('课程名称'),'<div class="line-height-2 blue">'.$item['classname'].'</div>');
        echo ace_group(ace_label('学校名称'),'<div class="line-height-2 blue">'.$item['school_name'].'</div>');

        $options = array(
            'label_text'=>'耗课课时',
            'help'=>'',
        );
        echo ace_input($options ,array('name'=>'course_count','class'=>'width-100'),$item['course_count']);

        $options = array(
            'label_text'=>'耗课日期',
            'icon'=>'icon-calendar'
        );
        echo ace_input_m($options ,'act_date',date('Y-m-d',strtotime($item['act_time'])));

    ?>

    <div class="form-group">
        <label class="col-xs-12 col-sm-2 control-label no-padding-right" for="act_time">
            <span class="red">*</span>耗课时间
        </label>
        <div class="col-xs-12 col-sm-5 bootstrap-timepicker">
            <span class="input-icon block input-icon-right">
                <input type="text" class="width-100" id="act_time" value="18:36:07" name="act_time">
                <i class="icon icon-time"></i>
            </span>
        </div>
        <div class="help-block col-xs-12 col-sm-reset inline"></div>
    </div>
    <?php
        echo ace_srbtn();
        echo ace_form_close()
    ?>
</block>
<block name="style">
    <link rel="stylesheet" href="__ACE__/css/datepicker.css" />
    <link rel="stylesheet" href="__ACE__/css/bootstrap-timepicker.css" />
</block>
<block name="script">
    <script src="__ACE__/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="__ACE__/js/date-time/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript">

        $(function(){
            $('#act_date').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                $(this).prev().focus();
            });

            $('#act_time').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
            });
            //导航高亮
            highlight_subnav('{:U('attend/index')}');
        });
    </script>
</block>