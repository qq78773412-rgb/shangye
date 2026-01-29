<?php /*a:3:{s:63:"/www/wwwroot/guang.ailiutang.cn/app/view/web_system/remote.html";i:1762426633;s:56:"/www/wwwroot/guang.ailiutang.cn/app/view/public/css.html";i:1762426633;s:55:"/www/wwwroot/guang.ailiutang.cn/app/view/public/js.html";i:1762426633;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>附件设置</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" type="text/css" href="/static/admin/layui/css/layui.css?v=20200519" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/layui/css/modules/formSelects-v4.css?v=20200516" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/admin.css?v=202406" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/font-awesome.min.css?v=20200516" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/webuploader/webuploader.css?v=<?php echo time(); ?>" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/designer.css?v=202410" media="all">
<link rel="stylesheet" type="text/css" href="/static/fonts/iconfont.css?v=20201218" media="all">
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-card layui-col-md12">
				<div class="layui-card-header">附件设置</div>
				<div class="layui-card-body" pad15>
					<div class="layui-form form-label-w10" lay-filter="">
						<div class="layui-form-item">
							<label class="layui-form-label">存储类型</label>
							<div class="layui-input-inline" style="width:300px">
								<select name="info[type]" lay-filter="changetype">
									<option value="1" <?php if($info['type']==1): ?>selected<?php endif; ?>>本地存储</option>
									<option value="2" <?php if($info['type']==2): ?>selected<?php endif; ?>>阿里云</option>
									<option value="3" <?php if($info['type']==3): ?>selected<?php endif; ?>>七牛云</option>
									<option value="4" <?php if($info['type']==4): ?>selected<?php endif; ?>>腾讯云</option>
								</select>
							</div>
						</div>
						<div id="aliossset" <?php if($info['type']!=2): ?>style="display:none"<?php endif; ?>>
							<div class="layui-form-item">
								<label class="layui-form-label">Access Key ID</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[alioss][key]" value="<?php echo $info['alioss']['key']; ?>" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Access Key Secret</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[alioss][secret]" value="<?php echo $info['alioss']['secret']; ?>" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Bucket名称</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[alioss][bucket]" value="<?php echo $info['alioss']['bucket']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">空间名称</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">EndPoint（地域节点）</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[alioss][ossurl]" value="<?php echo $info['alioss']['ossurl']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">如：oss-cn-qingdao.aliyuncs.com</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Bucket域名</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[alioss][url]" value="<?php echo $info['alioss']['url']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">开头须加https://</div>
							</div>
						</div>
						<div id="qiniuset" <?php if($info['type']!=3): ?>style="display:none"<?php endif; ?>>
							<div class="layui-form-item">
								<label class="layui-form-label">Accesskey</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[qiniu][accesskey]" value="<?php echo $info['qiniu']['accesskey']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">在密钥管理中查找</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Secretkey</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[qiniu][secretkey]" value="<?php echo $info['qiniu']['secretkey']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">在密钥管理中查找</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Bucket</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[qiniu][bucket]" value="<?php echo $info['qiniu']['bucket']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">空间名称</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Url</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[qiniu][url]" value="<?php echo $info['qiniu']['url']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">开头须加https://</div>
							</div>
							<?php if(getcustom('qiniu_transcode')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">转码</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="radio" name="info[qiniu][transcode]" value="" <?php if($info[qiniu][transcode]==''): ?>checked<?php endif; ?> title="关闭">
									<input type="radio" name="info[qiniu][transcode]" value="webp" <?php if($info[qiniu][transcode]=='webp'): ?>checked<?php endif; ?> title="webp">
								</div>
								<div class="layui-form-mid layui-word-aux"></div>
							</div>
							<?php endif; ?>

						</div>
						<div id="cosset" <?php if($info['type']!=4): ?>style="display:none"<?php endif; ?>>
							<div class="layui-form-item">
								<label class="layui-form-label">APPID</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[cos][appid]" value="<?php echo $info['cos']['appid']; ?>" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">SecretID</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[cos][secretid]" value="<?php echo $info['cos']['secretid']; ?>" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">SecretKEY</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[cos][secretkey]" value="<?php echo $info['cos']['secretkey']; ?>" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Bucket</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[cos][bucket]" value="<?php echo $info['cos']['bucket']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">存储桶名称</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">bucket所属地域</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[cos][local]" value="<?php echo $info['cos']['local']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">地域代码，如：ap-beijing</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">Url</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[cos][url]" value="<?php echo $info['cos']['url']; ?>" class="layui-input">
								</div>
								<div class="layui-form-mid layui-word-aux">开头须加https://</div>
							</div>
						</div>
							
						<div class="layui-form-item">
							<label class="layui-form-label">图片压缩</label>
							<div class="layui-input-inline" style="width:200px">
								<input type="radio" name="info[thumb]" value="1" <?php if($info['thumb']==1): ?>checked<?php endif; ?> title="开启" lay-filter="thumb">
								<input type="radio" name="info[thumb]" value="0" <?php if($info['thumb']==0): ?>checked<?php endif; ?> title="关闭" lay-filter="thumb">
							</div>
							<div class="layui-form-mid">最大宽度</div>
							<div class="layui-input-inline" style="width:70px">
								<input type="text" name="info[thumb_width]" value="<?php echo $info['thumb_width']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid">最大高度</div>
							<div class="layui-input-inline" style="width:70px">
								<input type="text" name="info[thumb_height]" value="<?php echo $info['thumb_height']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">上传图片超出设置的宽高时自动压缩，png格式压缩会变成不透明，谨慎开启！！！</div>
						</div>

						<!-- 图片压缩开启后显示删除原文件 -->
						<div class="layui-form-item" id = "delete_origin" <?php if($info['thumb']==0): ?>style="display:none;"<?php endif; ?>>
							<label class="layui-form-label">删除原图</label>
							<div class="layui-input-inline" style="width:200px">
								<input type="radio" name="info[delete_origin]" value="1" <?php if(!$info['delete_origin'] || $info['delete_origin']==1): ?>checked<?php endif; ?> title="开启" lay-filter="delete_origin">
								<input type="radio" name="info[delete_origin]" value="0" <?php if($info['delete_origin']==0): ?>checked<?php endif; ?> title="关闭" lay-filter="delete_origin">
							</div>
							<div class="layui-form-mid layui-word-aux">上传压缩图片后删除原图</div>
						</div>
						<!-- 云存储上传后删除服务器文件 -->
						<div class="layui-form-item" id="delete_local" <?php if($info['type']==1): ?>style="display:none"<?php endif; ?>>
							<label class="layui-form-label">云存储上传后<br>删除服务器文件</label>
							<div class="layui-input-inline" style="width:200px">
								<input type="radio" name="info[delete_local]" value="1" <?php if(!$info['delete_local'] || $info['delete_local']==1): ?>checked<?php endif; ?> title="开启">
								<input type="radio" name="info[delete_local]" value="0" <?php if($info['delete_local']==0): ?>checked<?php endif; ?> title="关闭">
							</div>
							<div class="layui-form-mid layui-word-aux">开启后，上传完成后会删除服务器文件，保留云储存文件</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">服务器单次上传限制</label>
							<div class="layui-form-mid" style="width:100px;font-weight:bold"><?php echo $config['upload_max_filesize']; ?></div>
							<div class="layui-form-mid layui-word-aux">宝塔-[软件商店]-[PHP<?php echo $phpversion; ?>]-[设置]-[上传限制]设置</div>
						</div>
<!--						<div class="layui-form-item">-->
<!--							<label class="layui-form-label">表单上传限制：</label>-->
<!--							<div class="layui-form-mid" style="width:100px;font-weight:bold"><?php echo $config['post_max_size']; ?></div>-->
<!--							<div class="layui-form-mid layui-word-aux">宝塔-[软件商店]-[PHP<?php echo $phpversion; ?>]-[设置]-[上传限制]设置，不能小于“上传限制”</div>-->
<!--						</div>-->
						<?php if(getcustom('file_size_limit')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">图片上传限制</label>
							<div class="layui-input-inline" style="width:100px;margin-right:0">
								<input type="number" step="1" min="0" max="1000" name="info[file_image_limit]" value="<?php echo $info['file_image_limit']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid" style="margin-left:0;background:#e6e6e6;padding: 9px 9px !important">MB</div>
							<div class="layui-form-mid layui-word-aux">单个文件上传大小限制，0为不限制</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">视频上传限制</label>
							<div class="layui-input-inline" style="width:100px;margin-right:0">
								<input type="number" step="1" min="0" max="10000" name="info[file_video_limit]" value="<?php echo $info['file_video_limit']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid" style="margin-left:0;background:#e6e6e6;padding: 9px 9px !important">MB</div>
							<div class="layui-form-mid layui-word-aux">单个文件上传大小限制，0为不限制</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">其他上传限制</label>
							<div class="layui-input-inline" style="width:100px;margin-right:0">
								<input type="number" step="1" min="0" max="10000" name="info[file_other_limit]" value="<?php echo $info['file_other_limit']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid" style="margin-left:0;background:#e6e6e6;padding: 9px 9px !important">MB</div>
							<div class="layui-form-mid layui-word-aux">图片和视频外的其他文件，单个文件上传大小限制，0为不限制</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">用户独立设置限制</label>
							<div class="layui-input-inline" style="width:200px">
								<input type="radio" name="info[file_limit_user]" value="1" <?php if($info['file_limit_user']==1): ?>checked<?php endif; ?> title="开启">
								<input type="radio" name="info[file_limit_user]" value="0" <?php if($info['file_limit_user']==0): ?>checked<?php endif; ?> title="关闭">
							</div>
							<div class="layui-form-mid layui-word-aux">各个子系统是否可独立设置上传限制，独立设置优先级高于此设置</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">用户附件上限</label>
							<div class="layui-input-inline" style="width:100px;margin-right:0">
								<input type="number" step="1" min="0" name="info[file_upload_limit]" value="<?php echo $info['file_upload_limit']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid" style="margin-left:0;background:#e6e6e6;padding: 9px 9px !important">MB</div>
							<div class="layui-form-mid layui-word-aux">各个子系统附件上限（仅跟随平台存储类型生效），0为不限制，到达上限后用户后台无法继续上传文件<?php if((!getcustom('admin_user_hide'))): ?>，[用户列表]-[编辑]-可独立设置<?php endif; ?></div>
						</div>
						<?php endif; ?>
						<div class="layui-form-item">
							<label class="layui-form-label"></label>
							<div class="layui-input-block">
								<button class="layui-btn" lay-submit lay-filter="setmypass">保 存</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
	<script type="text/javascript" src="/static/admin/layui/layui.all.js?v=20210226"></script>
<script type="text/javascript" src="/static/admin/layui/lay/modules/flow.js?v=1"></script>
<script type="text/javascript" src="/static/admin/layui/lay/modules/formSelects-v4.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery-ui.min.js?v=20200228"></script>
<script type="text/javascript" src="/static/admin/ueditor/ueditor.js?v=20220707"></script>
<script type="text/javascript" src="/static/admin/ueditor/135editor.js?v=20200228"></script>
<script type="text/javascript" src="/static/admin/webuploader/webuploader.js?v=2024"></script>
<script type="text/javascript" src="/static/admin/js/qrcode.min.js?v=20200228"></script>
<script type="text/javascript" src="/static/admin/js/dianda.js?v=2022"></script>
<script type="text/javascript" src="/static/admin/js/inputTags.js?v=2026"></script>

<div id="NewsToolBox"></div>
<script type="text/javascript">
		// 解释文字浮层展示
		$('.layui-text-popover').mouseenter(function(){
			let pageHeight = $(window).height() + $(document).scrollTop();
			let bottom = pageHeight - $(this).offset().top
			let topNum = ($(this).offset().top - $(document).scrollTop()).toFixed(2);
			let Height = $(this).find('.layui-textpopover-div').outerHeight();
			$(this).find('.layui-textpopover-div').show()
			let that = this;
			setTimeout(function(){
				if(topNum < (Height/2-15)){
					$(that).find('.layui-textpopover-div').css({'top':-topNum+10+'px','opacity':1,'transition':'opacity .3s'})	
				}else if(bottom < (Height/2-15)){
					$(that).find('.layui-textpopover-div').css({'top': bottom-Height-10 +'px','opacity':1,'transition':'opacity .3s'})	
				}else{
					$(that).find('.layui-textpopover-div').css({'top':-(Height/2-15)+'px','opacity':1,'transition':'opacity .3s'})	
				}
			},100)
		}) 
		$('.layui-text-popover').mouseleave(function(){
			$(this).find('.layui-textpopover-div').css({'opacity':0})	
			$(this).find('.layui-textpopover-div').hide()
		}) 
		$('.layui-textpopover-div').mouseenter(function(){
			$(this).find('.layui-textpopover-div').show()
		})
		$('.layui-textpopover-div').mouseleave(function(){
			$(this).find('.layui-textpopover-div').css({'opacity':0})
			$(this).find('.layui-textpopover-div').hide()
		})
		// 图片浮层展示 示例
		$('.layui-popover').mouseenter(function(){
			let pageHeight = $(window).height() + $(document).scrollTop();
			let bottom = pageHeight - $(this).offset().top
			let topNum = ($(this).offset().top - $(document).scrollTop()).toFixed(2);
			let Height = $(this).find('.layui-popover-div').outerHeight();
			$(this).find('.layui-popover-div').show()
			let that = this;
			setTimeout(function(){
				if(topNum < (Height/2-15)){
					$(that).find('.layui-popover-div').css({'top':-topNum+10+'px','opacity':1,'transition':'opacity .3s'})	
				}else if(bottom < (Height/2-15)){
					$(that).find('.layui-popover-div').css({'top': bottom-Height-10 +'px','opacity':1,'transition':'opacity .3s'})	
				}else{
					$(that).find('.layui-popover-div').css({'top':-(Height/2-15)+'px','opacity':1,'transition':'opacity .3s'})	
				}
			},100)
		}) 
		$('.layui-popover').mouseleave(function(){
			$(this).find('.layui-popover-div').css({'opacity':0})	
			$(this).find('.layui-popover-div').hide()
		}) 
    function copyText(text) {
        var top = document.documentElement.scrollTop;
        var textarea = document.createElement("textarea"); //创建input对象
        var currentFocus = document.activeElement; //当前获得焦点的元素
        var toolBoxwrap = document.getElementById('NewsToolBox'); //将文本框插入到NewsToolBox这个之后
        toolBoxwrap.appendChild(textarea); //添加元素
        textarea.value = text;
        textarea.focus();
        document.documentElement.scrollTop = top;
        if (textarea.setSelectionRange) {
            textarea.setSelectionRange(0, textarea.value.length); //获取光标起始位置到结束位置
        } else {
            textarea.select();
        }
        try {
            var flag = document.execCommand("copy"); //执行复制
        } catch (eo) {
            var flag = false;
        }
        toolBoxwrap.removeChild(textarea); //删除元素
        currentFocus.focus();
        if(flag) layer.msg('复制成功');
        return flag;
    }
		// 查看链接
		function viewLink(path,url=''){
			var pagepath = path;
			if(!url){
				var url = "<?php echo m_url('"+pagepath+"'); ?>"; //拼接 H5 链接
			}
			<?php if(!in_array('mp',$platform)): ?>
				showwxqrcode(pagepath);
				return;
			<?php endif; ?>
			var html = '';
			html+='<div style="margin:20px">';
			html+='	<div style="width:100%;margin:10px 0" id="urlqr"></div>';
			<?php if(in_array('wx',$platform)): ?>
			html+='	<div style="width:100%;text-align:center"><button class="layui-btn layui-btn-sm layui-btn-primary" onclick="showwxqrcode(\''+pagepath+'\')">查看小程序码</button></div>';
			<?php endif; ?>
			html+='	<div style="line-height:25px;"><div><span style="width: 70px;display: inline-block;">链接地址：</span><button class="layui-btn layui-btn-xs layui-btn-primary" onclick="copyText(\''+url+'\')">复制</button></div><div>'+url+'</div></div>';
			html+='	<div style="height:50px;line-height:25px;"><div><span style="width: 70px;display: inline-block;">页面路径：</span><button style="box-sizing: border-box;" class="layui-btn layui-btn-xs layui-btn-primary" onclick="copyText(\'/'+pagepath+'\')">复制</button></div><div>/'+pagepath+'</div></div>';
			html+='</div>';
			layer.open({type:1,'title':'查看链接',area:['500px','430px'],shadeClose:true,'content':html})
			var qrcode = new QRCode('urlqr', {
					text: 'your content',
					width: 200,
					height: 200,
					colorDark : '#000000',
					colorLight : '#ffffff',
					correctLevel : QRCode.CorrectLevel.L
				});
				qrcode.clear();
				qrcode.makeCode(url);
		}
		// 查看小程序码
		function showwxqrcode(pagepath){
			var index = layer.load();
			$.post("<?php echo url('DesignerPage/getwxqrcode'); ?>",{path:pagepath},function(res){
				layer.close(index);
				if(res.status==0){
					layer.open({type:1,area:['300px','350px'],content:'<div style="margin:auto auto;text-align:center"><div style="color:red;width:280px;height:180px;margin-top:100px">'+res.msg+'</div><div style="height:25px;line-height:25px;">'+'/'+pagepath+'</div></div>',title:false,shadeClose:true})
				}else{
					layer.open({type:1,area:['300px','350px'],content:'<div style="margin:auto auto;text-align:center"><img src="'+res.url+'" style="margin-top:20px;max-width:280px;max-height:280px"/><div style="height:25px;line-height:25px;">'+'/'+pagepath+'</div></div>',title:false,shadeClose:true})
				}
			})
		}
</script>
<!-------使用js导出excel文件--------->
<script src="/static/admin/excel/excel.js?v=2024"></script>
<script src="/static/admin/excel/layui_exts/excel.js"></script>
<script>

    var excel = new Excel();
    var excel_name = '<?php echo $excel_name; ?>';
    excel.bind(function (data,title) {
        var excel_field = JSON.parse('<?php echo $excel_field; ?>');
        if(title && title!=undefined){
            //接口返回的title
            var excel_title = title;
        }else{
            //excel_field.php 配置的title
            var excel_title = JSON.parse('<?php echo $excel_title; ?>');
        }
        if(!excel_title || excel_title.length<=0){
            //上面两种都没有title,读取table表格cols中的title，同时filed也更新为table表格cols中的field
            excel_title = [];
            excel_field = [];
            var cols = tableIns.config.cols;
            cols.forEach(function (cols_item, cols_index) {
                console.log(cols_item);
                cols_item.forEach(function (cols_item2, cols_index2) {
                    console.log(cols_item2);
                    if(cols_item2.title){
                        excel_title.push(cols_item2.title)
                        excel_field.push(cols_item2.field)
                    }
                })
            })
        }
        // if(!excel_title || excel_title.length<=0){
        //     layer.msg('未设置标题');
        //     return;
        // }

        // 设置表格内容
        data.forEach(function (item, index) {
            var _data = [];
            excel_title.forEach(function (title, index2) {
                var field = excel_field[index2];
                if(item[field] && item[field]!=undefined){
                    //有filed 匹配field
                    var field_val = item[field];
                    //是整数 长度为10 字段名包含time 判定为时间戳
                    if(parseInt(field_val) == field_val && (field_val.toString()).length==10 && field.includes('time')){
                        field_val = date('Y-m-d H:i:s',field_val);
                    }
                }else{
                    //没有filed 根据顺序来
                    var field_val = item[index2];
                }
                _data.push(field_val);
            })
            data[index] = _data;
        });
        // 设置表头内容
        if(excel_title && excel_title.length>0){
            data.unshift(excel_title);
        }
        // 应用表格样式
        return this.withStyle(data);

    }, excel_name+layui.util.toDateString(Date.now(), '_yyyyMMdd_HHmmss'));

</script>
	<script>
	layui.form.on('select(changetype)',function(data){
		$('#aliossset').hide()
		$('#qiniuset').hide()
		$('#cosset').hide()
		if(data.value==2){
			$('#aliossset').show()
		}
		if(data.value==3){
			$('#qiniuset').show()
		}
		if(data.value==4){
			$('#cosset').show()
		}
		if(data.value == 1){
			$('#delete_local').hide()
		}else{
			$('#delete_local').show()
		}
	})
 
	// 单选thumb
	layui.form.on('radio(thumb)', function(data){
		if(data.value==1){
			$('#delete_origin').show()
		}else{
			$('#delete_origin').hide()
		}
	})
	layui.form.on('submit(setmypass)', function(obj){
		var field = obj.field
		$.post("",obj.field,function(data){
			dialog(data.msg,data.status,data.url);
		})
	})
  </script>
</body>
</html>