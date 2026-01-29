<?php /*a:3:{s:60:"/www/wwwroot/guang.ailiutang.cn/app/view/web_system/set.html";i:1762426633;s:56:"/www/wwwroot/guang.ailiutang.cn/app/view/public/css.html";i:1762426633;s:55:"/www/wwwroot/guang.ailiutang.cn/app/view/public/js.html";i:1762426633;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>系统设置</title>
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
		.layui-popover{padding: 0px 10px;}
	</style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-card layui-col-md12">
				<div class="layui-card-header">
					<?php if($childmenu): ?>
					<div class="layui-tab layui-tab-brief">
						<ul class="layui-tab-title">
							<?php foreach($childmenu as $child): ?>
							<li <?php if($child['path'] == $thispath): ?>class="layui-this"<?php endif; ?> onclick="location.href='<?php echo url($child['path']); ?>'"><?php echo $child['name']; ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php else: ?>
					<?php echo $menuname; ?>
					<?php endif; if(input('param.isopen')==1): ?><i class="layui-icon layui-icon-close" style="font-size:18px;font-weight:bold;cursor:pointer" onclick="closeself()"></i><?php endif; ?>
				</div>
				<div class="layui-card-body" pad15>
					<div class="layui-form form-label-w8" lay-filter="">
						<blockquote class="layui-elem-quote" style="color:#333">
							<p>系统配置说明：</p>
							<p>一、添加计划任务（用于订单自动收货、订单超时取消、拼团成功失败、消息通知、分账等）</p>
							<div class="flex-y-center">在宝塔面板的计划任务中添加访问URL任务，执行周期选择每分钟执行一次，URL地址为：<b><?php echo $autourl; ?></b> 
								<div class="layui-popover layui-default-link layui-inline" onclick="copyText('<?php echo $autourl; ?>')">复制</div>
								<div class="layui-popover layui-default-link layui-inline">
									示例
									<div class="layui-popover-div">
										<img src="/static/admin/img/dianda_crontab.png" style="width: 600px" />
									</div>
								</div>
							</div>
							<div class="flex-y-center">二、配置客服系统（必须为https协议，php<?php echo $phpversion; ?>如果禁用了pcntl开头的函数需要解除禁用
							<div class="layui-popover layui-default-link layui-inline">
								示例
								<div class="layui-popover-div">
									<img src="/static/admin/img/dianda_set_dis_fun.png" style="width: 600px" />
								</div>
							</div>
								，用于实时接收用户的在线咨询消息，公众号窗口消息、商城内客服页面消息、小程序客服消息）</div>

							<?php if($servertype=='apache'): ?>
							<p>Apache环境在宝塔控制面板中点击[网站]-[设置]-[配置文件]，找到：SSLHonorCipherOrder On处，在下方增加：
<pre style="color:#000">
ProxyRequests Off
ProxyPass /wss ws://127.0.0.1:<?php echo $kfport; ?>

ProxyPassReverse /wss ws://127.0.0.1:<?php echo $kfport; ?>
</pre>
							<?php else: ?>
							<p>Nginx环境在宝塔控制面板中点击[网站]-[设置]-[配置文件]，增加以下两项信息
							<div>1、在最上方增加：
								<pre style="color:#000">upstream websocket<?php echo $kfport; ?>{ server 127.0.0.1:<?php echo $kfport; ?>; }</pre>
								<div class="layui-popover layui-default-link layui-inline" onclick="copyText('upstream websocket<?php echo $kfport; ?>{server 127.0.0.1:<?php echo $kfport; ?>;}')">复制</div>
								<div class="layui-popover layui-default-link layui-inline">
									示例
									<div class="layui-popover-div">
										<img src="/static/admin/img/dianda_siteset_1.png" style="width: 700px" />
									</div>
								</div>
							</div>
							<div>2、在server内最下方的access_log上方增加：
<pre style="color:#000">
location /wss{
    proxy_pass http://websocket<?php echo $kfport; ?>;
    proxy_read_timeout 60s;
    proxy_set_header Host $host;
    proxy_set_header X-Real_IP $remote_addr;
    proxy_set_header X-Forwarded-for $remote_addr;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection 'Upgrade';
}
</pre>
<div class="layui-popover layui-default-link layui-inline" 
	onclick="copyText(`location /wss{ proxy_pass http://websocket<?php echo $kfport; ?>;proxy_read_timeout 60s;proxy_set_header Host $host;proxy_set_header X-Real_IP $remote_addr;proxy_set_header X-Forwarded-for $remote_addr;proxy_http_version 1.1;proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection 'Upgrade';}`)">复制</div>
							<div class="layui-popover layui-default-link layui-inline">
								示例
								<div class="layui-popover-div">
									<img src="/static/admin/img/dianda_siteset_2.png" style="width: 600px" />
								</div>
							</div>
							</div>
							<?php endif; ?>
							<p>3、启动客服系统： 
							<div class="flex-y-center">如果安装了多个php版本，在宝塔面板[网站]-[PHP命令行版本] 切换为您的网站php版本:<?php echo $phpversion; ?><div class="layui-popover layui-default-link layui-inline">
							示例
							<div class="layui-popover-div">
								<img src="/static/admin/img/dianda_siteset_3.png" style="width: 600px" />
							</div>
						</div></div>
							<p>在宝塔面板用宝塔SSH终端软件进入终端，执行命令： 
							<div class="flex-y-center">
								<pre style="color:#000">php <?php echo ROOT_PATH; ?>think worker:server -d</pre>
								<div class="layui-popover layui-default-link layui-inline" onclick="copyText('php <?php echo ROOT_PATH; ?>think worker:server -d')">复制</div>
							</div>
							看到Start success.字样代表启动成功，如果出现setsid fail等字样请检查php<?php echo $phpversion; ?>的禁用函数中是否有pcntl_开头的函数,如果有请删除后重新执行
							<p>接收客服消息通知需要绑定公众号,并且配置公众号模板消息,由管理员绑定的微信端接收
							<p>如果要停止客服系统可执行<span style="color:#000;padding-left:10px">php <?php echo ROOT_PATH; ?>think worker:server stop</span><span class="layui-popover layui-default-link layui-inline" onclick="copyText('php <?php echo ROOT_PATH; ?>think worker:server stop')">复制</span></p>
							<!-- <p>如未安装宝塔，Linux系统执行crontab -e 加入 */1 * * * * curl <?php echo $autourl; ?> -->
							<!-- <p>三、异步消息通知（可选配置）：</p>
							<p>如果需要开启异步消息通知，在宝塔面板用宝塔SSH终端软件进入终端，执行命令：</p>
							<pre style="color:#000">启动 nohup php <?php echo ROOT_PATH; ?>think queue:listen --queue notification_job_queue >/dev/null</pre>
							<pre style="color:#000">停止 php <?php echo ROOT_PATH; ?>think queue:restart</pre> -->

						</blockquote>
						<div class="layui-form-item" style="margin-top:30px">
							<label class="layui-form-label">系统名称</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[webname]" value="<?php echo $info['webname']; ?>" lay-verify="required" lay-verType="tips" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">LOGO</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[logo]" id="logo" class="layui-input" value="<?php echo $info['logo']; ?>">
							</div>
							<button style="float:left;" type="button" class="layui-btn layui-btn-primary" onclick="uploader(this)" upload-input="logo" upload-preview="logoPreview">上传图片</button>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">建议尺寸：108×108像素</div>
							<div id="logoPreview" style="float:left;padding-top:10px;margin-left:160px;clear: both;">
								<div class="layui-imgbox"><div class="layui-imgbox-img"><img src="<?php echo $info['logo']; ?>"/></div></div>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">ico图标</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[ico]" id="ico" class="layui-input" value="<?php echo $info['ico']; ?>">
							</div>
							<button style="float:left;" type="button" class="layui-btn layui-btn-primary" onclick="uploader(this)" upload-input="ico" upload-preview="icoPreview">上传图片</button>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;"></div>
							<div id="icoPreview" style="float:left;padding-top:10px;margin-left:160px;clear: both;">
								<div class="layui-imgbox" style="width:44px;height:44px"><div class="layui-imgbox-img"><img src="<?php echo $info['ico']; ?>"/></div></div>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">登录页背景图</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[adminloginbg]" id="adminloginbg" class="layui-input" value="<?php echo $info['adminloginbg']; ?>">
							</div>
							<button style="float:left;" type="button" class="layui-btn layui-btn-primary" onclick="uploader(this)" maxwidth="2500" maxheight="2000" upload-input="adminloginbg" upload-preview="adminloginbgPreview">上传图片</button>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">建议尺寸：1920×1080像素</div>
							<div id="adminloginbgPreview" style="float:left;padding-top:10px;margin-left:160px;clear: both;">
								<div class="layui-imgbox" style="width:144px;height:90px"><div class="layui-imgbox-img"><img src="<?php echo $info['adminloginbg']; ?>"/></div></div>
							</div>
						</div>
						
						<div class="layui-form-item">
							<label class="layui-form-label">版权设置</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[copyright]" class="layui-input" value="<?php echo $info['copyright']; ?>"/>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">备案号</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[beian]" class="layui-input" value="<?php echo $info['beian']; ?>"/>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">公安备案文字</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[copyright2]" class="layui-input" value="<?php echo $info['copyright2']; ?>" placeholder="公网安备1001号"/>
							</div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">官网底部显示</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">公安备案号</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[beian2]" class="layui-input" value="<?php echo $info['beian2']; ?>" placeholder="1001"/>
							</div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">点击“公安备案文字”跳转链接，拼接此备案号</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">官网：</label>
							<div class="layui-input-inline" style="width:400px">
								<input type="radio" name="info[showweb]" value="1" <?php if($info['showweb']==1): ?>checked<?php endif; ?> title="模板一" lay-filter="showweb">
								<input type="radio" name="info[showweb]" value="2" <?php if($info['showweb']==2): ?>checked<?php endif; ?> title="模板二" lay-filter="showweb">
								<input type="radio" name="info[showweb]" value="0" <?php if($info['showweb']==0): ?>checked<?php endif; ?> title="关闭" lay-filter="showweb">
							</div>
							<div class="layui-form-mid layui-word-aux"></div>
						</div>
						<div id="showwebset" style="<?php if($info['showweb']==0): ?>display:none<?php endif; ?>">

							<div class="layui-form-item">
								<label class="layui-form-label">企业名称</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[company]" class="layui-input" value="<?php echo $info['company']; ?>"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">地址</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[address]" class="layui-input" value="<?php echo $info['address']; ?>"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">邮箱</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[email]" class="layui-input" value="<?php echo $info['email']; ?>"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">电话</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[tel]" class="layui-input" value="<?php echo $info['tel']; ?>"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">微信</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[weixin]" class="layui-input" value="<?php echo $info['weixin']; ?>"/>
								</div>
							</div>
						</div>
						
						<?php if($component['status']==1): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">快速注册小程序 </label>
							<div class="layui-input-inline" style="width:200px">
								<input type="radio" name="info[fastregxcx]" value="1" <?php if($info['fastregxcx']!=2): ?>checked<?php endif; ?>
									title="开启">
								<input type="radio" name="info[fastregxcx]" value="2" <?php if($info['fastregxcx']==2): ?>checked<?php endif; ?>
									title="关闭">
							</div>
						</div>
						<?php endif; if((!getcustom('admin_user_hide'))): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">开启注册 </label>
							<div class="layui-input-inline" style="width:300px">
								<input type="radio" name="info[reg_open]" value="1" <?php if($info['reg_open']==1): ?>checked<?php endif; ?>
								title="开启" lay-filter="regopen">
								<input type="radio" name="info[reg_open]" value="0" <?php if($info['reg_open']==0): ?>checked<?php endif; ?>
								title="关闭" lay-filter="regopen">
							</div>
						</div>
						<div id="regopenset" style="<?php if($info['reg_open']==0): ?>display:none<?php endif; ?>">
							<div class="layui-form-item">
								<label class="layui-form-label">注册协议链接</label>
								<div class="layui-input-inline" style="width:300px">
									<input type="text" name="info[reg_user_agreement_url]" class="layui-input" value="<?php echo $info['reg_user_agreement_url']; ?>"/>
								</div>
								<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">请填写链接地址</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">注册会员有效期</label>
								<div class="layui-input-inline" style="width:200px">
									<input type="number" min="1" max="365" name="info[reg_user_time]" class="layui-input" value="<?php echo $info['reg_user_time']; ?>"/>
								</div>
								<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">天</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">注册短信验证码 </label>
								<div class="layui-input-inline" style="width:200px">
									<input type="radio" name="info[sms_open]" value="1" <?php if($info['sms_open']==1): ?>checked<?php endif; ?>
										title="开启" lay-filter="sms_open">
									<input type="radio" name="info[sms_open]" value="0" <?php if($info['sms_open']==0): ?>checked<?php endif; ?>
										title="关闭" lay-filter="sms_open">
								</div>
								<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">短信配置请在客户端[系统]-[短信设置]中配置</div>
							</div>

							<!-- <div class="layui-form-item">
								<label class="layui-form-label">消息通知 </label>
								<div class="layui-input-inline" style="width:200px">
									<input type="radio" name="info[notification_queue]" value="0" <?php if($info['notification_queue']==0 || $info['notification_queue']==''): ?>checked<?php endif; ?>
									title="同步" >
									<input type="radio" name="info[notification_queue]" value="1" <?php if($info['notification_queue']==1): ?>checked<?php endif; ?>
									title="异步" >
								</div>
								<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">异步消息通知可提高性能，选择异步需要按照上方第三条说明执行服务器命令</div>
							</div> -->
						</div>
						<?php endif; ?>
						

						<div class="layui-form-item">
							<label class="layui-form-label">快递查询AppCode</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[ali_appcode]" class="layui-input" value="<?php echo $info['ali_appcode']; ?>"/>
							</div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">用于用户查询快递物流状态，请先在阿里云购买快递查询接口，然后在[阿里云控制台 - 云市场 - 已购买的服务]中查找AppCode，<a  href="https://market.aliyun.com/products/57126001/cmapi021863.html#sku=yuncode15863000017" target="_blank">去购买</a></div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">腾讯地图key</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[map_key_qq]" class="layui-input" value="<?php echo $info['map_key_qq']; ?>"/>
							</div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">必须，[腾讯位置服务控制台 - 应用管理 - 我的应用]中创建应用，添加 key，勾选“WebServiceAPI” <a href="https://lbs.qq.com/webApi/javascriptGL/glGuide/glBasic" target="_blank">使用帮助</a>，<br>并设置配额管理【腾讯地图控制台-配额管理-账户额度-配额分配】（逆地址解析，地址解析，骑行（电动车）路线规划，关键词输入提示，地点搜索，坐标转换）<a href="https://lbs.qq.com/service/webService/webServiceGuide/webServiceQuota" target="_blank">配额限制说明</a> </div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">高德地图key</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[map_key_amap]" class="layui-input" value="<?php echo $info['map_key_amap']; ?>"/>
							</div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">必须，[高德开放平台控制台 - 应用管理 - 我的应用]中创建应用，添加 key，服务平台选择 Web端(JS API) <a href="https://lbs.amap.com/api/javascript-api-v2/prerequisites" target="_blank">使用帮助</a></div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">高德地图安全密钥</label>
							<div class="layui-input-inline" style="width:300px">
								<input type="text" name="info[js_code_amap]" class="layui-input" value="<?php echo $info['js_code_amap']; ?>"/>
							</div>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">必须，高德自2021年12月02日升级，升级之后所申请的 key 必须配备安全密钥(jscode)一起使用，升级之前申请的key不需要配置安全密钥(jscode)<a target="_blank" href="https://lbs.amap.com/api/javascript-api/guide/abc/prepare">使用帮助</a></div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">分红结算方式 </label>
							<div class="layui-input-inline" style="width:300px">
								<input type="radio" name="info[jiesuan_fenhong_type]" value="1" <?php if($info['jiesuan_fenhong_type']==1): ?>checked<?php endif; ?>
								title="异步模式">
								<input type="radio" name="info[jiesuan_fenhong_type]" value="0" <?php if($info['jiesuan_fenhong_type']==0): ?>checked<?php endif; ?>
								title="同步模式">
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear" >
								一、同步模式：创建订单后立即同步预结算分红数据<br/>
								优点：可实时预结算分红数据<br/>
								缺点：如果网体可获取分红会员数量过大会导致提交订单页面卡顿，甚至执行超时页面报错从而无法提交订单。<br/>
								二、异步模式：正常创建订单，订单支付成功之后通过计划任务shell脚本进行异步预结算分红数据。<br/>
								优点：不影响页面用户体验<br/>
								缺点：需要设置计划任务脚本配合使用，结算分红时间会略有延迟。<br/>
								异步计划任务设置方式：登录宝塔-计划任务-添加任务-任务类型选择shell脚本-执行周期设置每分钟执行一次，<br/>
								脚本内容：<?php echo $crons; ?><div class="layui-popover layui-default-link layui-inline" onclick="copyText('<?php echo $crons; ?>')">复制</div>
								<div class="layui-popover layui-default-link layui-inline">
									示例
									<div class="layui-popover-div">
										<img src="/static/admin/img/dianda_jiesuan.png" style="width: 600px" />
									</div>
								</div>
								<br/>
							</div>

						</div>
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
	
	layui.form.on('radio(showweb)', function(data){
		if(data.value == '0'){
			$('#showwebset').hide();
		}else{
			$('#showwebset').show();
		}
	})
	layui.form.on('radio(regopen)', function(data){
		if(data.value == '0'){
			$('#regopenset').hide();
		}else{
			$('#regopenset').show();
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