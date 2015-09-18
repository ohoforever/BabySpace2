<?php
    $has_list = M('product_module')
        ->join('t_product p on p.id = product_id')
        ->where(['module_id'=>$data['id']])->order('t_product_module.ordering')->getField('product_id,title,product_pic');

    $p_model = M('product');
    if(!empty($has_list)){
        $ids = array_keys($has_list);
        $p_model->where(['id'=>['not in',$ids]]);
    }
    $products = $p_model->order('category_id')->getField('id,title');
?>
<block name="style">
    <style>
        .rule-wrap .btnjt{ padding-top: 110px; line-height:40px; }
        .rule-wrap select{ width: 98%; height: 250px;}
    </style>
</block>
<div class="form-group rule-wrap">
    <div class="col-sm-5">
        <label class="item-label">未选择产品<span class="check-tips"></span></label>
        <div class="controls">
            <select multiple="multiple" id="select-left">
                <?php foreach($products as $key=>$val):?>
                    <option value="<?=$key?>"><?=$val?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="col-sm-1 btnjt">
        <button class="btn btn-sm btn-primary" type="button" id="to-left">
            <i class="icon-double-angle-right"></i>
            <i class="icon-double-angle-right"></i>
            <i class="icon-double-angle-right"></i>
        </button>
        <button class="btn btn-sm btn-danger" type="button" id="to-right">
            <i class="icon-double-angle-left"></i>
            <i class="icon-double-angle-left"></i>
            <i class="icon-double-angle-left"></i>
        </button>
    </div>
    <div class="col-sm-5">
        <label class="item-label">已选择产品<span class="check-tips"></span></label>
        <div class="controls">
            <select name="products[]" multiple="multiple" id="select-right">
                <?php foreach($has_list as $item):?>
                    <option value="<?=$item['product_id']?>" selected><?=$item['title']?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>

<?php
$title_list = ['','图片1','图片2','图片3','图片4'];
reset($has_list);
for($i=1;$i<5;$i++):
    $item = array_shift($has_list);
?>
<div class="form-group">
    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><?=$title_list[$i]?></label>
    <div class="col-xs-12 col-sm-6">
        <div class="controls">
            <input type="file" id="upload_picture_pic<?=$i?>">
            <input type="hidden" value="<?=(isset($item['product_pic']) ? $item['product_pic'] : '')?>" name="pics[]" id="cover_id_pic<?=$i?>"/>
            <div class="upload-img-box" style="margin-top:4px;">
                <?php if(!empty($item) && !empty($item['product_pic'])):?>
                    <img width="120" src="<?=$item['product_pic']?>"/>
                <?php endif;?>
            </div>
        </div>
        <script type="text/javascript">
            //上传图片
            /* 初始化上传插件 */
            $("#upload_picture_pic<?=$i?>").uploadify({
                "height"          : 30,
                "swf"             : "/Public/static/uploadify/uploadify.swf",
                "fileObjName"     : "download",
                "buttonText"      : "上传图片",
                "uploader"        : "<?=U('File/uploadPicture',array('session_id'=>session_id()))?>",
                "width"           : 120,
                'removeTimeout'	  : 1,
                'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                "onUploadSuccess" : uploadPicturepic<?=$i?>,
                'onFallback' : function() {
                    alert('未检测到兼容版本的Flash.');
                }
            });
            function uploadPicturepic<?=$i?>(file, data){
                var data = $.parseJSON(data);
                var src = '';
                if(data.status){
                    src = data.url || '' + data.path;
                    $("#cover_id_pic<?=$i?>").val(src);
                    $("#cover_id_pic<?=$i?>").parent().find('.upload-img-box').html(
                        '<div class="upload-pre-item"><img width="120" src="' + src + '"/></div>'
                    );
                } else {
                    updateAlert(data.info);
                    setTimeout(function(){
                        $('#top-alert').find('button').click();
                        $(that).removeClass('disabled').prop('disabled',false);
                    },1500);
                }
            }
        </script>
    </div>
    <div class="help-block col-xs-12 col-sm-reset inline">
    </div>
</div>
<?php endfor;?>
<block name="script">
    <script type="text/javascript" charset="utf-8">
        //导航高亮
        $(function(){

            $("#to-right,#to-left").click(function(){
                var from = 'left',to = 'right';
                if(this.id != 'to-left'){
                    from = 'right';
                    to = 'left';
                }
                var op_html = '';
                $("#select-"+from+" option:selected").each(function(){
                    var e = $(this);
                    op_html += '<option value="'+e.val()+'">'+e.text()+'</option>'
                    e.remove();
                })
                $("#select-"+to).append(op_html);

                $("#select-right option").prop('selected',true);
            })
        })
    </script>
</block>