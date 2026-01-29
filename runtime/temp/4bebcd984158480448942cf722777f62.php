<?php /*a:4:{s:65:"/www/wwwroot/guang.ailiutang.cn/app/view/designer_menu/index.html";i:1762426633;s:56:"/www/wwwroot/guang.ailiutang.cn/app/view/public/css.html";i:1762426633;s:55:"/www/wwwroot/guang.ailiutang.cn/app/view/public/js.html";i:1762426633;s:62:"/www/wwwroot/guang.ailiutang.cn/app/view/public/copyright.html";i:1762426633;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>菜单设置</title>
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
	<style>
	.tabBar{ width:340px; height:50px;background:#fff; border-top:1px #dedede solid;position:absolute;bottom:0}
	.tabBar-tab{ width:100%; text-align:center; padding:0px; margin:0px; table-layout:fixed; }
	.tabBar-tab td{ border:none;  margin:0px; text-align:center; padding:5px 0 1px 0;display: table-cell;cursor:pointer}
	.tabBar-tab td img{ width:24px; height:24px; margin:0 auto; }
	.tabBar-tab td span{ display:block; width:100%; height:18px; line-height:18px; font-size:12px; }
	</style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
			<div class="layui-card layui-col-md12">
				<?php if(count($platform)<=1): ?>
				<div class="layui-card-header">菜单与导航设置</div>
				<?php else: ?>
				<div class="layui-tab layui-tab-brief" style="margin-bottom:20px">
					<ul class="layui-tab-title">
						<?php foreach($platform as $pl): ?>
						<li <?php if($type==$pl): ?>class="layui-this"<?php endif; ?> onclick="location.href='<?php echo url(); ?>/type/<?php echo $pl; ?>'"><?php echo getplatformname($pl); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
				<div class="layui-card-body layui-col-md12" pad15 ng-app="myApp" ng-controller="personCtrl">
					<div class="dsn-phone">
						<div class="dsn-phone-left"></div>
						<div class="dsn-phone-center">
							<div class="dsn-phone-top"></div>
							<div class="dsn-phone-main">
								<div id="editor">
									<div class="dsn-mod dsn-topbar dsn-mod-nohover" style="<?php if($type=='mp'): ?>color:#fff;background:#333;<?php else: ?>color:{{navigationBarTextStyle}};background:{{navigationBarBackgroundColor}}<?php endif; ?>">
										<div style="float:left;width:100%;font-size:12px">
											<div style="float:left;width:30%">&nbsp;<i class="fa fa-signal"></i> wechat <i class="fa fa-wifi"></i></div>
											<div style="float:left;text-align:center;width:40%">12:00</div>
											<div style="float:left;text-align:right;width:30%">100% <i class="fa fa-battery-full"></i>&nbsp;</div>
										</div>
										<div style="float:left;width:98%;margin:2px 1% 0 1%;">
											<div style="float:left;width:30%">&nbsp;</div>
											<div style="float:left;text-align:center;width:40%;font-size:16px;height:27px;line-height:27px">页面标题</div>
											<!-- <div style="float:right;width:30%;border-radius:20px;width:70px;height: 25px;border:1px solid rgba(255,255,255,0.2);text;text-align:center;overflow:hidden" ng-style="{'border-color':navigationBarTextStyle=='black'?'rgba(0,0,0,0.2)':'rgba(255,255,255,0.2)'}">
												<div style="float:left;width:49%;font-size:17px;height:27px;line-height:27px">
													<div style="float:left;margin-left:2px">&nbsp;&bull;</div>
													<div style="float:left;font-size:27px">&bull;</div>
													<div style="float:left;">&bull;</div>
												</div>
												<div style="float:left;width:2%;"><span style="border-right:1px solid;opacity:0.2;"></span></div>
												<div style="float:right;width:49%;"><i class="fa fa-dot-circle-o" style="font-size:19px;height:25px;line-height:25px"></i></div>
											</div> -->
										</div>
									</div>
									<div id="editor-content">
									<div style="margin-top:200px;font-size:26px;color:#ccc;width:100%;text-align:center">内容显示区域</div>
									<div style="position:absolute;bottom:60px;width:100%;text-align:center;color:#a55">提示：点击右侧菜单名称后的上移进行排序</div>
									<div id="tabBar" class="tabBar" style="overflow:hidden;background:{{menudata.backgroundColor}};border-top:1px {{menudata.borderStyle=='black'?'#e5e5e5':'#e5e5e5'}} solid;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabBar-tab">
										<tbody><tr id="sortable">
											<td ng-show="menucount>$index" ng-click="menuselectedchange($index)" data-key="{{ key }}" ng-repeat="(key,thismenu) in menudata.list track by $index">
												 <img ng-src="{{thismenu.iconPath}}" ng-show="menuselected!=$index"/>
												 <img ng-src="{{thismenu.selectedIconPath}}" ng-show="menuselected==$index"/>
												 <span style="color:{{menudata.color}}" ng-show="menuselected!=$index">{{thismenu.text || '编辑菜单'}}</span>
												 <span style="color:{{menudata.selectedColor}}" ng-show="menuselected==$index">{{thismenu.text || '编辑菜单'}}</span>
											</td>
										</tr>
										</tbody></table>
									</div>
									</div>
								</div>
							</div>
							<div class="dsn-phone-bottom"></div>
						</div>
						<div class="dsn-phone-right"></div>
					</div>
					
					<div class="layui-form form-label-w6 layui-col-md7" lay-filter="">
						
						<!-- <div class="layui-form-item">
							<label class="layui-form-label">顶部背景颜色</label>
							<div class="layui-input-inline" style="width:100px">
								<input type="text" name="navigationBarBackgroundColor" autocomplete="off" class="layui-input" ng-model="navigationBarBackgroundColor">
							</div>
							<div class="colorpicker" ng-model="navigationBarBackgroundColor" style="float:left"></div>
							<div class="layui-form-mid"></div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">该项修改后需重新提交代码才能生效</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">顶部标题颜色</label>
							<div class="layui-input-inline" style="width:170px">
								<label><input type="radio" name="navigationBarTextStyle" value="black" title="黑色" ng-model="navigationBarTextStyle" <?php if($info['navigationBarTextStyle']=='black'): ?>checked<?php endif; ?>/></label>
								<label><input type="radio" name="navigationBarTextStyle" value="white" title="白色" ng-model="navigationBarTextStyle" <?php if($info['navigationBarTextStyle']=='white'): ?>checked<?php endif; ?>/></label>
							</div>
							<div class="layui-form-mid"></div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">该项修改后需重新提交代码才能生效</div>
						</div> -->

						<div class="layui-form-item">
							<label class="layui-form-label">菜单个数</label>
							<div class="layui-input-inline" style="width:400px">
								<label><input type="radio" name="info[menucount]" value="0" title="无" ng-model="menucount" <?php if($info['menucount']==0): ?>checked<?php endif; ?>/></label>
								<label><input type="radio" name="info[menucount]" value="2" title="两个" ng-model="menucount" <?php if($info['menucount']==2): ?>checked<?php endif; ?>/></label>
								<label><input type="radio" name="info[menucount]" value="3" title="三个" ng-model="menucount" <?php if($info['menucount']==3): ?>checked<?php endif; ?>/></label>
								<label><input type="radio" name="info[menucount]" value="4" title="四个" ng-model="menucount" <?php if($info['menucount']==4): ?>checked<?php endif; ?>/></label>
								<label><input type="radio" name="info[menucount]" value="5" title="五个" ng-model="menucount" <?php if($info['menucount']==5): ?>checked<?php endif; ?>/></label>
							</div>
						</div>
						<div ng-show="menucount>0">
							<div class="layui-form-item">
								<label class="layui-form-label">菜单一</label>
								<span class="layui-form-mid">名称</span>
								<div class="layui-input-inline" style="width:210px">
									<input type="text" name="text0" autocomplete="off" class="layui-input" ng-model="menudata.list[0].text">
								</div>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">链接</span>
									<div class="layui-input-inline" style="width:210px">
										<input type="text" name="pagePath0" autocomplete="off" class="layui-input" ng-model="menudata.list[0].pagePath">
									</div>
									<button class="layui-btn layui-btn-primary" ng-click="chooseUrl(0)" style="float:left">选择链接</button>
									<span class="layui-form-mid" style="width:200px;">&nbsp;{{menudata.list[0].pagePathname}}</span>
								</div>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">图标</span>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(0,1,'')">默认图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[0].iconPath}}"/>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(0,2,'')">选中图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[0].selectedIconPath}}"/>
								</div>
							</div>
							<div class="layui-form-item" ng-show="menucount>1">
								<label class="layui-form-label">菜单二</label>
								<span class="layui-form-mid">名称</span>
								<div class="layui-input-inline" style="width:210px">
									<input type="text" name="text1" autocomplete="off" class="layui-input" ng-model="menudata.list[1].text">
								</div>
								<button class="layui-btn layui-btn-primary" ng-click="goup(1)" style="float:left">上移</button>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">链接</span>
									<div class="layui-input-inline" style="width:210px">
										<input type="text" name="pagePath1" autocomplete="off" class="layui-input" ng-model="menudata.list[1].pagePath">
									</div>
									<button class="layui-btn layui-btn-primary" ng-click="chooseUrl(1)" style="float:left">选择链接</button>
									<span class="layui-form-mid" style="width:200px;">&nbsp;{{menudata.list[1].pagePathname}}</span>
								</div>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">图标</span>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(1,1,'')">默认图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[1].iconPath}}"/>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(1,2,'')">选中图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[1].selectedIconPath}}"/>
								</div>
							</div>
							<div class="layui-form-item" ng-show="menucount>2">
								<label class="layui-form-label">菜单三</label>
								<span class="layui-form-mid">名称</span>
								<div class="layui-input-inline" style="width:210px">
									<input type="text" name="text2" autocomplete="off" class="layui-input" ng-model="menudata.list[2].text">
								</div>
								<button class="layui-btn layui-btn-primary" ng-click="goup(2)" style="float:left">上移</button>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">链接</span>
									<div class="layui-input-inline" style="width:210px">
										<input type="text" name="pagePath2" autocomplete="off" class="layui-input" ng-model="menudata.list[2].pagePath">
									</div>
									<button class="layui-btn layui-btn-primary" ng-click="chooseUrl(2)" style="float:left">选择链接</button>
									<span class="layui-form-mid" style="width:200px;">&nbsp;{{menudata.list[2].pagePathname}}</span>
								</div>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">图标</span>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(2,1,'')">默认图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[2].iconPath}}"/>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(2,2,'')">选中图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[2].selectedIconPath}}"/>
								</div>
							</div>
							<div class="layui-form-item" ng-show="menucount>3">
								<label class="layui-form-label">菜单四</label>
								<span class="layui-form-mid">名称</span>
								<div class="layui-input-inline" style="width:210px">
									<input type="text" name="text3" autocomplete="off" class="layui-input" ng-model="menudata.list[3].text">
								</div>
								<button class="layui-btn layui-btn-primary" ng-click="goup(3)" style="float:left">上移</button>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">链接</span>
									<div class="layui-input-inline" style="width:210px">
										<input type="text" name="pagePath3" autocomplete="off" class="layui-input" ng-model="menudata.list[3].pagePath">
									</div>
									<button class="layui-btn layui-btn-primary" ng-click="chooseUrl(3)" style="float:left">选择链接</button>
									<span class="layui-form-mid" style="width:200px;">&nbsp;{{menudata.list[3].pagePathname}}</span>
								</div>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">图标</span>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(3,1,'')">默认图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[3].iconPath}}"/>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(3,2,'')">选中图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[3].selectedIconPath}}"/>
								</div>
							</div>
							<div class="layui-form-item" ng-show="menucount>4">
								<label class="layui-form-label">菜单五</label>
								<span class="layui-form-mid">名称</span>
								<div class="layui-input-inline" style="width:210px">
									<input type="text" name="text4" autocomplete="off" class="layui-input" ng-model="menudata.list[4].text">
								</div>
								<button class="layui-btn layui-btn-primary" ng-click="goup(4)" style="float:left">上移</button>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">链接</span>
									<div class="layui-input-inline" style="width:210px">
										<input type="text" name="pagePath4" autocomplete="off" class="layui-input" ng-model="menudata.list[4].pagePath">
									</div>
									<button class="layui-btn layui-btn-primary" ng-click="chooseUrl(4)" style="float:left">选择链接</button>
									<span class="layui-form-mid" style="width:200px;">&nbsp;{{menudata.list[4].pagePathname}}</span>
								</div>
								<div style="float: left;clear: both;padding-left: 130px;margin-top:5px">
									<span class="layui-form-mid">图标</span>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(4,1,'')">默认图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[4].iconPath}}"/>
									<button class="layui-btn layui-btn-primary" ng-click="uploadImg(4,2,'')">选中图标</button>
									<img style="width:38px;height:38px;" ng-src="{{menudata.list[4].selectedIconPath}}"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">文字默认颜色</label>
								<div class="layui-input-inline" style="width:134px">
									<input type="text" name="color" autocomplete="off" class="layui-input" ng-model="menudata.color">
								</div>
								<div class="colorpicker" ng-model="menudata.color"></div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">文字选中颜色</label>
								<div class="layui-input-inline" style="width:134px">
									<input type="text" name="selectedColor" autocomplete="off" class="layui-input" ng-model="menudata.selectedColor">
								</div>
								<div class="colorpicker" ng-model="menudata.selectedColor"></div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">菜单背景色</label>
								<div class="layui-input-inline" style="width:134px">
									<input type="text" name="backgroundColor" autocomplete="off" class="layui-input" ng-model="menudata.backgroundColor">
								</div>
								<div class="colorpicker" coloralpha="1" ng-model="menudata.backgroundColor"></div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">中间按钮突出</label>
								<div class="layui-input-inline" style="width:300px">
									<label><input type="radio" name="menustyle" value="0" title="关闭" ng-model="menudata.menustyle"  <?php if($menudata['menustyle']!=1): ?>checked<?php endif; ?>/></label>
									<label><input type="radio" name="menustyle" value="1" title="开启" ng-model="menudata.menustyle"  <?php if($menudata['menustyle']==1): ?>checked<?php endif; ?>/></label>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">同步到其他端</label>
								<div class="layui-input-inline" style="width:300px">
									<label><input type="radio" name="info[tongbu]" value="1" title="是" ng-model="tongbu" <?php if($info['tongbu']==1): ?>checked<?php endif; ?>/></label>
									<label><input type="radio" name="info[tongbu]" value="0" title="否" ng-model="tongbu" <?php if($info['tongbu']==0): ?>checked<?php endif; ?>/></label>
								</div>
							</div>
							<!-- <div class="layui-form-item">
								<label class="layui-form-label">上边框颜色</label>
								<div class="layui-input-inline" style="width:300px">
									<label><input type="radio" name="info[borderStyle]" value="black" title="黑色" ng-model="menudata.borderStyle" <?php if($menudata['borderStyle']=='black'): ?>checked<?php endif; ?>/></label>
									<label><input type="radio" name="info[borderStyle]" value="white" title="白色" ng-model="menudata.borderStyle" <?php if($menudata['borderStyle']=='white'): ?>checked<?php endif; ?>/></label>
								</div>
							</div> -->
						</div>
						
						<div class="layui-form-item">
							<label class="layui-form-label"></label>
							<div class="layui-input-block">
								<button class="layui-btn" ng-click="save(0)">保存</button>
								<!-- <button class="layui-btn" ng-click="save(1)">打包下载</button> -->
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
	<script src="/static/admin/js/jscolor.js"></script>
	<script type="text/javascript" src="/static/admin/js/angular.min.js"></script>
	<script type="text/javascript" src="/static/admin/js/angular-ueditor.js"></script>
	
	<script>
	var app = angular.module('myApp', ['ng.ueditor']);
	app.controller('personCtrl', function($scope) {
			$scope.indexurl = '<?php echo $info['indexurl']; ?>'; //启动页地址
			$scope.navigationBarBackgroundColor = '<?php echo $info['navigationBarBackgroundColor']; ?>'; //导航栏背景颜色
			$scope.navigationBarTextStyle = '<?php echo $info['navigationBarTextStyle']; ?>'; //导航栏标题颜色，仅支持 black / white
			$scope.menuselected = 0;
			$scope.menucount = <?php echo $info['menucount']; ?>;
			$scope.tongbu = <?php echo $info['tongbu']; ?>;
			$scope.menudata = <?php echo $info['menudata']; ?>,
			$scope.uploadImg = function(Mid,type,params){
				fileUploader.show(function(data){
					if(type==1){
						$scope.menudata.list[Mid].iconPath = data['url'] + params;
					}else{
						$scope.menudata.list[Mid].selectedIconPath = data['url'] + params;
					}
					$scope.$apply();
				}, {type :'image',maxheight:110,maxwidth:110});
			},
			$scope.chooseUrl = function(Mid){
				$('#floating-link').attr({"Mid":Mid});
				layer.open({type:2,shadeClose:true,area:['1200px', '650px'],'title':'选择链接',content:"<?php echo url('DesignerPage/chooseurl'); ?>/args/"+Mid})
			},
			$scope.goup = function(key){
				var oldlist = $scope.menudata.list
				var newlist = [];
				if(key==1){
					newlist.push(oldlist[1]);
					newlist.push(oldlist[0]);
					newlist.push(oldlist[2]);
					newlist.push(oldlist[3]);
					newlist.push(oldlist[4]);
				}
				if(key==2){
					newlist.push(oldlist[0]);
					newlist.push(oldlist[2]);
					newlist.push(oldlist[1]);
					newlist.push(oldlist[3]);
					newlist.push(oldlist[4]);
				}
				if(key==3){
					newlist.push(oldlist[0]);
					newlist.push(oldlist[1]);
					newlist.push(oldlist[3]);
					newlist.push(oldlist[2]);
					newlist.push(oldlist[4]);
				}
				if(key==4){
					newlist.push(oldlist[0]);
					newlist.push(oldlist[1]);
					newlist.push(oldlist[2]);
					newlist.push(oldlist[4]);
					newlist.push(oldlist[3]);
				}
				$scope.menudata.list = newlist
			}
			$scope.chooseLink = function(urlname,url,args){
				var Mid = args
				if(url){
					if(Mid == 'indexurl'){
						$scope.indexurl = url
					}else{
						$scope.menudata.list[Mid].pagePath = url;
						$scope.menudata.list[Mid].pagePathname = urlname;
						layer.closeAll();
					}
				}
			},
			$scope.menuselectedchange = function(index1){
				$scope.menuselected = index1
			},
			$scope.save = function(type){
				var field = new Object();
				field.navigationBarBackgroundColor = $scope.navigationBarBackgroundColor;
				field.navigationBarTextStyle = $scope.navigationBarTextStyle;
				field.menucount = $scope.menucount;
				field.tongbu = $scope.tongbu;
				field.menudata = $scope.menudata;
				field.indexurl = $scope.indexurl;
				var loadlay = layer.open({type:3})
				$.post("<?php echo url('save'); ?>/type/<?php echo $type; ?>",{info:field},function(data){
					if(type == 0){
						layer.close(loadlay);
						dialog(data.msg,data.status,data.url);
					}else{
						if(data.status==1){
							$.post("<?php echo url('download'); ?>",{},function(data){
								layer.close(loadlay);
								dialog(data.msg,data.status,data.url);
							})
						}else{
							layer.close(loadlay);
							dialog(data.msg,data.status);
						}
					}
				})
			}
	});
	function chooseLink(urlname,url,args) {
		var $scope = angular.element(document.querySelector('[ng-controller=personCtrl]')).scope();
		$scope.chooseLink(urlname,url,args);
		$scope.$apply();
	}
	</script>
	
</body>
</html>