<?php /*a:4:{s:60:"/www/wwwroot/guang.ailiutang.cn/app/view/binding/alipay.html";i:1762426633;s:56:"/www/wwwroot/guang.ailiutang.cn/app/view/public/css.html";i:1762426633;s:55:"/www/wwwroot/guang.ailiutang.cn/app/view/public/js.html";i:1762426633;s:62:"/www/wwwroot/guang.ailiutang.cn/app/view/public/copyright.html";i:1762426633;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>绑定支付宝小程序</title>
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
				<div class="layui-card-header">
					绑定支付宝小程序
					<?php if(input('param.isopen')==1): ?><i class="layui-icon layui-icon-close" style="font-size:18px;font-weight:bold;cursor:pointer" onclick="closeself()"></i><?php endif; ?>
				</div>
				<div class="layui-card-body" pad15>
					<div class="layui-form form-label-w8" lay-filter="" style="margin-top:20px">
						<div class="layui-form-item">
							<div style="padding-left:20px;font-weight:bold">一、填写小程序信息</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">小程序ID：</label>
							<div class="layui-input-inline" style="width:200px">
								<input type="text" name="info[appid]" value="<?php echo $info['appid']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">登录支付宝开放平台控制台(openhome.alipay.com/develop/manage) [小程序]中查找</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">应用私钥：</label>
							<div class="layui-input-inline" style="width:280px">
								<input type="text" name="info[appsecret]" value="<?php echo $info['appsecret']; ?>" class="layui-input">
								<?php if($info['appsecret']): ?><div style="position: absolute;left: 0;top: 0;right: 0;bottom: 0; background: #fff;padding: .35rem .7rem;border: 1px solid rgba(0, 0, 0, .15);border-radius: .15rem;color: #636c72;" onclick="$(this).hide()">已隐藏内容，点击查看或编辑</div><?php endif; ?>
							</div>
							<div class="layui-form-mid layui-word-aux">请填写应用私钥去头去尾去回车，一行字符串，<a href="https://opendocs.alipay.com/open/291/105971#LDsXr" target="_blank">接入指引</a></div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">支付宝公钥：</label>
							<div class="layui-input-inline" style="width:280px">
								<input type="text" name="info[publickey]" value="<?php echo $info['publickey']; ?>" class="layui-input">
								<?php if($info['publickey']): ?><div style="position: absolute;left: 0;top: 0;right: 0;bottom: 0; background: #fff;padding: .35rem .7rem;border: 1px solid rgba(0, 0, 0, .15);border-radius: .15rem;color: #636c72;" onclick="$(this).hide()">已隐藏内容，点击查看或编辑</div><?php endif; ?>
							</div>
							<div class="layui-form-mid layui-word-aux">请填写支付宝公钥，一行字符串</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">小程序名称：</label>
							<div class="layui-input-inline" style="width:280px">
								<input type="text" name="info[nickname]" value="<?php echo $info['nickname']; ?>" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">小程序头像：</label>
							<input type="hidden" name="info[headimg]" id="headimg" lay-verType="tips" class="layui-input" value="<?php echo $info['headimg']; ?>">
							<button style="float:left;" type="button" class="layui-btn layui-btn-primary" upload-input="headimg" upload-preview="headimgPreview" onclick="uploader(this)">上传图片</button>
							<div id="headimgPreview" class="picsList-class-padding">
								<div class="layui-imgbox" style="width:100px;"><div class="layui-imgbox-img"><img src="<?php echo $info['headimg']; ?>"/></div></div>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">小程序码：</label>
							<input type="hidden" name="info[qrcode]" id="qrcode" lay-verType="tips" class="layui-input" value="<?php echo $info['qrcode']; ?>">
							<button style="float:left;" type="button" class="layui-btn layui-btn-primary" upload-input="qrcode" upload-preview="qrcodePreview" onclick="uploader(this)">上传图片</button>
							<div id="qrcodePreview" class="picsList-class-padding">
								<div class="layui-imgbox" style="width:100px;"><div class="layui-imgbox-img"><img src="<?php echo $info['qrcode']; ?>"/></div></div>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">小程序支付状态：</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[alipay]" title="开启" value="1" <?php if($info['alipay']==1): ?>checked<?php endif; ?>/>
								<input type="radio" name="info[alipay]" title="关闭" value="0" <?php if($info['alipay']==0): ?>checked<?php endif; ?>/>
							</div>
						</div>
						<div class="layui-form-item"><!--新的openid不兼容随行付，使用userid和openid的接口需根据此配置判断使用对应的字段-->
							<label class="layui-form-label">openid配置：</label>
							<div class="layui-input-inline" style="width: 260px">
								<input type="radio" name="info[openid_set]" title="uid标准" value="userid" <?php if($info['openid_set']=='userid'): ?>checked<?php endif; ?>/>
								<input type="radio" name="info[openid_set]" title="openid标准" value="openid" <?php if($info['openid_set']=='openid'): ?>checked<?php endif; ?>/>
							</div>
							<div class="layui-form-mid layui-word-aux">登录 <a href="https://openhome.alipay.com/develop/manage" target="_blank">开放平台控制台</a> > 进入对应应用详情页 > 开发设置 > openid配置管理 查看并选择对应的选项</div>
						</div>
						<?php if(getcustom('sxpay_fenzhang')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">随行付支付：</label>
							<div class="layui-input-inline" style="width:180px">
								<input type="radio" name="info[sxpay]" title="开启" value="1" <?php if($info['sxpay']==1): ?>checked<?php endif; ?> lay-filter="sxpay_st"/>
								<input type="radio" name="info[sxpay]" title="关闭" value="0" <?php if($info['sxpay']==0): ?>checked<?php endif; ?> lay-filter="sxpay_st"/>
							</div>
							<div class="layui-form-mid layui-word-aux">openid配置管理需要使用uid标准，<a href="https://opendocs.alipay.com/mini/0ai736?pathHash=e4af54b3" target="_blank">申诉回退到 userid方法</a></div>
						</div>
						<div id="sxpay_st" style="float:left;<?php if($info['sxpay']==0): ?>display:none<?php endif; ?>">
							<div class="layui-form-item">
								<label class="layui-form-label">商户编号：</label>
								<div class="layui-input-inline">
									<input type="text" name="info[sxpay_mno]" value="<?php echo $info['sxpay_mno']; ?>" class="layui-input"/>
								</div>
								<?php if($incomeStatus['income'] || $incomeStatus['incomeLog']): ?>
								<div class="layui-form-mid layui-word-aux"> <a href="javascript:void(0)" onclick="openmax('<?php echo url('SxpayIncome/index'); ?>&isopen=1')">点击申请入驻</a></div>
								<?php endif; ?>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">支付密钥：</label>
								<div class="layui-input-inline" style="width:280px">
									<input type="text" name="info[sxpay_mchkey]" value="<?php echo $info['sxpay_mchkey']; ?>" class="layui-input"/>
									<?php if($info['sxpay_mchkey']): ?><div style="position: absolute;left: 0;top: 0;right: 0;bottom: 0; background: #fff;padding: .35rem .7rem;border: 1px solid rgba(0, 0, 0, .15);border-radius: .15rem;color: #636c72;" onclick="$(this).hide()">已隐藏内容，点击查看或编辑</div><?php endif; ?>
								</div>
							</div>
						</div>
						<?php endif; if(getcustom('sxpay_h5') && !getcustom('sxpay_fenzhang')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">随行付支付：</label>
							<div class="layui-input-inline" style="width:180px">
								<input type="radio" name="info[sxpay]" title="开启" value="1" <?php if($info['sxpay']==1): ?>checked<?php endif; ?> lay-filter="sxpay_st"/>
								<input type="radio" name="info[sxpay]" title="关闭" value="0" <?php if($info['sxpay']==0): ?>checked<?php endif; ?> lay-filter="sxpay_st"/>
							</div>
							<div class="layui-form-mid layui-word-aux">openid配置管理需要使用uid标准，<a href="https://opendocs.alipay.com/mini/0ai736?pathHash=e4af54b3" target="_blank">申诉回退到 userid方法</a></div>
						</div>
						<div id="sxpay_st" style="float:left;<?php if($info['sxpay']==0): ?>display:none<?php endif; ?>">
							<div class="layui-form-item">
								<label class="layui-form-label">商户编号：</label>
								<div class="layui-input-inline">
									<input type="text" name="info[sxpay_mno]" value="<?php echo $info['sxpay_mno']; ?>" class="layui-input"/>
								</div>
								<?php if($incomeStatus['income'] || $incomeStatus['incomeLog']): ?>
								<div class="layui-form-mid layui-word-aux"> <a href="javascript:void(0)" onclick="openmax('<?php echo url('SxpayIncome/index'); ?>&isopen=1')">点击申请入驻</a></div>
								<?php endif; ?>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">支付密钥：</label>
								<div class="layui-input-inline" style="width:280px">
									<input type="text" name="info[sxpay_mchkey]" value="<?php echo $info['sxpay_mchkey']; ?>" class="layui-input"/>
									<?php if($info['sxpay_mchkey']): ?><div style="position: absolute;left: 0;top: 0;right: 0;bottom: 0; background: #fff;padding: .35rem .7rem;border: 1px solid rgba(0, 0, 0, .15);border-radius: .15rem;color: #636c72;" onclick="$(this).hide()">已隐藏内容，点击查看或编辑</div><?php endif; ?>
								</div>
							</div>
						</div>
						<?php endif; if(getcustom('pay_huifu')): ?>
						<div class="layui-form-item">
							<span style="color:#333" id="huifuset">汇付天下斗拱支付设置</span><hr/>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">斗拱支付：</label>
							<div class="layui-input-inline" style="width:180px">
								<input type="radio" name="info[huifu]" title="开启" value="1" <?php if($info['huifu']==1): ?>checked<?php endif; ?> lay-filter=""/>
								<input type="radio" name="info[huifu]" title="关闭" value="0" <?php if($info['huifu']==0): ?>checked<?php endif; ?> lay-filter=""/>
							</div>
							<div class="layui-form-mid layui-word-aux">openid配置管理需要使用uid标准，<a href="https://opendocs.alipay.com/mini/0ai736?pathHash=e4af54b3" target="_blank">申诉回退到 userid方法</a></div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">系统号sys_id：</label>
							<div class="layui-input-inline">
								<input type="text" name="info[huifu_sys_id]" value="<?php echo $info['huifu_sys_id']; ?>" class="layui-input"/>
							</div>
							<div class="layui-form-mid layui-word-aux">渠道商/商户的huifu_id，请在<a href="https://dashboard.huifu.com/customers/login" target="_blank">商户后台</a>[开发设置]-[开发者信息]查找</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">产品号product_id：</label>
							<div class="layui-input-inline">
								<input type="text" name="info[huifu_product_id]" value="<?php echo $info['huifu_product_id']; ?>" class="layui-input"/>
							</div>
							<div class="layui-form-mid layui-word-aux">请在<a href="https://dashboard.huifu.com/customers/login" target="_blank">商户后台</a>[开发设置]-[开发者信息]查找</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">商户公钥：</label>
							<div class="layui-input-inline" style="width:500px">
								<input type="text" name="info[huifu_merch_public_key]" value="<?php echo $info['huifu_merch_public_key']; ?>" class="layui-input"/>
								<?php if($info['huifu_merch_public_key']): ?><div style="position: absolute;left: 0;top: 0;right: 0;bottom: 0; background: #fff;padding: .35rem .7rem;border: 1px solid rgba(0, 0, 0, .15);border-radius: .15rem;color: #636c72;" onclick="$(this).hide()">已隐藏内容，点击查看或编辑</div><?php endif; ?>
							</div>
							<div class="layui-form-mid layui-word-aux">请在<a href="https://dashboard.huifu.com/customers/login" target="_blank">商户后台</a>[开发设置]-[密钥管理]查找</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商户私钥：</label>
							<div class="layui-input-inline" style="width:500px">
								<input type="text" name="info[huifu_merch_private_key]" value="<?php echo $info['huifu_merch_private_key']; ?>" class="layui-input"/>
								<?php if($info['huifu_merch_private_key']): ?><div style="position: absolute;left: 0;top: 0;right: 0;bottom: 0; background: #fff;padding: .35rem .7rem;border: 1px solid rgba(0, 0, 0, .15);border-radius: .15rem;color: #636c72;" onclick="$(this).hide()">已隐藏内容，点击查看或编辑</div><?php endif; ?>
							</div>
							<div class="layui-form-mid layui-word-aux">请在<a href="https://dashboard.huifu.com/customers/login" target="_blank">商户后台</a>[开发设置]-[密钥管理]查找</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">汇付公钥：</label>
							<div class="layui-input-inline" style="width:500px">
								<input type="text" name="info[huifu_public_key]" value="<?php echo $info['huifu_public_key']; ?>" class="layui-input"/>
								<?php if($info['huifu_public_key']): ?><div style="position: absolute;left: 0;top: 0;right: 0;bottom: 0; background: #fff;padding: .35rem .7rem;border: 1px solid rgba(0, 0, 0, .15);border-radius: .15rem;color: #636c72;" onclick="$(this).hide()">已隐藏内容，点击查看或编辑</div><?php endif; ?>
							</div>
							<div class="layui-form-mid layui-word-aux">请在<a href="https://dashboard.huifu.com/customers/login" target="_blank">商户后台</a>[开发设置]-[密钥管理]查找</div>
						</div>
						<?php endif; ?>

						<div class="layui-form-item">
							<div style="padding-left:20px;font-weight:bold">二、设置IP白名单及域名</div>
						</div>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">IP白名单：</label>
							<div class="layui-form-mid" style="width:200px;font-weight:bold"><?php echo gethostbyname($_SERVER['HTTP_HOST']); ?></div>
							<div class="layui-form-mid layui-word-aux">[开发]-[开发设置]-[开发信息]-[服务器IP白名单]中设置</div>
						</div>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">域名白名单：</label>
							<div class="layui-form-mid" style="width:200px;font-weight:bold"><?php echo str_replace('https://','',PRE_URL2); ?></div>
							<div class="layui-form-mid layui-word-aux">[开发]-[开发设置]-[服务器域名白名单]中设置</div>
						</div>
						<?php if(getcustom('restaurant_take_food')): ?>	
						<span style="color:#333" >模板消息设置</span><hr/>
						<div class="layui-form-item">
							<label class="layui-form-label">取餐通知</label>
							<div class="layui-input-inline" style="width:400px">
								<input type="text" name="info[tmpl_take_food]" value="<?php echo $info['tmpl_take_food']; ?>" class="layui-input">
							</div>
							<div class="layui-form-mid " style="margin-left:10px;">请阅读<a target="_blank"	href="https://opendocs.alipay.com/mini/03l9bb?pathHash=19d2e0aa&ref=api#%E8%AE%A2%E9%98%85%E6%B6%88%E6%81%AF">订阅消息接入指南</a>，配置关键字：门店名称，取餐码，订单编号，温馨提示，在详情中查找复制模板ID进行保存</div>
						</div>
						<?php endif; ?>		
						<div class="layui-form-item">
							<label class="layui-form-label"></label>
							<div class="layui-input-inline" style="width:500px">
								<button class="layui-btn layui-btn-normal" lay-submit lay-filter="submit_reg">保 存</button>
								<button class="layui-btn layui-btn-primary" onclick="downloadxcx()">下载代码包</button>
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
	layui.form.on('radio(sxpay_st)', function(data){
		if(data.value == '0'){
			$('#sxpay_st').hide();
		}else if(data.value == '1'){
			$('#sxpay_st').show();
		}
	})
	function downloadxcx(){
		layer.confirm('下载代码包用开发者工具进行上传代码，确定要下载吗?',function(index){
			layer.close(index);
			var html = '<div style="margin:40px auto;">';
			html+='<div class="layui-form" lay-filter="">';
			html+='	<div class="layui-form-item">';
			html+='		<label class="layui-form-label">顶部导航背景颜色</label>';
			html+='		<div class="layui-input-inline" style="width:100px">';
			html+='			<input type="text" name="navigationBarBackgroundColor" value="<?php echo t('color1'); ?>" autocomplete="off" class="layui-input">';
			html+='		</div>';
			html+='		<div class="_colorpicker"></div>';
			html+='	</div>';
			html+='	<div class="layui-form-item">';
			html+='		<label class="layui-form-label">顶部导航标题颜色</label>';
			html+='		<div class="layui-input-inline" style="width:170px">';
			html+='			<label><input type="radio" name="navigationBarTextStyle" value="black" title="黑色"/></label>';
			html+='			<label><input type="radio" name="navigationBarTextStyle" value="white" title="白色" checked/></label>';
			html+='		</div>';
			html+='	</div>';
			html+='	<div class="layui-form-item" style="margin-top:30px">';
			html+='		<label class="layui-form-label"></label>';
			html+='		<div class="layui-input-inline">';
			html+='			<button class="layui-btn layui-btn-normal" lay-submit lay-filter="submit_downloadxcx">打包下载</button>';
			html+='		</div>';
			html+='	</div>';
			html+='</div>';
			html+='</div>'
			layer.open({type:1,area:['600px','460px'],content:html,title:'下载代码包',shadeClose:true});
			layui.form.render();
			initcolorpicker();
			layui.form.on('submit(submit_downloadxcx)', function(obj){
				var field = obj.field;
				var index = layer.load();
				$.post("<?php echo url('downloadalipayxcx'); ?>",field,function(data){
					layer.close(index);
					dialog(data.msg,data.status,data.url)
				});
			})
		})
	}


	function downloadop(){
		var index = layer.load();
		$.get('',{op:'downloadalipay'},function(data){
			layer.close(index);
			dialog(data.msg,data.status,data.url);
		})
	}
	layui.form.on('submit(submit_reg)', function(obj){
		var field = obj.field
		field.op = 'setappid';
		$.post('',field,function(data){
			dialog(data.msg,data.status,'<?php echo url('alipay'); ?>');
		})
	})
	layui.upload.render({
    elem: '#uploadjstxt', //绑定元素
    url: "<?php echo url('uploadjstxt'); ?>", //上传接口
		exts:'txt',
    done: function(res){
      //上传完毕回调
			console.log(res)
			dialog(res)
    },
    error: function(){
      //请求异常回调
    }
  });
  </script>
	
</body>
</html>