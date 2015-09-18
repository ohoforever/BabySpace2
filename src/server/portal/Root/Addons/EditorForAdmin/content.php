<?php 
$selector = '';
if(!empty($addons_data['id'])){
    $selector = 'textarea#'.$addons_data['id'];
    $addons_data['name'] = $addons_data['id'];
}else{
	$selector = 'textarea[name="'.$addons_data['name'].'"]';
}
?>
<switch name="addons_config.editor_type">
	<case value="1">
		{// 纯文本 }
		<input type="hidden" name="parse" value="0">
		<script type="text/javascript">
			$('<?php echo $selector?>').height('{$addons_config.editor_height}');
		</script>
	</case>
	<case value="2">
		{// 富文本 }
		<input type="hidden" name="parse" value="0">
		<eq name="addons_config.editor_wysiwyg" value="1">
			<link rel="stylesheet" href="__STATIC__/kindeditor/default/default.css" />
			<script charset="utf-8" src="__STATIC__/kindeditor/kindeditor-min.js"></script>
			<script charset="utf-8" src="__STATIC__/kindeditor/zh_CN.js"></script>
			<script type="text/javascript">
				var editor_<?php echo $addons_data['name'];?>;
				KindEditor.ready(function(K) {
					editor_{$addons_data.name} = K.create('<?php echo $selector?>', {
						allowFileManager : true,
						//allowPreviewEmoticons : true,
						themesPath: K.basePath,
						width: '100%',
						height: '{$addons_config.editor_height}',
						resizeType: <eq name="addons_config.editor_resize_type" value="1">1<else />0</eq>,
						pasteType : 2,
						urlType : 'domain',
						fileManagerJson : '{:addons_url("EditorForAdmin://Upload/editorfilemanager")}',
						filterMode : false, //不会过滤HTML代码
						//uploadJson : '{:U('uploadJson')}' }
						uploadJson : '{:addons_url("EditorForAdmin://Upload/ke_upimg")}',
						extraFileUploadParams: {
							session_id : '{:session_id()}'
	                    }
					});
				});

				$(function(){
					//传统表单提交同步
					$('<?php echo $selector?>').closest('form').submit(function(){
						editor_{$addons_data.name}.sync();
					});
					//ajax提交之前同步
					$('button[type="submit"],#submit,.ajax-post,#autoSave').click(function(){
						editor_{$addons_data.name}.sync();
					});
				})
			</script>

		<else />
			<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.config.js"></script>
			<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.all.js"></script>
			<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/lang/zh-cn/zh-cn.js"></script>
			<script type="text/javascript">
				$('<?php echo $selector?>').attr('id', 'editor_id_{$addons_data.name}');
				window.UEDITOR_HOME_URL = "__STATIC__/ueditor";
				window.UEDITOR_CONFIG.initialFrameHeight = parseInt('{$addons_config.editor_height}');
				window.UEDITOR_CONFIG.scaleEnabled = <eq name="addons_config.editor_resize_type" value="1">true<else />false</eq>;
				window.UEDITOR_CONFIG.imageUrl = '{:addons_url("EditorForAdmin://Upload/ue_upimg")}';
				window.UEDITOR_CONFIG.imagePath = '';
				window.UEDITOR_CONFIG.imageFieldName = 'imgFile';
				UE.getEditor('editor_id_{$addons_data.name}');
			</script>
		</eq>
	</case>
	<case value="3">
		{// UBB 官网http://xheditor.com/demos/demo07.html}
		<script type="text/javascript" src="__STATIC__/jquery-migrate-1.2.1.min.js"></script>
		<script charset="utf-8" src="__STATIC__/xheditor/xheditor-1.2.1.min.js"></script>
		<script charset="utf-8" src="__STATIC__/xheditor/xheditor_lang/zh-cn.js"></script>
		<script type="text/javascript" src="__STATIC__/xheditor/xheditor_plugins/ubb.js"></script>
		<script type="text/javascript">
		var submitForm = function (){
			$('<?php echo $selector?>').closest('form').submit();
		}
		$('<?php echo $selector?>').attr('id', 'editor_id_{$addons_data.name}')
		$('#editor_id_{$addons_data.name}').xheditor({
			tools:'full',
			showBlocktag:false,
			forcePtag:false,
			beforeSetSource:ubb2html,
			beforeGetSource:html2ubb,
			shortcuts:{'ctrl+enter':submitForm},
			'height':'{$addons_config.editor_height}',
			'width' :'100%'
		});
		</script>
		<input type="hidden" name="parse" value="1">
	</case>
	<case value="4">
		{// markdown }
		<link rel="stylesheet" href="__STATIC__/thinkeditor/skin/default/style.css">
		<script type="text/javascript" src="__STATIC__/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="__STATIC__/thinkeditor/jquery.thinkeditor.js"></script>
		<script type="text/javascript">
			$(function(){
				$('<?php echo $selector?>').attr('id', 'editor_id_{$addons_data.name}');
				var options = {
					"items"  : "h1,h2,h3,h4,h5,h6,-,link,image,-,bold,italic,code,-,ul,ol,blockquote,hr,-,fullscreen",
			        "width"  : "100%", //宽度
			        "height" : "{$addons_config.editor_height}", //高度
			        "lang"   : "zh-cn", //语言
			        "tab"    : "    ", //Tab键插入的字符， 默认为四个空格
					"uploader": "{:addons_url('Editor://Upload/upload')}"
			    };
			    $('#editor_id_{$addons_data.name}').thinkeditor(options);
			})
		</script>
		<input type="hidden" name="parse" value="2">
	</case>
</switch>