<?php /*a:5:{s:63:"/www/wwwroot/guang.ailiutang.cn/app/view/member_level/edit.html";i:1762426633;s:56:"/www/wwwroot/guang.ailiutang.cn/app/view/public/css.html";i:1762426633;s:83:"/www/wwwroot/guang.ailiutang.cn/app/view/member_level/up_fxorder_condition_new.html";i:1762426633;s:55:"/www/wwwroot/guang.ailiutang.cn/app/view/public/js.html";i:1762426633;s:62:"/www/wwwroot/guang.ailiutang.cn/app/view/public/copyright.html";i:1762426633;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo t('会员'); ?>等级设置</title>
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
	#ggtable .layui-input{ display:inline;}
	#ggtable .layui-btn{ margin-top:-3px;margin-left:1px}
	.layui-imgbox .layui-imgbox-close{z-index: 6;}
	</style>
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-card layui-col-md12">
				<div class="layui-card-header">
					<?php if(!$info['id']): ?><i class="fa fa-plus"></i> 添加<?php echo t('会员'); ?>等级<?php else: ?><i class="fa fa-pencil"></i> 编辑<?php echo t('会员'); ?>等级<?php endif; ?>
					<i class="layui-icon layui-icon-close" style="font-size:18px;font-weight:bold;cursor:pointer" onclick="closeself()"></i>
				</div>
				<div class="layui-card-body" pad15>
					<div class="layui-form form-label-w8" lay-filter="">
						<input type="hidden" name="info[id]" value="<?php echo $info['id']; ?>"/>
						<span style="color:#333">基础设置</span><hr/>
						<div class="layui-form-item">
							<label class="layui-form-label">排序</label>
							<div class="layui-input-inline">
								<input type="text" name="info[sort]" lay-verify="required" lay-verType="tips" class="layui-input" value="<?php echo $info['sort']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">用于升级顺序判断，数字越大等级越高</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">等级名称</label>
							<div class="layui-input-inline">
								<input type="text" name="info[name]" class="layui-input" value="<?php echo $info['name']; ?>" lay-verify="required" lay-verType="tips">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">等级图标</label>
							<button style="float:left;" type="button" class="layui-btn layui-btn-primary" onclick="uploader(this)" upload-input="icon" upload-preview="iconPreview">上传图片</button>
							<div class="layui-form-mid layui-word-aux" style="margin-left:10px;">建议尺寸：50×50像素</div>
							<div id="iconPreview" class="picsList-class-padding">
								<div class="layui-imgbox imgbox-required">
									<a <?php if($info['icon']): ?>style="display: block;" <?php else: ?> style="display: none;"  <?php endif; ?> class="layui-imgbox-close" href="javascript:void(0)" onclick="$(this).parent().find('img').attr('src','').hide();getpicsval('icon','picPreview');$(this).hide();" title="删除"><i class="layui-icon layui-icon-close-fill-opaque"></i></a>
									<div class="layui-imgbox-img">
										<img src="<?php echo $info['icon']; ?>"/>
									</div>
									<input autocomplete='off' type="text" id="icon" name="info[icon]" lay-verType="tips" value="<?php echo $info['icon']; ?>" style="cursor:default;">
								</div>
							</div>
						</div>
						<?php if(getcustom('plug_sanyang')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">分组</label>
							<div class="layui-input-inline">
								<select name="info[cid]" lay-filter="changeCategory">
									<?php foreach($catList as $v): ?>
									<option value="<?php echo $v['id']; ?>" <?php if($v['id'] == $info['cid']): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option>
									<?php endforeach; ?>
								</select>
								<input type="hidden" name="default_cat_id" id="default_cat_id" value="<?php echo $default_cat['id']; ?>">
							</div>
						</div>
						<?php endif; ?>
						<div class="layui-form-item notDefaultShow" <?php if(!$isdefault_cat): ?> style="display: none;" <?php endif; ?>>
							<label class="layui-form-label">等级折扣</label>
							<div class="layui-input-inline">
								<input type="text" name="info[discount]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['discount'] : 10; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">购买商品时打多少折,10表示不打折,9.5表示打九五折</div>
						</div>

					<?php if(getcustom('member_level_price_rate')): ?>
					<div class="layui-form-item notDefaultShow" <?php if(!$isdefault_cat): ?> style="display: none;" <?php endif; ?>>
						<label class="layui-form-label">价格倍率</label>
						<div class="layui-input-inline">
							<input type="text" name="info[price_rate]" class="layui-input" value="<?php echo !empty($info['price_rate']) ? $info['price_rate'] : 1; ?>">
						</div>
						<div class="layui-form-mid layui-word-aux">等级价格倍率，开启会员价后可使用此费率计算填充价格（成本价*费率）</div>
					</div>
			  		<?php endif; if(getcustom('member_level_close_jicha')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">购物级差</label>
						  <div class="layui-input-inline">
							  <input type="radio" name="info[isclose_jicha]" value="0" title="开启" <?php if(!$info['id'] || $info['isclose_jicha']==0): ?>checked<?php endif; ?>>
							  <input type="radio" name="info[isclose_jicha]" value="1" title="关闭" <?php if($info['isclose_jicha']==1): ?>checked<?php endif; ?>>
						  </div>
						  <div class="layui-form-mid layui-word-aux">关闭后，该等级会员购买商品，上级将不再有级差奖</div>
					  </div>
					  <?php endif; if(getcustom('member_friend')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">加好友</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[is_add_friend]" value="1" title="开启" <?php if($info['is_add_friend']==1): ?>checked<?php endif; ?>>
								<input type="radio" name="info[is_add_friend]" value="0" title="关闭" <?php if(!$info['id'] || $info['is_add_friend']==0): ?>checked<?php endif; ?>>
							</div>
							<div class="layui-form-mid layui-word-aux">开启后，该等级下的会员，可进行添加好友操作</div>
						</div>
						<?php endif; if(getcustom('kecheng_discount')): ?>
						<div class="layui-form-item notDefaultShow" <?php if(!$isdefault_cat): ?> style="display: none;" <?php endif; ?>>
							<label class="layui-form-label">知识付费等级折扣</label>
							<div class="layui-input-inline">
								<input type="text" name="info[kecheng_discount]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['kecheng_discount'] : 10; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">购买知识付费商品时打多少折,10表示不打折,9.5表示打九五折</div>
						</div>
						<?php endif; if(getcustom('level_product_show_image')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">限制大图</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[show_image]" value="1" title="开启" <?php if($info['show_image']==1): ?>checked<?php endif; ?>>
								<input type="radio" name="info[show_image]" value="0" title="关闭" <?php if(!$info['id'] || $info['show_image']==0): ?>checked<?php endif; ?>>
							</div>
							<div class="layui-form-mid layui-word-aux">开启后，产品详情图片模糊 点击跳转到会员升级</div>
						</div>
						<?php endif; if(getcustom('level_business_apply')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">商户入驻</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[business_apply]" value="1" title="开启" <?php if(!$info['id'] || $info['business_apply']==1): ?>checked<?php endif; ?>>
								<input type="radio" name="info[business_apply]" value="0" title="关闭" <?php if($info['business_apply']==0): ?>checked<?php endif; ?>>
							</div>
							<div class="layui-form-mid layui-word-aux">关闭后该等级无法申请入驻商户</div>
						</div>
						<?php endif; if($info['isdefault'] != 1): ?>
						<div class="layui-form-item notDefaultShow" <?php if(!$isdefault_cat): ?> style="display: none;" <?php endif; ?>>
							<label class="layui-form-label">人数限制</label>
							<div class="layui-input-inline">
								<input type="text" name="info[maxnum]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['maxnum'] : 0; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">达到人数限制将不可申请和自动升级到该等级,0表示不限制</div>
						</div>
						<?php if(getcustom('commission_recursion')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label">直推复购奖</label>
							  <div class="layui-input-inline" style="width: 50%;">
								  <input type="radio" name="info[is_fugou_commission]" value="1" title="是" <?php if($info['is_fugou_commission']==1): ?>checked<?php endif; ?> lay-filter="is_fugou_commission">
								  <input type="radio" name="info[is_fugou_commission]" value="0" title="否" <?php if($info['is_fugou_commission']==0 || $info['is_fugou_commission']==''): ?>checked<?php endif; ?> lay-filter="is_fugou_commission">
							  </div>
						  </div>
						<?php endif; if(getcustom('member_level_price_show')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">商品处显示<?php echo t('会员'); ?>价</label>
						  <div class="layui-input-inline">
							  <input type="radio" name="info[price_show]" value="1" title="开启" <?php if($info['price_show']==1): ?>checked<?php endif; ?> lay-filter="price_show">
							  <input type="radio" name="info[price_show]" value="0" title="关闭" <?php if(!$info['price_show']): ?>checked<?php endif; ?> lay-filter="price_show">
						  </div>
						  <div class="layui-form-mid layui-word-aux">开启，则此等级在开启会员价的商城商品<?php if(getcustom('restaurant')): ?>、餐饮商品(点餐、外卖)<?php endif; ?>列表、详情页面显示等级价格</div>
					  </div>
					  <div class="layui-form-item" id="priceshowtextset"  style="<?php if(!$info['price_show'] || $info['price_show']!=1): ?>display: none;<?php endif; ?>" >
						  <label class="layui-form-label">此等级价格小字</label>
						  <div class="layui-input-inline" >
						  	<input type="text" name="info[price_show_text]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['price_show_text'] : ''; ?>">
						  </div>
						  <div class="layui-form-mid layui-word-aux">显示在价格后面的文字，如: ￥20 会员价</div>
					  </div>
					  <?php endif; if(getcustom('level_shop_title')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">首页标题</label>
						  <div class="layui-input-inline">
							  <input type="text" name="info[home_title]" class="layui-input" value="<?php echo $info['home_title']; ?>">
						  </div>
						  <div class="layui-form-mid layui-word-aux">留空则不覆盖原有标题</div>
					  </div>
					  <?php endif; ?>

						<span style="color:#333">升级设置</span><hr/>
						<div class="layui-form-item">
							<label class="layui-form-label">是否可申请</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[can_apply]" value="1" title="是" <?php if($info['can_apply']==1): ?>checked<?php endif; ?> lay-filter="can_apply">
								<input type="radio" name="info[can_apply]" value="0" title="否" <?php if($info['can_apply']!=1): ?>checked<?php endif; ?> lay-filter="can_apply">
							</div>
							<div class="layui-form-mid layui-word-aux">是否可以由用户主动提交申请资料申请成为该级别</div>
						</div>
						<div id="can_applyset" style="border:0px dashed #f0cccc;padding-top:10px;margin-bottom:20px;<?php if($info['can_apply']!=1): ?>display:none<?php endif; ?>">
							<div class="layui-form-item">
								<label class="layui-form-label">申请条件</label>
								<!-- <div class="layui-input-inline layui-module-itemL">
										<div>微信支付金额满</div>
									<input type="text" name="info[apply_wxpaymoney]" class="layui-input" value="<?php echo $info['apply_wxpaymoney']; ?>">
								</div> -->
								
								<div class="layui-input-inline layui-module-itemL">
									<div>订单金额满</div>
									<input type="text" name="info[apply_ordermoney]" class="layui-input" value="<?php echo $info['apply_ordermoney']; ?>">
									或
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>充值金额满</div>
									<input type="text" name="info[apply_rechargemoney]" class="layui-input" value="<?php echo $info['apply_rechargemoney']; ?>">
									<?php if(getcustom('levelup_code')): ?>
									或
									<?php endif; ?>
								</div>
								<?php if(getcustom('levelup_code')): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>验证码</div>
									<input type="text" name="info[apply_code]" class="layui-input" value="<?php echo $info['apply_code']; ?>">
								</div>
								<?php endif; if(getcustom('taocan_product')): ?>
								<div class="layui-input-inline layui-module-itemL">
									或&nbsp;
									<div>购买套餐商品ID</div>
									<input type="text" name="info[apply_taocan_proid]" class="layui-input" value="<?php echo $info['apply_taocan_proid']; ?>">
								</div>
								<?php endif; ?>
								<div class="layui-form-mid layui-word-aux layui-clear">用户申请成为该级别需要满足的条件，不填写则不需要申请条件</div>
							</div>
							<div class="layui-form-item" style="margin-bottom:0">
								<label class="layui-form-label">升级费用</label>
								<div class="layui-input-inline">
									<input type="text" name="info[apply_paymoney]" class="layui-input" value="<?php echo $info['apply_paymoney']; ?>">
								</div>
								<div class="layui-form-mid ">元</div>
								<div style="float:left;">
									<div class="layui-form-mid">自定义文字</div>
									<div class="layui-input-inline" style="width:100px"><input type="text" name="info[apply_paytxt]" value="<?php echo (isset($info['apply_paytxt']) && ($info['apply_paytxt'] !== '')?$info['apply_paytxt']:'升级费用'); ?>" class="layui-input"></div>
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">提交申请时需要交升级费,0代表免费申请</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">升级费用分销</label>
								<div class="layui-input-inline" style="width:430px">
									<input type="radio" name="info[apply_payfenxiao]" value="1" title="跟随分销设置" <?php if($info['apply_payfenxiao']==1): ?>checked<?php endif; ?> lay-filter="apply_payfenxiao">
									<?php if(getcustom('member_level_paymoney_commissionfrozenset')): ?>
									<input type="radio" name="info[apply_payfenxiao]" value="2" title="单独设置直推分销" <?php if($info['apply_payfenxiao']==2): ?>checked<?php endif; ?> lay-filter="apply_payfenxiao">
									<?php endif; ?>
									<input type="radio" name="info[apply_payfenxiao]" value="0" title="不参与分销" <?php if(!$info['apply_payfenxiao']): ?>checked<?php endif; ?> lay-filter="apply_payfenxiao">
								</div>
								<div class="layui-form-mid layui-word-aux">升级费用是否参与分销</div>
							</div>
							<?php if(getcustom('member_level_paymoney_commissionfrozenset')): ?>
							<div id="paymoney_commissionset" style="display:<?php if($info['apply_payfenxiao']!=2): ?>none<?php endif; ?>">
								<div class="layui-form-item">
									<label class="layui-form-label">直推上级佣金(%)</label>
									<div class="layui-input-inline">
										<input type="text" name="info[apply_paymoney_commission1]" class="layui-input" value="<?php echo $info['apply_paymoney_commission1']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">直推上级且有分销权限，则获得此升级比例的佣金</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">上级佣金冻结比例(%)</label>
									<div class="layui-input-inline">
										<input type="text" name="info[apply_paymoney_commission1_frozenpercent]" class="layui-input" value="<?php echo $info['apply_paymoney_commission1_frozenpercent']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">填写比例后，将按此比例冻结部分佣金到扶持金中(需要控制台给用户扶持金权限)，同时解冻上级之前所有的冻结佣金；
										<br>若无佣金和冻结佣金产生，依然会解冻上级之前所有的冻结佣金(包含扶持金冻结的佣金)
									</div>
								</div>
							</div>
							<?php endif; if(getcustom('gdfenhong_level')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">升级费用<?php echo t('股东分红'); ?></label>
								<div class="layui-input-inline">
									<input type="radio" name="info[apply_paygudong]" value="1" title="是" <?php if($info['apply_paygudong']==1): ?>checked<?php endif; ?>>
									<input type="radio" name="info[apply_paygudong]" value="0" title="否" <?php if($info['apply_paygudong']!=1): ?>checked<?php endif; ?>>
								</div>
								<div class="layui-form-mid layui-word-aux">升级费用是否参与<?php echo t('股东分红'); ?></div>
							</div>
							<?php endif; ?>
							<div class="layui-form-item">
								<label class="layui-form-label">申请资料需要审核</label>
								<div class="layui-input-inline">
									<input type="radio" name="info[apply_check]" value="1" title="是" <?php if($info['apply_check']==1): ?>checked<?php endif; ?>>
									<input type="radio" name="info[apply_check]" value="0" title="否" <?php if($info['apply_check']!=1): ?>checked<?php endif; ?>>
								</div>
								<div class="layui-form-mid layui-word-aux">申请资料是否需要后台审核</div>
							</div>
							<div class="layui-form-item">
							<label class="layui-form-label">申请资料设置</label>
							<div class="layui-input-inline" style="width:880px !important">
								<div class="layui-form-item">
									<!-- <label class="layui-form-label" style="width:100px">添加表单项：</label> -->
									<div class="layui-input-inline" style="width:auto;margin-top:5px">
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('input','','',1)"><i class="icon-plus"></i>单行输入</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('textarea','','',1)"><i class="icon-plus"></i>多行输入</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('radio','','',1)"><i class="icon-plus"></i>单项选择</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('checkbox','','',1)"><i class="icon-plus"></i>多项选择</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('selector','','',1)"><i class="icon-plus"></i>普通选择</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('time','','',1)"><i class="icon-plus"></i>时间选择</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('date','','',1)"><i class="icon-plus"></i>日期选择</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('region','','',1)"><i class="icon-plus"></i>省市区选择</button>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addelement('upload','','',1)"><i class="icon-plus"></i>上传图片</button>
										<?php if(getcustom('member_level_add_apply_mendian')): ?>
										<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addmendian()"><i class="icon-plus"></i><?php echo t('门店'); ?>申请设置</button>
										<?php endif; ?>
									</div>
								</div>
								<table class="layui-table" style="width:900px" id="ggtable">
									<thead>
									<tr>
										<th style="width:100px">字段类型</th>
										<th style="width:150px">字段名称</th>
										<th style="width:280px">字段内容</th>
										<th style="width:150px">是否必填</th>
										<th style="width:170px">操作</th>
									</tr>
									</thead>
									<tbody id="datatable">

									</tbody>
								</table>
							</div>
						</div>
						</div>
						<!--can_applyset end-->
						<div class="layui-form-item">
							<label class="layui-form-label">是否可自动升级</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[can_up]" value="1" title="是" <?php if($info['can_up']==1): ?>checked<?php endif; ?> lay-filter="can_up">
								<input type="radio" name="info[can_up]" value="0" title="否" <?php if($info['can_up']!=1): ?>checked<?php endif; ?> lay-filter="can_up">
							</div>
							<div class="layui-form-mid layui-word-aux">开启后则达到设置条件自动升级为该级别</div>
						</div>

						<div id="can_upset" style="border:0px dashed #f0cccc;padding-top:10px;margin-bottom:20px;<?php if($info['can_up']!=1): ?>display:none<?php endif; ?>">
						<div class="layui-form-item">
							<label class="layui-form-label">自动升级条件显示</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[up_condition_show]" value="1" title="显示" <?php if($info['up_condition_show']==1): ?>checked<?php endif; ?>>
								<input type="radio" name="info[up_condition_show]" value="0" title="隐藏" <?php if($info['up_condition_show']!=1): ?>checked<?php endif; ?>>
							</div>
							<div class="layui-form-mid layui-word-aux">控制前端是否显示升级条件</div>
						</div>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">升级条件</label>
							
							<div class="layui-input-inline layui-module-itemL">
								<div>微信支付累计金额满</div>
								<input type="text" name="info[up_wxpaymoney]" class="layui-input" value="<?php echo $info['up_wxpaymoney']; ?>">
								或
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>商城订单金额累计满</div>
								<input type="text" name="info[up_ordermoney]" class="layui-input" value="<?php echo $info['up_ordermoney']; ?>">
								或
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>充值金额累计满</div>
								<input type="text" name="info[up_rechargemoney]" class="layui-input" value="<?php echo $info['up_rechargemoney']; ?>">
								或
							</div>
							<?php if(getcustom('levelup_perpaymoney')): ?>
							<div class="layui-input-inline layui-module-itemL">
								<div>单次消费满</div>
								<input type="text" name="info[up_perpaymoney]" class="layui-input" value="<?php echo $info['up_perpaymoney']; ?>">
								或
							</div>
							<?php endif; ?>
							<div class="layui-module-color">领取会员卡</div>
							<div class="layui-input-inline" style="width: 100px;margin-left: 5px;">
								<input type="checkbox" name="info[up_getmembercard]" value="1" lay-text="开启|关闭" lay-skin="switch" <?php if($info['up_getmembercard']==1): ?>checked<?php endif; ?>>
							</div>
						</div>

						<?php if(getcustom('member_levelup_orderprice')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
								<select name="info[up_orderprice_condition]">
									<option value="or" <?php if($info['up_orderprice_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
									<option value="and" <?php if($info['up_orderprice_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
								</select>
							</div>

							<div class="layui-input-inline layui-module-itemL">
								<div>单次订单金额满</div>
								<input type="text" name="info[up_orderprice]" class="layui-input" value="<?php echo $info['up_orderprice']; ?>">
							</div>
						</div>
						<?php endif; ?>

						<div class="layui-form-item" style="margin-bottom:5px">
							<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
								<select name="info[up_fxorder_condition]">
									<option value="or" <?php if($info['up_fxorder_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
									<option value="and" <?php if($info['up_fxorder_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
								</select>
							</div>
<!--							<label class="layui-form-label">或</label>-->
							<div class="layui-input-inline layui-module-itemL">
								<div>下级订单总金额满</div>
								<input type="text" name="info[up_fxordermoney]" class="layui-input" value="<?php echo $info['up_fxordermoney']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>级数</div>
								<input type="text" name="info[up_fxorderlevelnum]" class="layui-input" value="<?php echo $info['up_fxorderlevelnum']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL" style="margin-right: 0;">
								<div>等级ID</div>
								<input type="text" name="info[up_fxorderlevelid]" class="layui-input" value="<?php echo $info['up_fxorderlevelid']; ?>">
							</div>
							<?php if(getcustom('commission2scorepercent')): ?>
							<div class="layui-form-mid" style="margin-left:20px">移除伞下最高业绩的下级</div>
							<div class="layui-input-inline" style="width:180px">
								<input type="radio" name="info[up_fxordermoney_removemax]" value="0" <?php if($info['up_fxordermoney_removemax']==0): ?>checked<?php endif; ?> title="关闭"/>
								<input type="radio" name="info[up_fxordermoney_removemax]" value="1" <?php if($info['up_fxordermoney_removemax']==1): ?>checked<?php endif; ?> title="开启"/>
							</div>
							<?php endif; if(getcustom('levelup_fxordermoney_self')): ?>
							<div class="layui-form-mid" style="margin-left:20px">包含自己</div>
							<div class="layui-input-inline" style="width:180px">
								<input type="radio" name="info[up_fxordermoney_self]" value="0" <?php if($info['up_fxordermoney_self']==0): ?>checked<?php endif; ?> title="关闭"/>
								<input type="radio" name="info[up_fxordermoney_self]" value="1" <?php if($info['up_fxordermoney_self']==1): ?>checked<?php endif; ?> title="开启"/>
							</div>
							<?php endif; ?>
							<div class="layui-form-mid layui-word-aux">下级不含自己；级数和等级ID：0表示不限制等级</div>
						</div>
						<?php if(getcustom('plug_ttdz')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<div class="layui-input-inline layui-module-itemL">
								或
								<div>下级小区订单金额满</div>
								<input type="text" name="info[up_fxordermoney_xiao]" class="layui-input" value="<?php echo $info['up_fxordermoney_xiao']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>级数</div>
								<input type="text" name="info[up_fxorderlevelnum_xiao]" class="layui-input" value="<?php echo $info['up_fxorderlevelnum_xiao']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>等级ID</div>
								<input type="text" name="info[up_fxorderlevelid_xiao]" class="layui-input" value="<?php echo $info['up_fxorderlevelid_xiao']; ?>">
							</div>
							<div class="layui-form-mid">级数和等级ID：0表示不限制等级（小区指即除了人数最多的区以外的其他区）</div>
						</div>
						<?php endif; ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">或</label>
							<div class="layui-input-inline layui-module-itemL">
								<div>下级总人数满</div>
								<input type="text" name="info[up_fxdowncount]" class="layui-input" value="<?php echo $info['up_fxdowncount']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>级数</div>
								<input type="text" name="info[up_fxdownlevelnum]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>等级ID</div>
								<input type="text" name="info[up_fxdownlevelid]" class="layui-input" value="<?php echo $info['up_fxdownlevelid']; ?>">
								且
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>下级总人数满</div>
								<input type="text" name="info[up_fxdowncount2]" class="layui-input" value="<?php echo $info['up_fxdowncount2']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>级数</div>
								<input type="text" name="info[up_fxdownlevelnum2]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum2']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>等级ID</div>
								<input type="text" name="info[up_fxdownlevelid2]" class="layui-input" value="<?php echo $info['up_fxdownlevelid2']; ?>">
								<?php if(getcustom('level_comwithdraw')): ?>
								且
								<?php endif; ?>
							</div>
							<?php if(getcustom('level_comwithdraw')): ?>
								<div class="layui-input-inline layui-module-itemL" style="margin-right: 0px;">
									<div>下级总人数满</div>
									<input type="text" name="info[up_fxdowncount3]" class="layui-input" value="<?php echo $info['up_fxdowncount3']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL" style="margin-right: 0px;">
									<div>级数</div>
									<input type="text" name="info[up_fxdownlevelnum3]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum3']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL"  style="margin-right: 0px;">
									<div>等级ID</div>
									<input type="text" name="info[up_fxdownlevelid3]" class="layui-input" value="<?php echo $info['up_fxdownlevelid3']; ?>">
								</div>
							<?php endif; ?>
						</div>
						<div class="layui-form-item" style="margin-bottom:5px">
							<?php if(getcustom('up_fxdowncount_and_isor')): ?>
							<label class="layui-form-label">或</label>
							<?php endif; if(!getcustom('up_fxdowncount_and_isor')): ?>
							<label class="layui-form-label">且</label>
							<?php endif; ?>
							<div class="layui-input-inline layui-module-itemL">
								<div>下级总人数满</div>
								<input type="text" name="info[up_fxdowncount_and]" class="layui-input" value="<?php echo $info['up_fxdowncount_and']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>级数</div>
								<input type="text" name="info[up_fxdownlevelnum_and]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum_and']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>等级ID</div>
								<input type="text" name="info[up_fxdownlevelid_and]" class="layui-input" value="<?php echo $info['up_fxdownlevelid_and']; ?>">
								且
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>下级总人数满</div>
								<input type="text" name="info[up_fxdowncount2_and]" class="layui-input" value="<?php echo $info['up_fxdowncount2_and']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>级数</div>
								<input type="text" name="info[up_fxdownlevelnum2_and]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum2_and']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>等级ID</div>
								<input type="text" name="info[up_fxdownlevelid2_and]" class="layui-input" value="<?php echo $info['up_fxdownlevelid2_and']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear">级数：统计到下级多少层级，如3级；等级ID：0表示不限制等级,多个用英文逗号","分隔；</div>
						</div>

						<?php if(getcustom('ciruikang_fenxiao')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">且</label>
							<div class="layui-input-inline layui-module-itemL">
								<div>注册</div>
								<input type="text" name="info[up_regtime_and]" class="layui-input" value="<?php echo $info['up_regtime_and']; ?>" style="margin-right:0px">
								<div>天内(包含)</div>
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear"><?php echo t('会员'); ?>注册时间，超出注册时间则不能升到此级别</div>
						</div>
						<?php endif; if(getcustom('up_cat_ordermoney')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">或</label>
							<div class="layui-input-inline layui-module-itemL">
								<div>购买分类商品（分类ID）</div>
								<input type="text" name="info[up_catid]" class="layui-input" value="<?php echo $info['up_catid']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>单笔订单金额满</div>
								<input type="text" name="info[up_cat_ordermoney]" class="layui-input" value="<?php echo $info['up_cat_ordermoney']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear">此分类下商品单笔订单满xx金额升级，分类ID：多个用英文逗号分隔</div>
						</div>
						<?php endif; if(getcustom('up_downbuyprocount')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">或</label>
							<div class="layui-input-inline layui-module-itemL">
								<div>下级购买数量满</div>
								<input type="text" name="info[up_downbuypronum]" class="layui-input" value="<?php echo $info['up_downbuypronum']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>商品ID</div>
								<input type="text" name="info[up_downbuyproid]" class="layui-input" value="<?php echo $info['up_downbuyproid']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>级数</div>
								<input type="text" name="info[up_downbuyprolvnum]" class="layui-input" value="<?php echo $info['up_downbuyprolvnum']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear">多个商品ID用英文逗号分隔</div>
						</div>
						<?php endif; ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">							
								<select name="info[up_buygoods_condition]">
									<option value="or" <?php if($info['up_buygoods_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
									<option value="and" <?php if($info['up_buygoods_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
								</select>							
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>购买商品(商品ID)</div>
								<input type="text" name="info[up_proid]" class="layui-input" value="<?php echo $info['up_proid']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>购买数量</div>
								<input type="text" name="info[up_pronum]" class="layui-input" value="<?php echo $info['up_pronum']; ?>">
							</div>
							<?php if(getcustom('levelup_pro_extend_time')): ?>
							<div class="layui-form-mid" style="margin-left:20px">复购累加等级有效期</div>
							<div class="layui-input-inline" style="width:150px">
								<input type="radio" name="info[up_pro_extend_time]" value="0" <?php if($info['up_pro_extend_time']==0): ?>checked<?php endif; ?> title="否"/>
								<input type="radio" name="info[up_pro_extend_time]" value="1" <?php if($info['up_pro_extend_time']==1): ?>checked<?php endif; ?> title="是"/>
							</div>
							<div class="layui-form-mid layui-word-aux">过期时间+有效期天数=过期时间</div>
							<?php endif; if(getcustom('levelup_pro_keep_time')): ?>
							<div class="layui-form-mid" style="margin-left:20px">复购保持等级有效期</div>
							<div class="layui-input-inline" style="width:150px">
								<input type="radio" name="info[up_pro_keep_time]" value="0" <?php if($info['up_pro_keep_time']==0): ?>checked<?php endif; ?> title="否"/>
								<input type="radio" name="info[up_pro_keep_time]" value="1" <?php if($info['up_pro_keep_time']==1): ?>checked<?php endif; ?> title="是"/>
							</div>
							<div class="layui-form-mid layui-word-aux">购买时间+有效期天数=过期时间</div>
							<?php endif; if(getcustom('ciruikang_fenxiao')): ?>
							<div class="layui-form-mid" style="margin-left:10px">统计订单状态</div>
							<div class="layui-input-inline" style="width:150px">
								<select name="info[up_pro_orderstatus]">
									<option value="0" <?php if($info['up_pro_orderstatus'] == '0'): ?>selected<?php endif; ?>>付款后所有订单</option>
									<option value="1" <?php if($info['up_pro_orderstatus'] == '1'): ?>selected<?php endif; ?>>仅确认收货订单</option>
								</select>
							</div>
							<div class="layui-form-mid" style="margin-left:10px">统计订单范围</div>
							<div class="layui-input-inline" style="width:150px">
								<select name="info[up_pro_orderrange]">
									<option value="0" <?php if($info['up_pro_orderrange'] == '0'): ?>selected<?php endif; ?>>仅自己订单</option>
									<option value="1" <?php if($info['up_pro_orderrange'] == '1'): ?>selected<?php endif; ?>>自己及下级订单</option>
								</select>
							</div>





							<div class="layui-form-mid" >且</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>购买者最低等级(ID)</div>
								<input type="text" name="info[up_pro_minprelevelid]" class="layui-input" value="<?php echo $info['up_pro_minprelevelid']; ?>">
							</div>
							<?php endif; ?>
							<!--ciruikang_fenxiao end-->
							<div class="layui-form-mid layui-word-aux layui-clear">
								商品ID：多个ID用英文逗号分隔，对应的购买数量也用英文逗号分隔，用法1：多个商品ID多个购买数量表示任一商品购买数量≥对应数量即满足条件，用法2：多个商品ID一个购买数量表示所有商品的购买总量≥数量即满足条件
								<?php if(getcustom('ciruikang_fenxiao')): ?>
								<br>付款后所有订单：统计的是待收货、已收货、已完成、付款后所有状态的订单；仅确认收货订单：统计的是仅确认收货状态的订单
								<br>小市场业绩:统计团队商品数量，去掉其中一条直推线上最大业绩后剩下所有业务线的业绩总和算小市场业绩,统计的是已确认收货的所有商品购买数量
								<br>购买者最低等级(ID)：<?php echo t('会员'); ?>升级前的当前等级，仅能填写一个等级ID，只有大于或等于此等级排序序号的等级才符合此条件，不设置则为全部等级都可升至此级
								<?php endif; ?>
							</div>
						</div>

						<?php if(getcustom('ciruikang_fenxiao')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<label class="layui-form-label">或</label>
							<div class="layui-input-inline layui-module-itemL">
								<div>一次性购买商品(商品ID)</div>
								<input type="text" name="info[up_proid2]" class="layui-input" value="<?php echo $info['up_proid2']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>购买数量</div>
								<input type="text" name="info[up_pronum2]" class="layui-input" value="<?php echo $info['up_pronum2']; ?>">
							</div>
							<div class="layui-form-mid" style="margin-left:10px">统计订单状态</div>
							<div class="layui-input-inline" style="width:150px">
								<select name="info[up_pro_orderstatus2]">
									<option value="0" <?php if($info['up_pro_orderstatus2'] == '0'): ?>selected<?php endif; ?>>付款后所有订单</option>
									<option value="1" <?php if($info['up_pro_orderstatus2'] == '1'): ?>selected<?php endif; ?>>仅确认收货订单</option>
								</select>
							</div>
							<div class="layui-form-mid" >且</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>购买者等级(ID)</div>
								<input type="text" name="info[up_pro_prelevelid2]" class="layui-input" value="<?php echo $info['up_pro_prelevelid2']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear">
								注意：一次性购买商品仅限未一次性购买升级过的<?php echo t('会员'); ?>，若一次性升级过，则此条件不起效果
								<br>
								商品ID：多个ID用英文逗号分隔，对应的购买数量也用英文逗号分隔，用法1：多个商品ID多个购买数量表示自己一次性任一商品购买数量≥对应数量即满足条件，用法2：多个商品ID一个购买数量表示自己一次性所有商品的购买总量≥数量即满足条件
								<br>
								付款后所有订单：统计的是待收货、已收货、已完成、付款后所有状态的订单；仅确认收货订单：统计的是仅确认收货状态的订单
								<br>购买者等级(ID)：<?php echo t('会员'); ?>升级前的当前等级，仅能填写一个等级ID，只有等于此等级才符合此条件，不设置则为全部等级都可升至此级
							</div>
						</div>
						<?php endif; if(getcustom('levelup_small_market_num_product')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
								<select name="info[up_small_market_num_condition]">
									<option value="or" <?php if($info['up_small_market_num_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
									<option value="and" <?php if($info['up_small_market_num_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
								</select>
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>小市场业绩(件)</div>
								<input type="text" name="info[up_small_market_num]" class="layui-input" value="<?php echo $info['up_small_market_num']; ?>">
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>指定商品ID</div>
								<input type="text" name="info[up_small_market_num_proids]" class="layui-input" value="<?php echo $info['up_small_market_num_proids']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear">
								小市场业绩(件)：直推下级去掉业绩最大的，其他的合计（统计商品件数）
								<br>
								指定商品ID：多个ID用英文逗号分隔，若设置指定商品ID则只会统计符合商品的订单
							</div>
						</div>
						<?php endif; if(getcustom('levelup_small_market_yeji')): ?>
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[up_small_market_yeji_condition]">
										<option value="or" <?php if($info['up_small_market_yeji_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['up_small_market_yeji_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>小市场业绩满(元)</div>
									<input type="text" name="info[up_small_market_yeji]" class="layui-input" value="<?php echo $info['up_small_market_yeji']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>指定商品ID</div>
									<input type="text" name="info[up_small_market_yeji_proids]" class="layui-input" value="<?php echo $info['up_small_market_yeji_proids']; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">
									小市场业绩(元)：直推下级去掉业绩最大的，其他的合计（统计订单金额）
									<br>
									指定商品ID：多个ID用英文逗号分隔，若设置指定商品ID则只会统计符合商品的订单
								</div>
							</div>
						<?php endif; if(getcustom('levelup_selfanddown_order_num')): ?>
							<div class="layui-form-item" style="margin-bottom:5px">
									<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
										<select name="info[up_selfanddown_order_num_condition]">
											<option value="or" <?php if($info['up_selfanddown_order_num_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
											<option value="and" <?php if($info['up_selfanddown_order_num_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
										</select>
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<div>自己和下级下单总数量满(单)</div>
										<input type="text" name="info[up_selfanddown_order_num]" class="layui-input" value="<?php echo $info['up_selfanddown_order_num']; ?>">
									</div>

									<div class="layui-input-inline layui-module-itemL">
										<div>指定商品ID</div>
										<input type="text" name="info[up_selfanddown_order_num_proids]" class="layui-input" value="<?php echo $info['up_selfanddown_order_num_proids']; ?>">
									</div>
								<div class="layui-form-mid layui-word-aux layui-clear">
									自己和下级下单总数量满(单)：自己和伞下的下级下单总数满多少单
										<br>
										指定商品ID：多个ID用英文逗号分隔，若指定商品ID则只会统计含有指定商品的订单
								</div>
							</div>
						<?php endif; if(getcustom('levelup_selfanddown_order_product_num')): ?>
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[up_selfanddown_order_product_num_condition]">
										<option value="or" <?php if($info['up_selfanddown_order_product_num_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['up_selfanddown_order_product_num_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>自己和下级购买商品总数量满(件)</div>
									<input type="text" name="info[up_selfanddown_order_product_num]" class="layui-input" value="<?php echo $info['up_selfanddown_order_product_num']; ?>">
								</div>

								<div class="layui-input-inline layui-module-itemL">
									<div>指定商品ID</div>
									<input type="text" name="info[up_selfanddown_order_product_num_proids]" class="layui-input" value="<?php echo $info['up_selfanddown_order_product_num_proids']; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">
									自己和下级购买商品总数量满(件)：自己和伞下的下级购买商品总数量满多少件
									<br>
									指定商品ID：多个ID用英文逗号分隔
								</div>
							</div>
						<?php endif; if(getcustom('member_levelup_businessnum')): ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[up_businessnum_condition]">
										<option value="or" <?php if(!$info['up_businessnum_condition'] || $info['up_businessnum_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['up_businessnum_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>推荐商家成功入驻数量</div>
								<input type="text" name="info[up_businessnum]" class="layui-input" value="<?php echo $info['up_businessnum']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear">推荐商家成功入驻数量大于0时生效</div>
						</div>
						<?php endif; if(getcustom('up_fxorder_condition_new')): ?>
							<!--------------------------新增升级条件start 20231104------------------------------->
							<?php if(getcustom('up_fxorder_condition_new')): ?>
<!--------------------------新增升级条件start 20231104------------------------------->
<div class="layui-form-item" style="margin-bottom:5px">
	<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
		<select name="info[up_fxorder_condition_new]" lay-verify="required">
			<option value="or" <?php if($info['up_fxorder_condition_new'] == 'or'): ?>selected<?php endif; ?>>或</option>
			<option value="and" <?php if($info['up_fxorder_condition_new'] == 'and'): ?>selected<?php endif; ?>>且</option>
		</select>
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>下级总人数满</div>
		<input   type="text" name="info[up_fxdowncount_new]" class="layui-input" value="<?php echo $info['up_fxdowncount_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>级数</div>
		<input   type="text" name="info[up_fxdownlevelnum_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>等级ID</div>
		<input   type="text" name="info[up_fxdownlevelid_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelid_new']; ?>">
	</div>
</div>
<div class="layui-form-item" style="margin-bottom:5px">
	<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
		<select name="info[up_fxorder_condition2_new]" lay-verify="required">
			<option value="or" <?php if($info['up_fxorder_condition2_new'] == 'or'): ?>selected<?php endif; ?>>或</option>
			<option value="and" <?php if($info['up_fxorder_condition2_new'] == 'and'): ?>selected<?php endif; ?>>且</option>
		</select>
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>下级总人数满</div>
		<input   type="text" name="info[up_fxdowncount2_new]" class="layui-input" value="<?php echo $info['up_fxdowncount2_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>级数</div>
		<input   type="text" name="info[up_fxdownlevelnum2_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum2_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>等级ID</div>
		<input   type="text" name="info[up_fxdownlevelid2_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelid2_new']; ?>">
	</div>
</div>
<div class="layui-form-item" style="margin-bottom:5px">
	<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
		<select name="info[up_fxorder_condition3_new]" lay-verify="required">
			<option value="or" <?php if($info['up_fxorder_condition3_new'] == 'or'): ?>selected<?php endif; ?>>或</option>
			<option value="and" <?php if($info['up_fxorder_condition3_new'] == 'and'): ?>selected<?php endif; ?>>且</option>
		</select>
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>下级总人数满</div>
		<input   type="text" name="info[up_fxdowncount3_new]" class="layui-input" value="<?php echo $info['up_fxdowncount3_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>级数</div>
		<input   type="text" name="info[up_fxdownlevelnum3_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum3_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>等级ID</div>
		<input   type="text" name="info[up_fxdownlevelid3_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelid3_new']; ?>">
	</div>
</div>
<div class="layui-form-item" style="margin-bottom:5px">
	<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
		<select name="info[up_fxorder_condition4_new]" lay-verify="required">
			<option value="or" <?php if($info['up_fxorder_condition4_new'] == 'or'): ?>selected<?php endif; ?>>或</option>
			<option value="and" <?php if($info['up_fxorder_condition4_new'] == 'and'): ?>selected<?php endif; ?>>且</option>
		</select>
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>下级总人数满</div>
		<input   type="text" name="info[up_fxdowncount4_new]" class="layui-input" value="<?php echo $info['up_fxdowncount4_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>级数</div>
		<input   type="text" name="info[up_fxdownlevelnum4_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelnum4_new']; ?>">
	</div>
	<div class="layui-input-inline layui-module-itemL">
		<div>等级ID</div>
		<input   type="text" name="info[up_fxdownlevelid4_new]" class="layui-input" value="<?php echo $info['up_fxdownlevelid4_new']; ?>">
	</div>
	<div class="layui-form-mid layui-word-aux layui-clear">级数：统计到下级多少层级，如3级；等级ID：0表示不限制等级,多个用英文逗号","分隔；</div>
</div>
<!--------------------------新增升级条件end 20231104------------------------------->
<?php endif; ?>
							<!--------------------------新增升级条件end 20231104------------------------------->
							<?php endif; if(getcustom('up_level_teamorder')): ?>
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[up_teamorder_condition]">
										<option value="or" <?php if($info['up_teamorder_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['up_teamorder_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>团队订单数满</div>
									<input type="text" name="info[up_teamorder_num]" class="layui-input" value="<?php echo $info['up_teamorder_num']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>级数</div>
									<input type="text" name="info[up_teamorder_lv]" class="layui-input" value="<?php echo $info['up_teamorder_lv']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>等级ID</div>
									<input type="text" name="info[up_teamorder_levelid]" class="layui-input" value="<?php echo $info['up_teamorder_levelid']; ?>">
								</div>
							</div>
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[up_teamorder_small_condition]">
										<option value="or" <?php if($info['up_teamorder_small_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['up_teamorder_small_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>小区团队订单数满</div>
									<input type="text" name="info[up_teamorder_small_num]" class="layui-input" value="<?php echo $info['up_teamorder_small_num']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>级数</div>
									<input type="text" name="info[up_teamorder_small_lv]" class="layui-input" value="<?php echo $info['up_teamorder_small_lv']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>等级ID</div>
									<input type="text" name="info[up_teamorder_small_levelid]" class="layui-input" value="<?php echo $info['up_teamorder_small_levelid']; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">
									1、团队订单个数，只统计普通商品订单，多个商品一起购买算一笔订单<br/>
									2、团队订单数量最大的为大区，剩下的是小区<br/>
									3、级数：统计到下级多少层级，如3级；<br/>
									4、等级ID：0表示不限制等级,多个用英文逗号","分隔；<br/>
								</div>
							</div>
							<?php endif; ?>
							<!--up_level_teamorder end-->

							<?php if(getcustom('levelup_teamnum_peoplenum')): ?>
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[up_team_path_condition]">
										<option value="or" <?php if($info['up_team_path_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['up_team_path_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>团队满</div>
									<input type="text" name="info[up_team_path_num]" class="layui-input" value="<?php echo $info['up_team_path_num']; ?>">条线，
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>每条线超</div>
									<input type="text" name="info[up_team_people_num]" class="layui-input" value="<?php echo $info['up_team_people_num']; ?>">人
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>等级ID</div>
									<input type="text" name="info[up_team_path_level]" class="layui-input" value="<?php echo $info['up_team_path_level']; ?>">多个等级使用英文逗号","分隔
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">团队必须有（X）条线，每条线超过（Y）人达到（M）等级(多个)</div>
							</div>
							<?php endif; if(getcustom('levelup_changepid_yeji')): ?>
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[levelup_changepid_yeji_con]">
										<option value="or" <?php if($info['levelup_changepid_yeji_con'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['levelup_changepid_yeji_con'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>链动脱离人员订单金额</div>
									<input type="text" name="info[levelup_changepid_yeji]" class="layui-input" value="<?php echo $info['levelup_changepid_yeji']; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear"></div>
							</div>
							<?php endif; if(getcustom('levelup_team_yeji_front')): ?>
							<!--根据规定时间内的业绩升级-->
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[levelup_team_yeji_front_con]">
										<option value="or" <?php if($info['levelup_team_yeji_front_con'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['levelup_team_yeji_front_con'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>前</div>
									<input type="text" name="info[levelup_team_yeji_front_day]" class="layui-input" value="<?php echo $info['levelup_team_yeji_front_day']; ?>">天内
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>低等级团队会员业绩达到</div>
									<input type="text" name="info[levelup_team_yeji_front_yeji]" class="layui-input" value="<?php echo $info['levelup_team_yeji_front_yeji']; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">低等级包含平级</div>
							</div>
							<?php endif; ?>
							<!--levelup_teamnum_peoplenum end-->
							<?php if(getcustom('member_up_binding_tel')): ?>
							<div class="layui-form-item" style="margin-bottom:5px">
								<div class="layui-input-inline" style="width: 70px;margin-left: 80px;">
									<select name="info[up_binding_tel_condition]">
										<option value="or" <?php if($info['up_binding_tel_condition'] == 'or'): ?>selected<?php endif; ?>>或</option>
										<option value="and" <?php if($info['up_binding_tel_condition'] == 'and'): ?>selected<?php endif; ?>>且</option>
									</select>
								</div>
								<div class="layui-module-color">绑定手机号</div>
								<div class="layui-input-inline" style="width: 70px;margin-left: 5px;">
									<input type="checkbox" name="info[up_binding_tel]" value="1" lay-text="开启|关闭" lay-skin="switch" <?php if($info['up_binding_tel']==1): ?>checked<?php endif; ?>>
								</div>
								<div class="layui-form-mid layui-word-aux ">开启后必须绑定手机号才能自动升级</div>
							</div>
							<?php endif; ?>
						<div class="layui-form-item" style="margin-bottom:5px">
							<div class="layui-form-mid layui-word-aux layui-clear">不填写则不能自动升级为该级别；每行一个条件</div>
						</div>
							<?php if(getcustom('levelup_from_levelid')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">前置等级</label>
								<div class="layui-input-inline" style="width:800px">
									<input type="checkbox" name="info[gettj][]" value="-1" title="所有等级" lay-skin="primary" <?php if(in_array('-1',$info['gettj'])): ?>checked<?php endif; ?> />
									<?php foreach($levellist as $v): ?>
									<input type="checkbox" name="info[gettj][]" value="<?php echo $v['id']; ?>" title="<?php echo $v['name']; ?>" lay-skin="primary" <?php if(in_array($v['id'],$info['gettj'])): ?>checked<?php endif; ?>/>
									<?php endforeach; ?>
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">只有勾选的等级才可以升级到该级别，不勾选代表不限制</div>
							</div>
							<?php endif; if($auth_data=='all' || in_array('up_giveparent',$auth_data)): if(getcustom('up_giveparent')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">升级给上级人数</label>
								<div class="layui-input-inline">
									<input type="text" name="info[up_giveparent_num]" class="layui-input" value="<?php echo $info['up_giveparent_num']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>指定上级等级ID</div>
									<input type="text" name="info[up_giveparent_levelid_p]" class="layui-input" value="<?php echo $info['up_giveparent_levelid_p']; ?>" placeholder="">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>指定下级等级ID</div>
									<input type="text" name="info[up_giveparent_levelid]" class="layui-input" value="<?php echo $info['up_giveparent_levelid']; ?>" placeholder="选填">
								</div>
								<?php if($up_giveparent_prize): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div><?php echo t('见点奖'); ?></div>
									<input type="text" name="info[up_giveparent_prize]" class="layui-input" value="<?php echo $info['up_giveparent_prize']; ?>" placeholder="0">
								</div>
								<?php endif; ?>
								<div class="layui-form-mid layui-word-aux layui-clear">升级到此等级后，他直推的几个人留给他的上级（0表示直推上级，其他等级ID表示不限层级的最近上级），等级ID多个用英文逗号分隔</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">脱离后作为新上级的升级条件</label>
								<div class="layui-input-inline" style="width:150px;">
									<input type="radio" name="info[up_with_new]" value="1" title="是" <?php if($info['up_with_new']==1): ?>checked<?php endif; ?>>
									<input type="radio" name="info[up_with_new]" value="0" title="否" <?php if($info['up_with_new']!=1): ?>checked<?php endif; ?>>
								</div>
								<div class="layui-form-mid layui-word-aux">脱离后是否作为新推荐人的“下级总人数”条件，帮助新推荐人升级（解冻扶持金同样适用）</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">脱离后作为原上级的升级条件</label>
								<div class="layui-input-inline" style="width:150px;">
									<input type="radio" name="info[up_with_origin]" value="1" title="是" <?php if($info['up_with_origin']==1): ?>checked<?php endif; ?>>
									<input type="radio" name="info[up_with_origin]" value="0" title="否" <?php if($info['up_with_origin']!=1): ?>checked<?php endif; ?>>
								</div>
								<div class="layui-form-mid layui-word-aux">脱离后继续作为原推荐人的“下级总人数”条件，帮助原推荐人升级</div>
							</div>
							<?php endif; if(getcustom('change_down_user')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">链动换位</label>
								<div class="layui-input-inline" style="width:200px;">
									<input type="radio" name="info[change_down_user]" value="1" title="开启" <?php if($info['change_down_user']==1): ?>checked<?php endif; ?> lay-filter="diandaSwitchNew">
									<input type="radio" name="info[change_down_user]" value="0" title="关闭" <?php if($info['change_down_user']!=1): ?>checked<?php endif; ?> lay-filter="diandaSwitchNew">
								</div>
								<div class="layui-form-mid layui-word-aux">开启后该等级的会员可以在前台我的团队页面中进行链动换位</div>
							</div>
							<?php endif; if(getcustom('up_change_pid')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">升级后脱离上级</label>
								<div class="layui-input-inline" style="width:150px;">
									<input type="radio" name="info[up_change_pid]" value="1" title="是" <?php if($info['up_change_pid']==1): ?>checked<?php endif; ?> lay-filter="diandaSwitchNew">
									<input type="radio" name="info[up_change_pid]" value="0" title="否" <?php if($info['up_change_pid']!=1): ?>checked<?php endif; ?> lay-filter="diandaSwitchNew">
									<!--0不变，1脱离，2修改为上级的上级（预留）-->
								</div>
								<div class="layui-form-mid layui-word-aux">升级到此等级后，他的推荐人为空</div>
							</div>
							<div class="layui-form-item" <?php if($info['up_change_pid'] == 1): ?> style="display:none"<?php endif; ?>>
								<label class="layui-form-label">升级后回归</label>
								<div class="layui-input-inline" style="width:150px;">
									<input type="radio" name="info[up_change_back]" value="1" title="是" <?php if($info['up_change_back']==1): ?>checked<?php endif; ?>>
									<input type="radio" name="info[up_change_back]" value="0" title="否" <?php if($info['up_change_back']!=1): ?>checked<?php endif; ?>>
									<!--0不变，1脱离，2修改为上级的上级（预留）-->
								</div>
								<div class="layui-form-mid layui-word-aux">升级到此等级后，回归到原推荐人下面（仅脱离的人生效）</div>
							</div>
							<?php endif; ?>
	  					<?php endif; ?>

					</div>


					<!--升级送优惠券Start-->
		  			<?php if(getcustom('up_give_coupon')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">升级奖励<?php echo t('优惠券'); ?></label>
						  <div class="layui-input-inline" style="width:auto; overflow: hidden;">
							<div class="layui-tab">
							  <ul class="layui-tab-title">
								  <li class="layui-this">商城优惠券</li>
								  <li>餐饮优惠券</li>
							  </ul>
							  <div class="layui-tab-content">
								  <!--商城优惠券Start-->
								  <div class="layui-tab-item layui-show give-coupon-shop">
								  	<table class="layui-table choose-coupon-up" style="width:500px" id="choose-coupon-up">
									  <thead>
									  <tr>
										  <th>ID</th>
										  <th>名称</th>
										  <th>库存</th>
										  <th>获得数量</th>
										  <th>操作</th>
									  </tr>
									  </thead>
									  <?php if($upcouponList): foreach($upcouponList as $k=>$item): ?>
									  <tr class="choose-tr-list">
										  <td><?php echo $item['id']; ?></td>
										  <td><?php echo $item['name']; ?></td>
										  <td><?php echo $item['stock']; ?></td>
										  <td>
											  <input type="hidden" name="info[up_give_coupon][ids][]" value="<?php echo $item['id']; ?>">
											  <input type="text" name="info[up_give_coupon][nums][]" value="<?php echo $item['num']; ?>" class="layui-input" style="width:70px"/>
										  </td>
										  <td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTrUp(this)">删除</button></td>
									  </tr>
									  <?php endforeach; ?>
									  <?php endif; ?>
									  <tr class="choose-tr-add">
										  <td colspan="5" align="center"><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="showChooseCouponUp()">添加</button></td>
									  </tr>
								  	</table>
										  <script>
											  var chooseCouponLayer;
											  function showChooseCouponUp(){
												  chooseCouponLayer = layer.open({type:2,title:'选择<?php echo t('优惠券'); ?>',content:"<?php echo url('Coupon/choosecoupon'); ?>/callback/choosecouponup",area:['1000px','600px'],shadeClose:true});
											  }
											  function choosecouponup(res,args){
												  var detail = res;
												  var chooseClassName = '.choose-coupon-up';
												  layer.close(chooseCouponLayer);
												  var isadd = 0;
												  $(chooseClassName).find('.choose-tr-list').each(function(){
													  var thisfid = $(this).find('td:eq(0)').html();
													  if(thisfid == detail.id){
														  isadd = 1
														  dialog('该项已添加过了');
													  }
												  });
												  if(isadd == 0){
													  var tr = '<tr class="choose-tr-list">' +
															  '<td>'+detail.id+'</td>' +
															  '<td>'+detail.name+'</td>' +
															  '<td>'+detail.stock+'</td>' +
															  '<td><input type="hidden" name="info[up_give_coupon][ids][]" value="'+detail.id+'"><input type="text" name="info[up_give_coupon][nums][]" value="1" class="layui-input" style="width:70px"/></td>' +
															  '<td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTrUp(this)">删除</button></td>' +
															  '</tr>';
													  $(chooseClassName).find('.choose-tr-add').before(tr);
												  }
											  }
											  function delChooseTrUp(obj){
												  $(obj).closest('.choose-tr-list').remove();
											  }
										  </script>
									  </div>

								  <!--商城优惠券End-->
								  <!--餐饮优惠券Start-->
								  <div class="layui-tab-item give-coupon-restaurant">
									  <table class="layui-table choose-coupon-upr" style="width:500px" id="choose-coupon-upr">
										  <thead>
										  <tr>
											  <th>ID</th>
											  <th>名称</th>
											  <th>库存</th>
											  <th>获得数量</th>
											  <th>操作</th>
										  </tr>
										  </thead>
										  <?php if($upcouponRList): foreach($upcouponRList as $k=>$item): ?>
										  <tr class="choose-tr-list">
											  <td><?php echo $item['id']; ?></td>
											  <td><?php echo $item['name']; ?></td>
											  <td><?php echo $item['stock']; ?></td>
											  <td>
												  <input type="hidden" name="info[up_give_restaurant_coupon][ids][]" value="<?php echo $item['id']; ?>">
												  <input type="text" name="info[up_give_restaurant_coupon][nums][]" value="<?php echo $item['num']; ?>" class="layui-input" style="width:70px"/>
											  </td>
											  <td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTrUp(this)">删除</button></td>
										  </tr>
										  <?php endforeach; ?>
										  <?php endif; ?>
										  <tr class="choose-tr-add">
											  <td colspan="5" align="center"><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="showChooseCouponUpR()">添加</button></td>
										  </tr>
									  </table>
									  <script>
										  var chooseCouponLayer;
										  function showChooseCouponUpR(){
											  chooseCouponLayer = layer.open({type:2,title:'选择<?php echo t('优惠券'); ?>',content:"<?php echo url('RestaurantCoupon/choosecoupon'); ?>/callback/choosecouponupr",area:['1000px','600px'],shadeClose:true});
										  }
										  function choosecouponupr(res,args){
											  var detail = res;
											  var chooseClassName = '.choose-coupon-upr';
											  layer.close(chooseCouponLayer);
											  var isadd = 0;
											  $(chooseClassName).find('.choose-tr-list').each(function(){
												  var thisfid = $(this).find('td:eq(0)').html();
												  if(thisfid == detail.id){
													  isadd = 1
													  dialog('该项已添加过了');
												  }
											  });
											  if(isadd == 0){
												  var tr = '<tr class="choose-tr-list">' +
														  '<td>'+detail.id+'</td>' +
														  '<td>'+detail.name+'</td>' +
														  '<td>'+detail.stock+'</td>' +
														  '<td><input type="hidden" name="info[up_give_restaurant_coupon][ids][]" value="'+detail.id+'"><input type="text" name="info[up_give_restaurant_coupon][nums][]" value="1" class="layui-input" style="width:70px"/></td>' +
														  '<td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTrUpR(this)">删除</button></td>' +
														  '</tr>';
												  $(chooseClassName).find('.choose-tr-add').before(tr);
											  }
										  }
										  function delChooseTrUpR(obj){
											  $(obj).closest('.choose-tr-list').remove();
										  }
									  </script>
								  </div>
								  <!--餐饮优惠券End-->
							  </div>
							</div>
						  </div>
					  </div>
					<?php endif; ?>
		  			<!--升级送优惠券End-->
					  <?php if(getcustom('coupon_xianxia_buy')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">转入优惠券数量</label>
						  <div class="layui-input-inline">
							  <input type="text" name="info[up_get_couponnum]" class="layui-input" value="<?php echo $info['up_get_couponnum']; ?>">
						  </div>
						  <div class="layui-form-mid layui-word-aux">一次转入优惠券数量大于设置时进行升级，大于0生效</div>
					  </div>
					  <?php endif; ?>
						<div class="layui-form-item">
							<label class="layui-form-label">升级奖励<?php echo t('积分'); ?></label>
							<div class="layui-input-inline">
								<input type="text" name="info[up_give_score]" class="layui-input" value="<?php echo $info['up_give_score']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">升到此等级，奖励<?php echo t('积分'); ?></div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">升级奖励<?php echo t('余额'); ?></label>
							<div class="layui-input-inline">
								<input type="text" name="info[up_give_money]" class="layui-input" value="<?php echo $info['up_give_money']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">升到此等级，奖励<?php echo t('余额'); ?></div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">升级奖励<?php echo t('佣金'); ?></label>
							<div class="layui-input-inline">
								<input type="text" name="info[up_give_commission]" class="layui-input" value="<?php echo $info['up_give_commission']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">升到此等级，奖励<?php echo t('佣金'); ?></div>
						</div>
						<?php if(getcustom('coupon_pack')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">升级奖励券包</label>
							<div class="layui-input-inline">
								<input type="text" name="info[up_give_couponpack]" class="layui-input" value="<?php echo $info['up_give_couponpack']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">升到此等级，奖励券包<button type="button" class="layui-btn layui-btn-sm layui-btn-primary" style="margin-left: 10px;" onclick="showChooseCoupon()">添加</button></div>
							<script>
								  var chooseCouponLayer2;
								  function showChooseCoupon(){
									  chooseCouponLayer2 = layer.open({type:2,title:'选择<?php echo t('优惠券'); ?>',content:"<?php echo url('Coupon/choosecoupon'); ?>/type/20",area:['1000px','600px'],shadeClose:true});
								  }
								  function choosecoupon(res){
									  $("input[name='info[up_give_couponpack]']").val(res.id);
								  }
							  </script>
						</div>
						<?php endif; if(getcustom('member_levelup_parentcommission')): ?>
							<div class="layui-form-item">
							  <label class="layui-form-label">升级奖励上级佣金</label>
							<?php foreach($levelup_levelist as $level): ?>	
							  <div class="layui-input-inline layui-module-itemL">
								  <div><?php echo $level['name']; ?>：</div>
								  <input type="hidden" name="levelup_parentcommission[levelid][]" value="<?php echo $level['id']; ?>">
								  <input type="text" name="levelup_parentcommission[money][]" class="layui-input" value="<?php echo $level['money']; ?>">
							  </div>
							<?php endforeach; ?>

								<div class="layui-form-mid">开启级差</div>
								<div class="layui-input-inline" style="width: 80px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[levelup_parent_jicha]" value="1" <?php if($info['levelup_parent_jicha']==1): ?>checked<?php endif; ?> title="只返最近的上级" lay-skin="primary">
								</div>
							  <div class="layui-form-mid layui-word-aux">不设置不生效</div>
							</div>
						<?php else: ?>
						<div class="layui-form-item">
							<label class="layui-form-label">升级奖励上级<?php echo t('佣金'); ?></label>
							<div class="layui-input-inline">
								<input type="number" min="0" name="info[up_give_parent_money]" class="layui-input" value="<?php echo $info['up_give_parent_money']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">升到此等级，给推荐人奖励<?php echo t('佣金'); ?></div>
						</div>
						<?php endif; if(getcustom('member_levelup_auth')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">升级奖励权限</label>
							<div class="layui-input-inline layui-module-itemL">
								<div>总额度：</div>
								<input type="number" min="0" name="info[give_level_totalmoney]" class="layui-input" value="<?php echo $info['give_level_totalmoney']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">在线售卖和转赠会员等级的总额度（小于本等级）</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">可售卖或转赠的等级</label>
							<div class="layui-input-inline" style="width:800px">
								<?php foreach($levellist as $v): ?>
								<input type="checkbox" name="info[saletj][]" value="<?php echo $v['id']; ?>" title="<?php echo $v['name']; ?>" lay-skin="primary" <?php if(in_array($v['id'],$info['saletj'])): ?>checked<?php endif; ?>/>
								<?php endforeach; ?>
							</div>
						</div>

						<?php endif; ?>
						
						<!--升级送优惠券2 Start-->
						<?php if(getcustom('member_levelup_givecoupon')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">升级奖励<?php echo t('优惠券'); ?></label>
								<div class="layui-input-inline" style="width:auto; ">
									<table class="layui-table choose-coupon1" style="width:700px;" id="choose-coupon2">
										<thead>
										<tr>
											<th>ID</th>
											<th>名称</th>
											<th>库存</th>
											<th>赠送周期类型</th>
											<th>每周期数量</th>
											<th>赠送周期数量</th>
											<th>操作</th>
										</tr>
										</thead>
										<?php foreach($givecoupondata as $k=>$v): ?>
										<tr class="choose-tr-list">
											<td><?php echo $v['coupon_id']; ?><input type="hidden" value='<?php echo $v['coupon_id']; ?>' name="coupon_id[]"></td>
											<td><?php echo $v['name']; ?></td>
											<td><?php echo $v['stock']; ?></td>
											<td>
												<select name="cycletype[]" >
													<option value="1" <?php if($v['cycletype']==1): ?>selected<?php endif; ?>>单次</option>
													<option value="2" <?php if($v['cycletype']==2): ?>selected<?php endif; ?>>每周</option>
													<option value="3" <?php if($v['cycletype']==3): ?>selected<?php endif; ?>>每月</option>
												</select>
											</td>
											<td><input type="text" name="coupon_num[]" value="<?php echo $v['coupon_num']; ?>" class="layui-input" style="width:70px"/></td>
											<td><input type="text" name="cyclenum[]" value="<?php echo $v['cyclenum']; ?>" class="layui-input" style="width:70px"/></td>
											<td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTr(this,<?php echo $ff['id']; ?>)">删除</button></td>
										</tr>
										<?php endforeach; ?>
							
										<tr class="choose-tr-add">
											<td colspan="7" align="center"><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="showChooseCoupon1()">添加</button></td>
										</tr>
									</table>
								</div>
								<script>
									var chooseCouponLayer;
									function showChooseCoupon1(){
										  chooseCouponLayer = layer.open({type:2,title:'选择<?php echo t('优惠券'); ?>',content:"<?php echo url('Coupon/choosecoupon'); ?>/callback/choosecoupon1",area:['1000px','600px'],shadeClose:true});
									}
									function choosecoupon1(res){
										var detail = res;
										var chooseClassName = '.choose-coupon1';
										layer.close(chooseCouponLayer);
										var objIds = [];
										var isadd = 0;
										$(chooseClassName).find('.choose-tr-list').each(function(){
											var thisfid = $(this).find('td:eq(0)').html();
											if(thisfid == detail.id){
												isadd = 1
												dialog('该项已添加过了');
											}
											objIds.push(thisfid)
										});
										if(isadd == 0){
											objIds.push(detail.id)
						
											var html='';
											html+='<tr class="choose-tr-list">';
											html+='<td>'+detail.id+'</td>';
											html+='<td>'+detail.name+'<input type="hidden" value='+detail.id+' name="coupon_id[]"></td>';
											html+='<td>'+detail.stock+'</td>';
											html+='	<td><div class="layui-input-inline" style="width: 100px;"><select name="cycletype[]" >';
											html+='			<option value="1">单次</option>';
											html+='			<option value="2">每周</option>';
											html+='			<option value="3">每月</option>';
											html+='		</select></div></td>';
											html+='<td><input type="text" name="cyclenum[]" value="1" class="layui-input" style="width:70px"/></td>';
											html+='<td><input type="text" name="coupon_num[]" value="1" class="layui-input" style="width:70px"/></td>';
											html+= '<td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTr(this,'+detail.id+')">删除</button></td></tr>';
			
											$(chooseClassName).find('.choose-tr-add').before(html);
										}
										layui.form.render();
									}
									function delChooseTr(obj,fid){
										$(obj).closest('.choose-tr-list').remove();
										var objIds = [];
										$('#choose-coupon2').find('.choose-tr-list').each(function(){
											objIds.push($(this).find('td:eq(0)').html())
										})
							
									}
								</script>
							</div>
						<?php endif; ?>
						<!--升级送优惠券2End-->

						<?php if(getcustom('coupon_xianxia_buy')): ?>
						<fieldset class="layui-elem-field">
							<legend>线下每组<?php echo t('优惠券'); ?>奖励</legend>
							<div class="layui-form-item">
							  <label class="layui-form-label"></label>
								<div class="layui-input-inline" style="width: 82%">
								  <?php foreach($nodefault_level_list as $level): ?>
								  <div class="layui-input-inline layui-module-itemL" style="margin: 10px 0;">
									  <div style="width: 90px"><?php echo $level['name']; ?>：</div>
									  <input type="hidden" name="xianxia[levelid][]" value="<?php echo $level['id']; ?>">
									  <input type="text" name="xianxia[money][]" class="layui-input" value="<?php echo $level['money']; ?>">
								  </div>
								  <?php endforeach; ?>
								</div>
								<div  class="layui-form-mid layui-word-aux">不设置不生效</div>
							</div>
						</fieldset>
						<fieldset class="layui-elem-field">
							<legend>线下<?php echo t('优惠券'); ?>奖励上级</legend>
							<div class="layui-form-item">
							  <div class="layui-input-inline" style="width: 80%">
								  <?php foreach($prv_level_list as $level): ?>
								  <div class="layui-form-item" >
									  <label class="layui-form-label" style="width: 150px;margin-right: 10px">推荐人等级 <?php echo $level['name']; ?>:</label>
									  <div style="display:inline-block;width: 85%;">
										  <?php foreach($level['children'] as $children): ?>
										  <div class="layui-input-inline layui-module-itemL" style="margin: 10px 0;">
											  <div style="width: 90px"><?php echo $children['name']; ?>：</div>
											  <input type="hidden" name="xianxiatj[<?php echo $level['id']; ?>][levelid][]" value="<?php echo $children['id']; ?>">
											  <input type="text" name="xianxiatj[<?php echo $level['id']; ?>][money][]" class="layui-input" value="<?php echo $children['money']; ?>">
										  </div>
										  <?php endforeach; ?>
									  </div>
								  </div>
								  <?php endforeach; ?>
							  </div>
							  <div class="layui-form-mid layui-word-aux" style="margin-left: 100px">推荐人上级最近对应等级奖励,不设置不生效</div>
							</div>
						</fieldset>
						<div class="layui-form-item">
						  <label class="layui-form-label">线下<?php echo t('优惠券'); ?>超出奖励</label>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>推荐人等级ID：</div>
							  <input type="text" class="layui-input" name="xianxia_full[levelid]" value="<?php echo $xianxia_full['levelid']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>满：</div>
							  <input type="text" class="layui-input" name="xianxia_full[num]" value="<?php echo $xianxia_full['num']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>奖励：</div>
							  <input type="text" class="layui-input" name="xianxia_full[money]" value="<?php echo $xianxia_full['money']; ?>">/组
						  </div>
						  <div class="layui-form-mid layui-word-aux">不设置不生效</div>
						</div>
						<?php endif; if(getcustom('up_give_parent_coupon')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">升级奖励上级<?php echo t('优惠券'); ?></label>
							<div class="layui-input-inline" style="width:auto; overflow: hidden;">
								<table class="layui-table choose-coupon" style="width:500px" id="choose-coupon">
									<thead>
									<tr>
										<th>ID</th>
										<th>名称</th>
										<th>库存</th>
										<th>赠送数量</th>
										<th>操作</th>
									</tr>
									</thead>
									<?php if($couponList): foreach($couponList as $k=>$ff): ?>
									<tr class="choose-tr-list"><td><?php echo $ff['id']; ?></td><td><?php echo $ff['name']; ?></td><td><?php echo $ff['stock']; ?></td><td><input type="text" name="info[up_give_parent_coupon_nums][]" value="<?php echo $up_give_parent_coupon_nums[$k]; ?>" class="layui-input" style="width:70px"/></td><td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTr(this,<?php echo $ff['id']; ?>)">删除</button></td></tr>
									<?php endforeach; ?>
									<?php endif; ?>
									<tr class="choose-tr-add">
										<td colspan="5" align="center"><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="showChooseCoupon()">添加</button></td>
									</tr>
								</table>
								<input type="hidden" name="info[up_give_parent_coupon_ids]" value="<?php echo $info['up_give_parent_coupon_ids']; ?>"/>
							</div>
							<script>
								var chooseCouponLayer;
								function showChooseCoupon(){
									chooseCouponLayer = layer.open({type:2,title:'选择<?php echo t('优惠券'); ?>',content:"<?php echo url('Coupon/choosecoupon'); ?>",area:['1000px','600px'],shadeClose:true});
								}
								function choosecoupon(res){
									var detail = res;
									var chooseClassName = '.choose-coupon';
									layer.close(chooseCouponLayer);
									var objIds = [];
									var isadd = 0;
									$(chooseClassName).find('.choose-tr-list').each(function(){
										var thisfid = $(this).find('td:eq(0)').html();
										if(thisfid == detail.id){
											isadd = 1
											dialog('该项已添加过了');
										}
										objIds.push(thisfid)
									});
									if(isadd == 0){
										objIds.push(detail.id)
										$("input[name='info[up_give_parent_coupon_ids]']").val(objIds.join(','));
										var tr = '<tr class="choose-tr-list"><td>'+detail.id+'</td><td>'+detail.name+'</td><td>'+detail.stock+'</td><td><input type="text" name="info[up_give_parent_coupon_nums][]" value="1" class="layui-input" style="width:70px"/></td><td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delChooseTr(this,'+detail.id+')">删除</button></td></tr>';
										$(chooseClassName).find('.choose-tr-add').before(tr);
									}
								}
								function delChooseTr(obj,fid){
									$(obj).closest('.choose-tr-list').remove();
									var objIds = [];
									$('#choose-coupon').find('.choose-tr-list').each(function(){
										objIds.push($(this).find('td:eq(0)').html())
									})
									console.log(objIds)
									$("input[name='info[up_give_parent_coupon_ids]']").val(objIds.join(','));
								}
							</script>
						</div>
						<?php endif; if(getcustom('buy_selectmember')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">是否允许下单选择</label>
							<div class="layui-input-inline" style="width:150px;">
								<input type="radio" name="info[can_buyselect]" value="1" title="是" <?php if($info['can_buyselect']==1): ?>checked<?php endif; ?>>
								<input type="radio" name="info[can_buyselect]" value="0" title="否" <?php if($info['can_buyselect']!=1): ?>checked<?php endif; ?>>
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>被选奖励(%)</div>
								<input type="text" name="info[buyselect_commission]" class="layui-input" value="<?php echo $info['buyselect_commission']; ?>">
							</div>
							<div class="layui-form-mid layui-word-aux">开启后用户在商城中下单时可选择该会员</div>
						</div>
						<?php endif; ?>

						<?php endif; if(getcustom('network_slide')): if($auth_data=='all' || in_array('network_slide',$auth_data)): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">公排滑落</label>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>直推下级等级ID</div>
							  <input type="text" name="info[net_down_levelid]" class="layui-input" value="<?php echo $info['net_down_levelid']; ?>" placeholder="">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>人数达到</div>
							  <input type="text" name="info[net_down_num]" class="layui-input" value="<?php echo $info['net_down_num']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>再次直推下级等级ID</div>
							  <input type="text" name="info[net_down_next_levelid]" class="layui-input" value="<?php echo $info['net_down_next_levelid']; ?>" placeholder="">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>滑落给下级等级ID</div>
							  <input type="text" name="info[slide_down_levelid]" class="layui-input" value="<?php echo $info['slide_down_levelid']; ?>" placeholder="">
						  </div>
						  <?php if(getcustom('network_slide_down_max')): ?>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>下级接收人数上限</div>
							  <input type="text" name="info[slide_down_max]" class="layui-input" value="<?php echo $info['slide_down_max']; ?>" placeholder="">
						  </div>
						  <?php endif; ?>
						  <div class="layui-form-mid layui-word-aux layui-clear">
							  <input type="checkbox" name="info[slide_down_team]" value="1" <?php if($info['slide_down_team']==1): ?>checked<?php endif; ?> title="仅滑落给链动脱离的人" lay-skin="primary">
							  <input type="checkbox" name="info[slide_down_team]" value="2" <?php if($info['slide_down_team']==2): ?>checked<?php endif; ?> title="仅滑落给现有下级(直推或间推)" lay-skin="primary">
						  </div>
						  <div class="layui-form-mid layui-word-aux layui-clear">
							  1、直推下级满N个Y等级，再直推的人（U等级）自动滑落给下级T等级的人）<br/>
							  2、滑落给予顺序：链动脱离的人—自己直推的人—链动裂变过来的人—公排滑落下来的人<br/>
							  3、跳过U等级升级的会员不滑落<br/>
							  4、人数设置0，代表不滑落<br/>
						  </div>
					  </div>
  						<?php endif; ?>
					  <?php endif; if(getcustom('ciruikang_fenxiao')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">赠送商品</label>
							<div class="layui-input-inline layui-module-itemL">
								<div>每购买</div>
								<input type="text" name="info[crk_sumnum]" class="layui-input" value="<?php echo $info['crk_sumnum']; ?>">
								个
							</div>
							<div class="layui-input-inline layui-module-itemL">
								<div>随机赠送</div>
								<input type="text" name="info[crk_sendnum]" class="layui-input" value="<?php echo $info['crk_sendnum']; ?>">
								个
							</div>
							<!-- <div class="layui-form-mid" style="margin-left:20px">统计订单状态</div>
							<div class="layui-input-inline" style="width:150px">
								<select name="info[crk_send_orderstatus]">
									<option value="0" <?php if($info['crk_send_orderstatus'] == '0'): ?>selected<?php endif; ?>>付款后所有订单</option>
									<option value="1" <?php if($info['crk_send_orderstatus'] == '1'): ?>selected<?php endif; ?>>仅确认收货订单</option>
								</select>
							</div> -->
							<div class="layui-form-mid layui-word-aux">仅一次性购买商城商品升级的有赠送；每购满多少商品送多少商品；购买数量为累计数量=下单之前已完成的订单商品数量+本次购买的数量；</div>
						</div>
						<?php endif; ?>

						<div id="can_commission" <?php if(!$isdefault_cat): ?> style="display: none;" <?php endif; ?>>
							<span style="color:#333">分销设置</span><hr/>
							<div class="layui-form-item">
								<label class="layui-form-label">分销权限</label>
								<div class="layui-input-inline" style="width:70%">
									<input type="radio" name="info[can_agent]" value="0" title="无权限" <?php if($info['can_agent']==0 || $info['can_agent']==''): ?>checked<?php endif; ?> lay-filter="can_agent">
									<input type="radio" name="info[can_agent]" value="1" title="一级分销" <?php if($info['can_agent']==1): ?>checked<?php endif; ?> lay-filter="can_agent">
									<input type="radio" name="info[can_agent]" value="2" title="二级分销" <?php if($info['can_agent']==2): ?>checked<?php endif; ?> lay-filter="can_agent">
									<input type="radio" name="info[can_agent]" value="3" title="三级分销" <?php if($info['can_agent']==3): ?>checked<?php endif; ?> lay-filter="can_agent">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">开启则表示该级别的<?php echo t('会员'); ?>有分销权限，可以发展下级，拿相应提成</div>
							</div>
						<?php if(getcustom('member_level_parent_not_commission')): ?>
						<div class="layui-form-item">
						  <label class="layui-form-label">上级无任何分销奖励</label>
						  <div class="layui-input-inline" style="width:70%">
							  <input type="radio" name="info[parent_not_commission]" value="0" title="关闭" <?php if($info['parent_not_commission']==0 || $info['agent_to_origin']==''): ?>checked<?php endif; ?> >
							  <input type="radio" name="info[parent_not_commission]" value="1" title="开启" <?php if($info['parent_not_commission']==1): ?>checked<?php endif; ?>>
						  </div>
						  <div class="layui-form-mid layui-word-aux layui-clear">开启后该等级购买下单，他的上级不享受任何分销奖励（限商城订单）</div>
						</div>
						<?php endif; if(getcustom('agent_to_origin')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label">发给原推荐人</label>
							  <div class="layui-input-inline" style="width:70%">
								  <input type="radio" name="info[agent_to_origin]" value="1" title="开启" <?php if($info['agent_to_origin']==1): ?>checked<?php endif; ?>>
								  <input type="radio" name="info[agent_to_origin]" value="0" title="关闭" <?php if($info['agent_to_origin']==0 || $info['agent_to_origin']==''): ?>checked<?php endif; ?> >
							  </div>
							  <div class="layui-form-mid layui-word-aux layui-clear">开启后一级分销发放给原推荐人(仅一级分销)</div>
						  </div>
  						<?php endif; ?>
							<div class="layui-form-item" id="can_agentset"  style="border:0px dashed #f0cccc;padding-top:10px;margin-bottom:20px;<?php if($info['can_agent']==0 || $info['can_agent']==''): ?>display:none<?php endif; ?>">
								<?php if(getcustom('commission_max')): ?>
								<div class="layui-form-item canAgentF">
									<label class="layui-form-label">奖励上限</label>
									<div class="layui-input-inline" style="width:250px">
										<input type="number" step="1" min="0" name="info[commission_max]" lay-verify="number|Ndouble" class="layui-input" value="<?php echo !empty($info['commission_max']) ? $info['commission_max'] : 0; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux">达到奖励上限不再发放任何<?php echo t('佣金'); ?>，0表示不限制</div>
								</div>
								<?php endif; ?>
								<div class="layui-form-item">
									<label class="layui-form-label">提成方式</label>
									<div class="layui-input-inline" style="width:70%">
										<input type="radio" class="canAgentF-radio" name="info[commissiontype]" value="0" title="百分比" <?php if($info['commissiontype']==0): ?>checked<?php endif; ?>  lay-filter="commissiontype">
										<input type="radio" class="canAgentF-radio" name="info[commissiontype]" value="1" title="固定金额" <?php if($info['commissiontype']==1): ?>checked<?php endif; ?>  lay-filter="commissiontype">
									</div>
									<div class="layui-form-mid layui-word-aux">设置固定金额时按单返<?php echo t('佣金'); ?>,和购买数量无关</div>
								</div>
								<div class="layui-form-item" id="tichengBox1" <?php if($info['commissiontype']==2): ?>style="display:none;"<?php endif; ?>>
									<label class="layui-form-label">提成金额</label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1 >一级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>) </div>
										<input type="text" name="info[commission1]" class="layui-input" value="<?php echo $info['commission1']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">
										<div commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">二级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[commission2]" class="layui-input" value="<?php echo $info['commission2']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">
											<div commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">三级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[commission3]" class="layui-input" value="<?php echo $info['commission3']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<div>持续推荐奖励(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[commission_parent]" class="layui-input" value="<?php echo $info['commission_parent']; ?>">
									</div>
									<?php if(getcustom('commission_parent_pj') && !getcustom('commission_parent_pj_stop') && $auth_data=='all' || in_array('commission_parent_pj',$auth_data)): ?>
									<div class="layui-input-inline layui-module-itemL">
										<div>平级奖(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[commission_parent_pj]" class="layui-input" value="<?php echo $info['commission_parent_pj']; ?>">
									</div>
									<?php endif; if(getcustom('commission_parent_bcy_send_once')): ?>
										<div class="layui-input-inline layui-module-itemL">
											<div>被超越奖(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
											<input type="text" name="info[commission_parent_bcy]" class="layui-input" value="<?php echo $info['commission_parent_bcy']; ?>">
										</div>
									<?php endif; if(getcustom('commission_appointlevelid')): ?>
									<div class="layui-input-inline layui-module-itemL">
										<div>指定等级ID</div>
										<input type="text" name="info[commission_appointlevelid]" class="layui-input" value="<?php echo $info['commission_appointlevelid']; ?>">
									</div>
									<?php endif; ?>
									<div class="layui-form-mid layui-word-aux layui-clear">用户直接推荐的是一级，用户的下级推荐的是二级，用户的下级的下级推荐的是三级<br>
									持续推荐奖励：当一二三级获得提成时，一二三级的直属上级（分销商身份）可获得下级提成金额的百分比或固定金额作为奖励，由平台发放（限商城订单）<br>
										* 当商家开启独立收款并且开启商家返款扣除分销佣金时，提成金额比例+平台抽成金额比例不能超过30%（微信支付分账限制）
									<?php if(getcustom('commission_parent_bcy_send_once')): ?>
										<br>
										被超越奖：当下级超越上级的时候，下级以下团队再出现订单会有一个被超越奖给最近的上级，只发一次。
									<?php endif; ?>
									</div>
								</div>
								<?php if(getcustom('commission_shengdai_special') && $sysset['commission_shengdai_special'] == 1): ?>
								<div class="layui-form-item" id="tichengBox1" <?php if($info['commissiontype']==2): ?>style="display:none;"<?php endif; ?>>
									<label class="layui-form-label">省代特殊奖</label>
									<div class="layui-input-inline layui-module-itemL" shengdai_special_commission1>
										<div shengdai_special_commission1 >一级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>) </div>
										<input type="text" name="info[shengdai_special_commission1]" class="layui-input" value="<?php echo $info['shengdai_special_commission1']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" shengdai_special_commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">
										<div shengdai_special_commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">二级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[shengdai_special_commission2]" class="layui-input" value="<?php echo $info['shengdai_special_commission2']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" shengdai_special_commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">
										<div shengdai_special_commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">三级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[shengdai_special_commission3]" class="layui-input" value="<?php echo $info['shengdai_special_commission3']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">如果开启并设置了此项，分销奖励则以下单会员此设置进行发放
									</div>
								</div>
								<?php endif; if(getcustom('commission_gangwei')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">岗位提成</label>

									<div class="layui-input-inline layui-module-itemL">
										<div >直推奖% </div>
										<input type="text" name="info[gangwei1]" class="layui-input" value="<?php echo $info['gangwei1']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<div >岗位提成%</div>
										<input type="text" name="info[gangwei2]" class="layui-input" value="<?php echo $info['gangwei2']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux">金额小于1元不再发放</div>
								</div>
								<?php endif; if(getcustom('commission_platform_avg_bonus')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">平台奖励</label>
									<div class="layui-input-inline" style="width:60px">
										<input type="text" class="layui-input" name="info[platform_avgbonus_percent]" value="<?php echo $info['platform_avgbonus_percent']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux">%，可额外获得平台销售业绩x%的平均加权奖励</div>
								</div>
								<?php endif; if(getcustom('commission_parent_pj_stop')): if($auth_data=='all' || in_array('commission_parent_pj_stop',$auth_data)): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">提成平级奖</label>
									<div class="layui-input-inline" style="width:200px">
										<input type="radio" name="info[commission_parent_pj_status]" value="0" title="关闭" <?php if($info['commission_parent_pj_status']==0): ?>checked<?php endif; ?>  lay-filter="commissionpj">
										<input type="radio" name="info[commission_parent_pj_status]" value="1" title="开启" <?php if($info['commission_parent_pj_status']==1): ?>checked<?php endif; ?>  lay-filter="commissionpj">
									</div>
									<div class="layui-input-inline layui-module-itemL commissionpj" style="<?php if($info['commission_parent_pj_status']==0): ?>display:none;<?php endif; ?>">
										<div>平级级数</div>
										<input type="text" name="info[commission_parent_pj_lv]" class="layui-input" value="<?php echo (isset($info['commission_parent_pj_lv']) && ($info['commission_parent_pj_lv'] !== '')?$info['commission_parent_pj_lv']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL commissionpj" style="<?php if($info['commission_parent_pj_status']==0): ?>display:none;<?php endif; ?>">
										<div>平级奖(元)</div>
										<input type="text" name="info[commission_parent_pj]" class="layui-input" value="<?php echo $info['commission_parent_pj']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL commissionpj" style="<?php if($info['commission_parent_pj_status']==0): ?>display:none;<?php endif; ?>">
										<div>支付金额比例(%)</div>
										<input type="text" name="info[commission_parent_pj_order]" class="layui-input" value="<?php echo $info['commission_parent_pj_order']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">
										1、开启平级奖后推荐人级别和下级相等时只发放平级奖不发放提成<br/>
										2、开启平级奖后推荐人级别小于下级不发放提成<br/>
										3、平级级数代表处理团队多少级以内的会员，超出级数不再发放奖金，0表示不限制
									</div>
								</div>
								<?php endif; ?>
								<?php endif; if(getcustom('plug_ttdz')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">复购提成</label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1> 一级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>) </div>
										<input type="text" name="info[commission4]" class="layui-input" value="<?php echo $info['commission4']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">
										<div commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">二级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[commission5]" class="layui-input" value="<?php echo $info['commission5']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">
										<div commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">三级(<span class="commissionunit"><?php echo $info['commissiontype']==1 ? '元' : '%'; ?></span>)</div>
										<input type="text" name="info[commission6]" class="layui-input" value="<?php echo $info['commission6']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear"></div>
								</div>
								<?php endif; ?>

								<div class="layui-form-item">
									<label class="layui-form-label">推荐<?php echo t('积分'); ?></label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1> 一级(<?php echo t('积分'); ?>) </div>
										<input type="text" name="info[score1]" class="layui-input" value="<?php echo (isset($info['score1']) && ($info['score1'] !== '')?$info['score1']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">
										<div commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">二级(<?php echo t('积分'); ?>)</div>
										<input type="text" name="info[score2]" class="layui-input" value="<?php echo (isset($info['score2']) && ($info['score2'] !== '')?$info['score2']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">
										<div commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">三级(<?php echo t('积分'); ?>)</div>
										<input type="text" name="info[score3]" class="layui-input" value="<?php echo (isset($info['score3']) && ($info['score3'] !== '')?$info['score3']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1>最高限制(<?php echo t('积分'); ?>)</div>
										<input type="text" name="info[scoremax]" class="layui-input" value="<?php echo (isset($info['scoremax']) && ($info['scoremax'] !== '')?$info['scoremax']:0); ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">每推荐一个人奖励多少<?php echo t('积分'); ?>；最高限制指每个人通过推荐获得最高积分数，高于此设置将不再获得推荐积分，0表示不限制</div>
								</div>
								<?php if(getcustom('member_shougou_parentreward')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">首购推荐奖励</label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1> 一级(%) </div>
										<input type="text" name="info[commissionsg1]" class="layui-input" value="<?php echo (isset($info['commissionsg1']) && ($info['commissionsg1'] !== '')?$info['commissionsg1']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">
										<div commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">二级(%)</div>
										<input type="text" name="info[commissionsg2]" class="layui-input" value="<?php echo (isset($info['commissionsg2']) && ($info['commissionsg2'] !== '')?$info['commissionsg2']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">
										<div commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">三级(%)</div>
										<input type="text" name="info[commissionsg3]" class="layui-input" value="<?php echo (isset($info['commissionsg3']) && ($info['commissionsg3'] !== '')?$info['commissionsg3']:0); ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">按当前购买者等级设置，返给推荐人奖励</div>
								</div>
								<?php endif; if(getcustom('maidan_commission_score')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">买单提成<?php echo t('积分'); ?></label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1>一级(%) </div>
										<input type="text" name="info[maidan_commission_score1]" class="layui-input" value="<?php echo (isset($info['maidan_commission_score1']) && ($info['maidan_commission_score1'] !== '')?$info['maidan_commission_score1']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">
										<div commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">二级(%)</div>
										<input type="text" name="info[maidan_commission_score2]" class="layui-input" value="<?php echo (isset($info['maidan_commission_score2']) && ($info['maidan_commission_score2'] !== '')?$info['maidan_commission_score2']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">
										<div commission3 style="<?php if($info['can_agent']<3): ?>display:none;<?php endif; ?>">三级(%)</div>
										<input type="text" name="info[maidan_commission_score3]" class="layui-input" value="<?php echo (isset($info['maidan_commission_score3']) && ($info['maidan_commission_score3'] !== '')?$info['maidan_commission_score3']:0); ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">买单成功后奖励<?php echo t('积分'); ?>，奖励积分后，不再计算提成金额；0表示不赠送</div>
								</div>
								<?php endif; if(getcustom('ciruikang_fenxiao')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">一次性购买升级奖励</label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1>一级(%) </div>
										<input type="text" name="info[onebuy_commission1]" class="layui-input" value="<?php echo (isset($info['onebuy_commission1']) && ($info['onebuy_commission1'] !== '')?$info['onebuy_commission1']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL" commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">
										<div commission2 style="<?php if($info['can_agent']<2): ?>display:none;<?php endif; ?>">二级(%)</div>
										<input type="text" name="info[onebuy_commission2]" class="layui-input" value="<?php echo (isset($info['onebuy_commission2']) && ($info['onebuy_commission2'] !== '')?$info['onebuy_commission2']:0); ?>">
									</div>
									<div class="layui-input-inline" style="width: 300px">
										<input type="radio" name="info[onebuy_commissionjs]" title="按分销等级" value="0" <?php if(!$info['onebuy_commissionjs'] || $info['onebuy_commissionjs']==0): ?>checked<?php endif; ?>>
										<input type="radio" name="info[onebuy_commissionjs]" title="按当前购买者等级" value="1" <?php if($info['onebuy_commissionjs']==1): ?>checked<?php endif; ?>>
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">直接推荐一个一次性(首购）升级的，奖励上级、上上级</div>
								</div>
								<?php endif; if(getcustom('member_realname_verify')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">推荐实名认证<?php echo t('佣金'); ?></label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1> 一级(<?php echo t('佣金'); ?>) </div>
										<input type="text" name="info[realname_commission1]" class="layui-input" value="<?php echo (isset($info['realname_commission1']) && ($info['realname_commission1'] !== '')?$info['realname_commission1']:0); ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">每推荐一个人实名认证奖励多少<?php echo t('佣金'); ?></div>
								</div>
								<?php endif; ?>
								<div class="layui-form-item">
									<label class="layui-form-label">推荐规则</label>
									<div class="layui-input-inline" style="width:800px">
										<input type="radio" name="info[agent_rule]" value="0" title="初次进入即绑定推荐关系" <?php if($info['agent_rule']==0 || $info['agent_rule']==''): ?>checked<?php endif; ?>>
										<input type="radio" name="info[agent_rule]" value="1" title="有推荐人时绑定推荐关系" <?php if($info['agent_rule']==1): ?>checked<?php endif; ?>>
										<input type="radio" name="info[agent_rule]" value="2" title="不绑定推荐关系" <?php if($info['agent_rule']==2): ?>checked<?php endif; ?>>
										<input type="radio" name="info[agent_rule]" value="3" title="首次消费后绑定推荐关系" <?php if($info['agent_rule']==3): ?>checked<?php endif; ?>>
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">初次进入即绑定推荐关系：只有没有进入过平台的新<?php echo t('会员'); ?>才能被推荐，并且初次进入就确定了推荐人，终身绑定，不会再被其他人推荐；<br/>有推荐人时绑定推荐关系：没有推荐人时可以被推荐，一旦有了推荐人，该<?php echo t('会员'); ?>的推荐人就确定了，不会再被其他人推荐；<br/>不绑定推荐关系：即使该<?php echo t('会员'); ?>有推荐人，当被另一个人推荐时，TA的推荐人就会变成后来推荐TA的人。<br/>首次消费后绑定推荐关系：即<?php echo t('会员'); ?>在未消费前，当被另一个人推荐时，TA的推荐人就会变成后来推荐TA的人。</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">自己拿一级提成</label>
									<div class="layui-input-inline" style="width:500px">
										<input type="radio" name="info[commission1own]" value="0" title="否" <?php if($info['commission1own']==0 || $info['commission1own']==''): ?>checked<?php endif; ?>>
										<input type="radio" name="info[commission1own]" value="1" title="是" <?php if($info['commission1own']==1): ?>checked<?php endif; ?>>
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">开启则表示一级为自己，即自己购买商品自己拿一级<?php echo t('佣金'); ?></div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">我的团队权限</label>
									<div class="layui-input-inline" style="width:600px">
										<input type="checkbox" name="info[team_showtel]" value="1" <?php if($info['team_showtel']==1): ?>checked<?php endif; ?> title="查看下级手机号" lay-skin="primary">
										<input type="checkbox" name="info[team_givemoney]" value="1" <?php if($info['team_givemoney']==1): ?>checked<?php endif; ?> title="给下级转余额" lay-skin="primary">
										<input type="checkbox" name="info[team_givescore]" value="1" <?php if($info['team_givescore']==1): ?>checked<?php endif; ?> title="给下级转积分" lay-skin="primary">
										<?php if(getcustom('member_levelup_givechild')): if($auth_data=='all' || in_array('MemberLevel/memberlevelupgivechild',$auth_data)): ?>
										<input type="checkbox" name="info[team_levelup]" value="1" <?php if($info['team_levelup']==1): ?>checked<?php endif; ?> title="给下级升级" lay-skin="primary" lay-filter="team_levelup">
										<?php endif; ?>
										<?php endif; if(getcustom('team_auth')): ?>
										<input type="checkbox" name="info[team_month_data]" value="1" <?php if($info['team_month_data']==1): ?>checked<?php endif; ?> title="月度数据" lay-skin="primary" lay-filter="primary">
										<input type="checkbox" name="info[team_down_total]" value="1" <?php if($info['team_down_total']==1): ?>checked<?php endif; ?> title="下级人数" lay-skin="primary" lay-filter="primary">
										<input type="checkbox" name="info[team_yeji]" value="1" <?php if($info['team_yeji']==1): ?>checked<?php endif; ?> title="团队业绩" lay-skin="primary" lay-filter="primary">
										<input type="checkbox" name="info[team_self_yeji]" value="1" <?php if($info['team_self_yeji']==1): ?>checked<?php endif; ?> title="个人业绩" lay-skin="primary" lay-filter="primary">
										<input type="checkbox" name="info[team_score]" value="1" <?php if($info['team_score']==1): ?>checked<?php endif; ?> title="积分" lay-skin="primary" lay-filter="primary">
										<?php endif; if(getcustom('yx_shortvideo_jindubag')): if($auth_data=='all' || in_array('Shortvideo',$auth_data)): ?>
												<input type="checkbox" name="info[team_shortvideo]" value="1" <?php if($info['team_shortvideo']==1): ?>checked<?php endif; ?> title="查看下级短视频记录" lay-skin="primary">
											<?php endif; ?>
										<?php endif; if(getcustom('team_view_down_to_down')): ?>
											<input type="checkbox" name="info[team_view_down_to_down]" value="1" <?php if($info['team_view_down_to_down']==1): ?>checked<?php endif; ?> title="查看团队人员的下级" lay-skin="primary">
										<?php endif; if(getcustom('team_view_zhitui_member_num')): ?>
											<input type="checkbox" name="info[team_view_zhitui_member_num]" value="1" <?php if($info['team_view_zhitui_member_num']==1): ?>checked<?php endif; ?> title="查看一级直推人数" lay-skin="primary">
										<?php endif; if(getcustom('team_update_member_info')): ?>
											<input type="checkbox" name="info[team_update_member_info]" value="1" <?php if($info['team_update_member_info']==1): ?>checked<?php endif; ?> title="修改下级成员资料" lay-skin="primary">
										<?php endif; if(getcustom('team_tel_hide_middle_four')): ?>
											<input type="checkbox" name="info[team_tel_hide_middle_four]" value="1" <?php if($info['team_tel_hide_middle_four']==1): ?>checked<?php endif; ?> title="隐藏会员电话号码中间4位" lay-skin="primary">
										<?php endif; if(getcustom('team_show_down_order')): ?>
											<input type="checkbox" name="info[team_show_down_order]" value="1" <?php if($info['team_show_down_order']==1): ?>checked<?php endif; ?> title="查看下级推广订单数" lay-skin="primary">
										<?php endif; if(getcustom('team_list_level_search')): ?>
											<input type="checkbox" name="info[team_show_level_tab]" value="1" <?php if($info['team_show_level_tab']==1): ?>checked<?php endif; ?> title="显示级别标签切换" lay-skin="primary">
										<?php endif; ?>
									</div>
								</div>
								<?php if(getcustom('member_levelup_givechild')): if($auth_data=='all' || in_array('MemberLevel/memberlevelupgivechild',$auth_data)): ?>
								<div class="layui-form-item team_levelup_div" style="<?php if($info['team_levelup']!=1): ?> display:none <?php endif; ?>">
									<label class="layui-form-label">给下级升级设置</label>
									<!-- <div class="layui-input-inline layui-module-itemL">
										<div>等级ID</div>
										<input type="text" name="info[team_levelup_id]" class="layui-input" value="<?php echo $info['team_levelup_id']; ?>">
									</div>
									<div class="layui-form-mid"></div>
									<div class="layui-input-inline layui-module-itemL">
										<div>数量</div>
										<input type="text" name="info[team_levelup_num]" class="layui-input" value="<?php echo $info['team_levelup_num']; ?>">
									</div> -->
									
									<div style="float:left;" >
										<div class="layui-input-inline" style="width:auto">
											<table id="setcategorydiv"  class="layui-table" style="width:400px">
												<thead>
												<tr>
													<th style="width:100px">名称</th>
													<th style="width:100px">升级数量</th>
												</tr>
												</thead>
												<?php if($levellist): foreach($levellist as $v): ?>
												<tr><td><?php echo $v['name']; ?></td><td><input type="number" name="team_levelup_data[<?php echo $v['id']; ?>]" value="<?php echo (isset($team_levelup_data[$v['id']]) && ($team_levelup_data[$v['id']] !== '')?$team_levelup_data[$v['id']]:0); ?>" class="layui-input" style="width:70px" /></td></tr>
												<?php endforeach; ?>
												<?php endif; ?>
											</table>
										</div>
									</div>
									<div class="layui-form-mid layui-word-aux">可以给下级升级的等级和数量,只能给比自己低的等级升级，升级后可升级的数量累计</div>
								</div>
								<?php endif; ?>
								<?php endif; if(getcustom('plug_huangfeihong')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">业绩统计</label>
									<div class="layui-input-inline" style="width:500px">
										<input type="radio" name="info[tongji_yeji]" value="0" title="否" <?php if($info['tongji_yeji']==0 || $info['tongji_yeji']==''): ?>checked<?php endif; ?>>
										<input type="radio" name="info[tongji_yeji]" value="1" title="是" <?php if($info['tongji_yeji']==1): ?>checked<?php endif; ?>>
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">开启后统计自己和所有下级的指定商品购买数量</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">业绩统计商品ID</label>
									<div class="layui-input-inline">
										<input type="text" name="info[tongji_yeji_proids]" class="layui-input" value="<?php echo $info['tongji_yeji_proids']; ?>">
									</div>
									<div class="layui-form-mid layui-word-aux">商品ID多个使用英文逗号“,”分隔，不指定则统计所有购买商品</div>
								</div>
								<?php endif; if(getcustom('commission_givedown')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">千里马奖</label>
									<div class="layui-input-inline layui-module-itemL">
										<div>提成比例(%) </div>
										<input type="text" name="info[givedown_percent]" class="layui-input" value="<?php echo (isset($info['givedown_percent']) && ($info['givedown_percent'] !== '')?$info['givedown_percent']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<div>提成金额(元)</div>
										<input type="text" name="info[givedown_commission]" class="layui-input" value="<?php echo (isset($info['givedown_commission']) && ($info['givedown_commission'] !== '')?$info['givedown_commission']:0); ?>">
									</div>
									<div class="layui-form-mid">自定义名称</div>
									<div class="layui-input-inline" style="width:170px">
										<input type="text" name="info[givedown_txt]" class="layui-input" value="<?php echo (isset($info['givedown_txt']) && ($info['givedown_txt'] !== '')?$info['givedown_txt']:'千里马奖'); ?>">
									</div>
									<div class="layui-form-mid layui-word-aux">拿出佣金的一部分比例给下级平分</div>
								</div>
								<?php endif; if(getcustom('commission_bole')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">分销伯乐奖</label>
									<div class="layui-input-inline layui-module-itemL">
										<div> 提成比例(%) </div>
										<input type="text" name="info[giveup_percent]" class="layui-input" value="<?php echo (isset($info['giveup_percent']) && ($info['giveup_percent'] !== '')?$info['giveup_percent']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<div> 提成金额(元) </div>
										<input type="text" name="info[giveup_commission]" class="layui-input" value="<?php echo (isset($info['giveup_commission']) && ($info['giveup_commission'] !== '')?$info['giveup_commission']:0); ?>">
									</div>
									<div class="layui-form-mid">仅发放原上级</div><!--新上级不发，只给原上级发-->
									<div class="layui-input-inline" style="width: 80px;">
										<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[commission_bole_origin]" value="1" <?php if($info['commission_bole_origin']==1): ?>checked<?php endif; ?> title="" lay-skin="primary">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">
										拿下级会员分销提成的奖金比例+金额
										<br>仅发放原上级：购买人脱离过的只给原上级或者没脱离过的当前上级发奖励
									</div>
								</div>
								<?php endif; if(getcustom('maidan_qrcode')): ?>
									<div class="layui-form-item" >
										<label class="layui-form-label">买单分成</label>
										<div class="layui-input-inline layui-module-itemL">
											<div>直推人扫码分成(%) </div>
											<input type="text" name="info[maidan_zt_ratio]" class="layui-input" value="<?php echo (isset($info['maidan_zt_ratio']) && ($info['maidan_zt_ratio'] !== '')?$info['maidan_zt_ratio']:0); ?>">
										</div>
										<div class="layui-input-inline layui-module-itemL">
											<div> 直推人间接消费分成(%) </div>
											<input type="text" name="info[maidan_zt_payother_ratio]" class="layui-input" value="<?php echo (isset($info['maidan_zt_payother_ratio']) && ($info['maidan_zt_payother_ratio'] !== '')?$info['maidan_zt_payother_ratio']:0); ?>">
										</div>
										<div class="layui-input-inline layui-module-itemL">
											<div> 非直推人收款分成(%) </div>
											<input type="text" name="info[maidan_nzt_payself_ratio]" class="layui-input" value="<?php echo (isset($info['maidan_nzt_payself_ratio']) && ($info['maidan_nzt_payself_ratio'] !== '')?$info['maidan_nzt_payself_ratio']:0); ?>">
										</div>
									</div>
								<?php endif; $jt_jinsuo_status = getcustom('business_agent_jt_jinsuo'); if(getcustom('business_agent')): ?>
									<div class="layui-form-item" >
										<label class="layui-form-label">推荐商家提成</label>
										<div class="layui-input-inline layui-module-itemL">
											<div>直推(%) </div>
											<input type="text" name="info[business_zt_ratio]" class="layui-input" value="<?php echo (isset($info['business_zt_ratio']) && ($info['business_zt_ratio'] !== '')?$info['business_zt_ratio']:0); ?>">
										</div>
										<div class="layui-input-inline layui-module-itemL">
											<div>间推(%) </div>
											<input type="text" name="info[business_jt_ratio]" class="layui-input" value="<?php echo (isset($info['business_jt_ratio']) && ($info['business_jt_ratio'] !== '')?$info['business_jt_ratio']:0); ?>">
										</div>
										<?php if($jt_jinsuo_status): ?>
										<div class="layui-form-mid">多层紧缩</div>
										<div class="layui-input-inline" style="width: 80px;">
											<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[business_jt_jinsuo_status]" value="1" <?php if($info['business_jt_jinsuo_status']==1): ?>checked<?php endif; ?> title="多层紧缩" lay-skin="primary" lay-filter="jt_jinsuo">
										</div>
									    <div id="pjjinsuo" >
											<div class="layui-input-inline layui-module-itemL">
												<div>直推平级(%) </div>
												<input type="text" name="info[business_zt_pj_ratio]" class="layui-input" value="<?php echo (isset($info['business_zt_pj_ratio']) && ($info['business_zt_pj_ratio'] !== '')?$info['business_zt_pj_ratio']:0); ?>">
											</div>
											<div class="layui-input-inline layui-module-itemL">
												<div>间推平级(%) </div>
												<input type="text" name="info[business_jt_pj_ratio]" class="layui-input" value="<?php echo (isset($info['business_jt_pj_ratio']) && ($info['business_jt_pj_ratio'] !== '')?$info['business_jt_pj_ratio']:0); ?>">
											</div>
										</div>
										<?php endif; ?>
										<div class="layui-form-mid layui-word-aux layui-clear">可以按结算金额、按平台抽成金额、按利润金额，获得商家所有类型订单的提成</div>
									</div>
								<?php endif; if(getcustom('business_agent_jicha_pj')): ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">推荐商家提成</label>
									<div class="layui-input-inline layui-module-itemL">
										<div>平级(%) </div>
										<input type="text" name="info[business_pj_ratio]" class="layui-input" value="<?php echo (isset($info['business_pj_ratio']) && ($info['business_pj_ratio'] !== '')?$info['business_pj_ratio']:0); ?>">
									</div>
									<div class="layui-form-mid">级差</div>
									<div class="layui-input-inline" style="width: 80px;">
										<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[business_jicha_status]" value="1" <?php if($info['business_jicha_status']==1): ?>checked<?php endif; ?> title="级差" lay-skin="primary">
									</div>
									<div class="layui-form-mid layui-word-aux">可以按结算金额、按平台抽成金额、按利润金额，获得商家所有类型订单的提成</div>
								</div>
								<?php endif; if(getcustom('member_level_set_invite_levelid')): ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">指定下级等级</label>
									<div class="layui-input-inline">
										<select name="info[invite_levelid]">
											<option value="0">请选择</option>
											<?php foreach($levellist as $v): ?>
											<option value="<?php echo $v['id']; ?>" <?php if($info['invite_levelid'] == $v['id']): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<?php endif; if(getcustom('member_level_breedcommission')): ?>
								<div class="layui-form-item">
									<label class="layui-form-label">培育奖</label>
									<div class="layui-input-inline layui-module-itemL" commission1>
										<div commission1> 直推(%) </div>
										<input type="text" name="info[breedcommission]" class="layui-input" value="<?php echo (isset($info['breedcommission']) && ($info['breedcommission'] !== '')?$info['breedcommission']:0); ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">下级所有佣金收益的百分比作为培育奖（培育奖只发一代发给直推，平台出；培育奖不再继续抽成发放）</div>
								</div>
								<?php endif; ?>
							</div>
						  <?php if(getcustom('coupon_xianxia_buy')): ?>
						  <div id="giveset_div">
							  <?php  $yeji_reward_data = json_decode($info['yeji_reward_data'],true); if($yeji_reward_data): foreach($yeji_reward_data as $k=>$give): ?>
							  <div class="layui-form-item">
								  <label class="layui-form-label"><?php if($k==0): ?>优惠券业绩奖励<?php endif; ?></label>
								  <div class="layui-form-mid">业绩满</div>
								  <div class="layui-input-inline" style="width:70px"><input type="text" name="yeji_limit[]" value="<?php echo $give['limit']; ?>" class="layui-input"></div>
								  <div class="layui-form-mid">元，奖励</div>
								  <div class="layui-input-inline" style="width:70px"><input type="text" name="yeji_reward[]" value="<?php echo $give['reward']; ?>" class="layui-input"></div>
								  <div class="layui-form-mid">%</div>
								  <?php if($k==0): ?>
								  <button type="button" class="layui-btn layui-btn-primary" onclick="adddata()">新增</button>
								  <?php else: ?>
								  <button type="button" class="layui-btn layui-btn-primary" onclick="deldata(this)">删除</button>
								  <?php endif; ?>
							  </div>
							  <?php endforeach; else: ?>
							  <div class="layui-form-item">
								  <label class="layui-form-label">优惠券业绩奖励</label>
								  <div class="layui-form-mid">业绩满</div>
								  <div class="layui-input-inline" style="width:70px"><input type="text" name="yeji_limit[]" value="" class="layui-input"></div>
								  <div class="layui-form-mid">元，奖励</div>
								  <div class="layui-input-inline" style="width:70px"><input type="text" name="yeji_reward[]" value="" class="layui-input"></div>
								  <div class="layui-form-mid">%</div>
								  <button type="button" class="layui-btn layui-btn-primary" onclick="adddata()">新增</button>
							  </div>
							  <?php endif; ?>
						
						  </div>
						  <script>
							  function adddata(){
								  var html = '';
								  html+='<div class="layui-form-item">';
								  html+='	<label class="layui-form-label"></label>';
								  html+='	<div class="layui-form-mid">业绩满</div>';
								  html+='	<div class="layui-input-inline" style="width:70px"><input type="text" name="yeji_limit[]" value="" class="layui-input"></div>';
								  html+='	<div class="layui-form-mid">元，奖励</div>';
								  html+='	<div class="layui-input-inline" style="width:70px"><input type="text" name="yeji_reward[]" value="" class="layui-input"></div>';
								  html+='	<div class="layui-form-mid">%</div>';
								  html+='	<button type="button" class="layui-btn layui-btn-primary" onclick="deldata(this)">删除</button>';
								  html+='</div>';
								  $('#giveset_div').append(html);
							  }
							  function deldata(obj){
								  $(obj).parent().remove();
							  }
						  </script>
						  <?php endif; if(getcustom('member_create_child_order')): if($create_child_order): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label">代客下单</label>
							  <div class="layui-input-inline" style="width:500px">
								  <input type="radio" name="info[create_child_order_status]" value="1" title="开启" <?php if(!$info['id'] || $info['create_child_order_status']==1): ?>checked<?php endif; ?>>
								  <input type="radio" name="info[create_child_order_status]" value="0" title="关闭" <?php if($info['id'] && $info['create_child_order_status']==0): ?>checked<?php endif; ?>>
							  </div>
						  </div>
						  <?php endif; ?>
						  <?php endif; if(getcustom('member_level_zhitui_number_limit')): ?>
						  <div class="layui-form-item">
						  	<label class="layui-form-label">直推人数限制</label>
							  <div class="layui-input-inline">
								  <input type="text" name="info[zt_member_limit]" class="layui-input" value="<?php echo $info['zt_member_limit']; ?>">
							  </div>
						  	<div class="layui-form-mid layui-word-aux">0:不限制 限制直推下级人数</div>
						  </div>
						  <?php endif; if(getcustom('commission_percent_to_parent')): ?>
								<fieldset class="layui-elem-field">
									<legend style="font-size:16px">上级分佣设置</legend>
									<div class="layui-form-item" style="margin-top: 10px">
										<label class="layui-form-label">上级佣金分账</label>
										<div class="layui-input-inline" style="width:500px">
											<input type="radio" name="info[commission_percent_to_parent_status]" value="1" title="开启" <?php if($info['id'] && $info['commission_percent_to_parent_status']==1): ?>checked<?php endif; ?> lay-filter="commission_percent_to_parent_status">
											<input type="radio" name="info[commission_percent_to_parent_status]" value="0" title="关闭" <?php if(!$info['id']  || $info['commission_percent_to_parent_status']==0): ?>checked<?php endif; ?> lay-filter="commission_percent_to_parent_status">
										</div>
									</div>
									<div id="commission_percent_to_parent" <?php if(!$info['commission_percent_to_parent_status']): ?> style="display: none;" <?php endif; ?>>
										<div class="layui-form-item">
											<label class="layui-form-label">分佣比例</label>
											<div class="layui-input-inline" style="width:220px">
												<input type="text" name="info[commission_percent_to_parent]" class="layui-input" value="<?php echo $info['commission_percent_to_parent']; ?>">
											</div>
											<div class="layui-form-mid">%</div>
											<div class="layui-form-mid layui-word-aux">获得佣金按比例分给上级或原上级</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">可分佣金类型</label>
											<div class="layui-input-inline" style="width:220px">
												<input type="checkbox" name="info[commission_percent_to_parent_type][]" value="1" title="分销佣金" lay-skin="primary" <?php if(in_array(1,$info['commission_percent_to_parent_type'])): ?>checked<?php endif; ?>/>
												<input type="checkbox" name="info[commission_percent_to_parent_type][]" value="2" title="分红佣金" lay-skin="primary" <?php if(in_array(2,$info['commission_percent_to_parent_type'])): ?>checked<?php endif; ?>/>
											</div>
											<div class="layui-form-mid layui-word-aux">设置可分佣金的类型</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">分佣方式</label>
											<div class="layui-input-inline" style="width:220px">
												<input type="radio" name="info[commission_percent_to_parent_divide_type]" value="1" title="从上级扣" <?php if(!$info['id'] || $info['commission_percent_to_parent_divide_type']==1): ?>checked<?php endif; ?>>
												<input type="radio" name="info[commission_percent_to_parent_divide_type]" value="0" title="额外分" <?php if($info['id'] && $info['commission_percent_to_parent_divide_type']==0): ?>checked<?php endif; ?>>
											</div>
											<div class="layui-form-mid layui-word-aux">选择从上级扣会以分佣比例扣除佣金相应金额发给上级，选择额外则不会扣除佣金金额</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">分佣条件</label>
											<div class="layui-input-inline" style="width:220px">
												<input type="radio" name="info[commission_percent_to_parent_condition]" value="0" title="未脱离" <?php if(!$info['id'] || $info['commission_percent_to_parent_condition']==0): ?>checked<?php endif; ?> lay-filter="commission_percent_to_parent_condition">
												<input type="radio" name="info[commission_percent_to_parent_condition]" value="1" title="脱离过上级" <?php if($info['id'] && $info['commission_percent_to_parent_condition']==1): ?>checked<?php endif; ?> lay-filter="commission_percent_to_parent_condition">
											</div>
											<div class="layui-form-mid layui-word-aux">表示当前<?php echo t('会员'); ?>的脱离状态，选择未脱离会给当前<?php echo t('会员'); ?>现上级发，选择脱离过上级则会根据分佣目标选择给当前<?php echo t('会员'); ?>原上级发，还是现上级发</div>
										</div>
										<div class="layui-form-item" id="commission_percent_to_parent_condition" <?php if($info['commission_percent_to_parent_condition'] == 0): ?> style="display: none;" <?php endif; ?>>
											<label class="layui-form-label">分佣目标</label>
											<div class="layui-input-inline" style="width:220px">
												<input type="radio" name="info[commission_percent_to_parent_target]" value="1" title="现上级" <?php if(!$info['id'] || $info['commission_percent_to_parent_target']==1): ?>checked<?php endif; ?>>
												<input type="radio" name="info[commission_percent_to_parent_target]" value="0" title="原上级" <?php if($info['id'] && $info['commission_percent_to_parent_target']==0): ?>checked<?php endif; ?>>
											</div>
										</div>
									</div>
								</fieldset>
							<?php endif; if(getcustom('commission_zhitui_special_first_order') && $sysset['commission_zhitui_special_first_order'] == 1): ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">直推特殊奖</label>
									<div class="layui-input-inline layui-module-itemL">
										<div>比例(%) </div>
										<input type="text" name="info[commission_zhitui_special_ratio]" class="layui-input" value="<?php echo (isset($info['commission_zhitui_special_ratio']) && ($info['commission_zhitui_special_ratio'] !== '')?$info['commission_zhitui_special_ratio']:0); ?>">
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">用户购买首单时，直推上级获得额外百分比的奖励，仅限于第一个订单</div>
								</div>
							<?php endif; ?>
						</div>

						<?php if($auth_data=='all' || in_array('gdfenhong',$auth_data) || in_array('teamfenhong',$auth_data) || in_array('areafenhong',$auth_data)): ?>
						<span style="color:#333">分红设置</span><hr/>
						<?php endif; if($auth_data=='all' || in_array('teamfenhong',$auth_data)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">团队分红</label>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红级数</div>
									<input type="text" name="info[teamfenhonglv]" class="layui-input" value="<?php echo (isset($info['teamfenhonglv']) && ($info['teamfenhonglv'] !== '')?$info['teamfenhonglv']:0); ?>">
								</div>
							
								<div class="layui-input-inline layui-module-itemL">
									<div>分红比例(%)</div>
									<input type="text" name="info[teamfenhongbl]" class="layui-input" value="<?php echo (isset($info['teamfenhongbl']) && ($info['teamfenhongbl'] !== '')?$info['teamfenhongbl']:0); ?>">
								</div>
								<?php if($maidan_fenhong_new==1): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>买单分红比例(%)</div>
									<input type="text" name="info[teamfenhongbl_maidan]" class="layui-input" value="<?php echo (isset($info['teamfenhongbl_maidan']) && ($info['teamfenhongbl_maidan'] !== '')?$info['teamfenhongbl_maidan']:0); ?>">
								</div>
								<?php endif; ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>每单分红金额</div>
									<input type="text" name="info[teamfenhong_money]" class="layui-input" value="<?php echo (isset($info['teamfenhong_money']) && ($info['teamfenhong_money'] !== '')?$info['teamfenhong_money']:0); ?>">
								</div>
								<?php if(getcustom('teamfenhong_score_percent')): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红<?php echo t('积分'); ?>比例(%)</div>
									<input type="text" name="info[teamfenhong_score_percent]" class="layui-input" value="<?php echo (isset($info['teamfenhong_score_percent']) && ($info['teamfenhong_score_percent'] !== '')?$info['teamfenhong_score_percent']:0); ?>">
								</div>
								<?php endif; ?>
								<div class="layui-form-mid">只给最近的上级分红</div>
								<div class="layui-input-inline" style="width: 80px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhongonly]" value="1" <?php if($info['teamfenhongonly']==1): ?>checked<?php endif; ?> title="只返最近的上级" lay-skin="primary">
								</div>
								<div class="layui-form-mid">包含自己</div>
								<div class="layui-input-inline" style="width: 70px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_self]" value="1" <?php if($info['teamfenhong_self']==1): ?>checked<?php endif; ?> title="包含自己" lay-skin="primary">
								</div>
								<?php if(getcustom('teamfenhong_removemax')): ?>
								<div class="layui-form-mid">去掉最高</div>
								<div class="layui-input-inline" style="width: 70px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_removemax]" value="1" <?php if($info['teamfenhong_removemax']==1): ?>checked<?php endif; ?> lay-skin="primary">
								</div>
								<?php endif; if(getcustom('fenhong_removefenxiao')): ?>
								<div class="layui-form-mid">扣除分销<?php echo t('佣金'); ?></div>
								<div class="layui-input-inline" style="width: 70px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_removefenxiao]" value="1" <?php if($info['teamfenhong_removefenxiao']==1): ?>checked<?php endif; ?> lay-skin="primary">
								</div>
								<?php endif; if(getcustom('teamfenhong_money_product')): ?>
								<div class="layui-form-mid layui-word-aux layui-clear">
									<div class="layui-form-mid">每单分红金额参与产品单独设置</div>
									<div class="layui-input-inline" style="width: 70px;">
										<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_money_product]" value="1" <?php if($info['teamfenhong_money_product']==1): ?>checked<?php endif; ?> lay-skin="primary">
									</div>
								</div>
								<?php endif; ?>
								<div class="layui-form-mid layui-word-aux layui-clear">设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级所有<?php echo t('会员'); ?>的所有商城订单的分红提成比例+每单分红金额；<br>开启只给最近的上级分红表示如果下单人有多个上级均符合分红条件则只给离他最近的上级分红，其他上级不分红</div>
								<?php if(getcustom('teamfenhong_yejitj')): ?>
								<div class="layui-form-item" style="margin-bottom:0px">
										<label class="layui-form-label"></label>
										<div class="layui-input-inline layui-module-itemL">
											<div class="layui-form-mid">上月业绩达标</div>
											<input type="text" name="info[teamfenhong_yeji_money]" class="layui-input" value="<?php echo (isset($info['teamfenhong_yeji_money']) && ($info['teamfenhong_yeji_money'] !== '')?$info['teamfenhong_yeji_money']:0); ?>" style="margin-right: 0">
											<div class="layui-form-mid">元</div>
										</div>
										<div class="layui-form-mid">业绩含自己</div>
									  <div class="layui-input-inline" style="width: 30px;">
											<input type="checkbox"  name="info[teamfenhong_yeji_self]" value="1" <?php if($info['id'] && $info['teamfenhong_yeji_self']==1): ?>checked<?php endif; ?> lay-skin="primary">
										</div>
									  <div class="layui-form-mid">业绩含运费</div>
									  <div class="layui-input-inline" style="width: 30px;">
											<input type="checkbox"  name="info[teamfenhong_yeji_yunfee]" value="1" <?php if(!$info['id'] || $info['teamfenhong_yeji_yunfee']==1): ?>checked<?php endif; ?> lay-skin="primary">
										</div>
									  <div class="layui-form-mid">业绩累积</div>
									  <div class="layui-input-inline" style="width: 30px;">
											<input type="checkbox" name="info[teamfenhong_yeji_total]" value="1" <?php if($info['teamfenhong_yeji_total']==1): ?>checked<?php endif; ?>  lay-skin="primary" lay-filter="teamfenhong_yeji_total">
										</div>
									  <div id="teamfenhong_yeji_month_set" class="layui-input-inline layui-module-itemL" style="<?php if($info['teamfenhong_yeji_total'] !=1): ?>display: none;<?php endif; ?>">
											<div class="layui-form-mid">累积</div>
											<input type="text" name="info[teamfenhong_yeji_month]" class="layui-input" value="<?php echo (isset($info['teamfenhong_yeji_month']) && ($info['teamfenhong_yeji_month'] !== '')?$info['teamfenhong_yeji_month']:0); ?>" style="margin-right: 0">
											<div class="layui-form-mid">月</div>
										</div>
										<div class="layui-form-mid layui-word-aux layui-clear">
											上月业绩达标X元：如5月1日开始，统计4月1日至4月30日团队商城已支付的订单业绩，仅适用“分红结算周期”为月初结算模式，且数额大于0才起效
											<br>业绩含自己：勾选后则会把自己的商城购买订单业绩也算入
											<br>业绩含运费：选后则会把配送方式中的运费、服务费统计在内，否则减去统计
											<br>业绩累积：开启后可设置累积X月（累积x月总业绩达标，大于0才起效），以当前月份之前的连续X个月开始统计计算，若统计的月份其中有被清零的月份，则从清零月份之后的月份开始统计，累积满X个月后，仍未达标团队业绩清零
									</div>
								</div>
								<?php endif; ?>
							</div>
							  <?php if(getcustom('teamfenhong_share')): if($auth_data=='all' || in_array('teamfenhong_share',$auth_data)): ?>
							  <div class="layui-form-item"><!--下级晋升为老板后给新上级贡献的见点奖和原推荐人（成为老板，如果原推荐人不是老板的时候100%全给新上级）平分（可以自定义），这个奖名称“团队分红共享奖”（名称可自定义）;按比例分的时候叫“共享奖”，不按比例的时候还是叫“团队分红”-->
								  <label class="layui-form-label">团队分红共享奖</label>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>新上级（本人）奖励比例(%)</div>
									  <input type="text" name="info[teamfenhong_share_pid_bl]" class="layui-input" value="<?php echo (isset($info['teamfenhong_share_pid_bl']) && ($info['teamfenhong_share_pid_bl'] !== '')?$info['teamfenhong_share_pid_bl']:100); ?>">
								  </div>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>原上级奖励比例(%)</div>
									  <input type="text" name="info[teamfenhong_share_pid_origin_bl]" class="layui-input" value="<?php echo (isset($info['teamfenhong_share_pid_origin_bl']) && ($info['teamfenhong_share_pid_origin_bl'] !== '')?$info['teamfenhong_share_pid_origin_bl']:0); ?>">
								  </div>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>原上级等级ID</div>
									  <input type="text" name="info[teamfenhong_share_pid_origin_levelid]" class="layui-input" value="<?php echo (isset($info['teamfenhong_share_pid_origin_levelid']) && ($info['teamfenhong_share_pid_origin_levelid'] !== '')?$info['teamfenhong_share_pid_origin_levelid']:0); ?>">
								  </div>
								  <!--<div class="layui-input-inline layui-module-itemL">
									  <div>下单人等级ID</div>
									  <input type="text" name="info[teamfenhong_share_buy_levelid]" class="layui-input" value="<?php echo (isset($info['teamfenhong_share_buy_levelid']) && ($info['teamfenhong_share_buy_levelid'] !== '')?$info['teamfenhong_share_buy_levelid']:0); ?>">
								  </div>-->
								  <div class="layui-input-inline layui-module-itemL">
									  <div>下级等级ID</div>
									  <input type="text" name="info[teamfenhong_share_down_levelid]" class="layui-input" value="<?php echo (isset($info['teamfenhong_share_down_levelid']) && ($info['teamfenhong_share_down_levelid'] !== '')?$info['teamfenhong_share_down_levelid']:0); ?>">
								  </div>
								  <div class="layui-form-mid layui-word-aux layui-clear">
									  本等级<?php echo t('会员'); ?>获得团队分红时，如果下级（符合条件）有原推荐人（符合条件），则两人共享此奖励，代替原团队分红发放，如原上级不存在或不符合条件则保持不变
									  <br>等级ID：0表示不限制，多个等级ID可用英文逗号间隔；
								  </div>
							  </div>
  								<?php endif; ?>
							  <?php endif; if(getcustom('teamfenhong_peiyujiang')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">团队培育奖</label>
								<div class="layui-input-inline layui-module-itemL">
									<div>奖励比例(%)</div>
									<input type="text" name="info[teamfenhong_peiyujiang_bl]" class="layui-input" value="<?php echo (isset($info['teamfenhong_peiyujiang_bl']) && ($info['teamfenhong_peiyujiang_bl'] !== '')?$info['teamfenhong_peiyujiang_bl']:0); ?>">
								</div>								
								<div class="layui-form-mid layui-word-aux layui-clear">拿直推下级团队分红的百分比</div>
							</div>
							<?php endif; if($teamfenhong_pingji): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">团队分红平级奖</label>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红级数</div>
									<input type="text" name="info[teamfenhong_pingji_lv]" class="layui-input" value="<?php echo (isset($info['teamfenhong_pingji_lv']) && ($info['teamfenhong_pingji_lv'] !== '')?$info['teamfenhong_pingji_lv']:0); ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>奖励比例(%)</div>
									<input type="text" name="info[teamfenhong_pingji_bl]" class="layui-input" value="<?php echo (isset($info['teamfenhong_pingji_bl']) && ($info['teamfenhong_pingji_bl'] !== '')?$info['teamfenhong_pingji_bl']:0); ?>">
								</div>
								<?php if($maidan_fenhong_new==1): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>买单奖励比例(%)</div>
									<input type="text" name="info[teamfenhong_pingji_bl_maidan]" class="layui-input" value="<?php echo (isset($info['teamfenhong_pingji_bl_maidan']) && ($info['teamfenhong_pingji_bl_maidan'] !== '')?$info['teamfenhong_pingji_bl_maidan']:0); ?>">
								</div>
								<?php endif; ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>每单奖励金额</div>
									<input type="text" name="info[teamfenhong_pingji_money]" class="layui-input" value="<?php echo (isset($info['teamfenhong_pingji_money']) && ($info['teamfenhong_pingji_money'] !== '')?$info['teamfenhong_pingji_money']:0); ?>">
								</div>
								<?php if(getcustom('fenhong_score_percent')): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>奖励<?php echo t('积分'); ?>比例(%)</div>
									<input type="text" name="info[teamfenhong_pingji_score_percent]" class="layui-input" value="<?php echo (isset($info['teamfenhong_pingji_score_percent']) && ($info['teamfenhong_pingji_score_percent'] !== '')?$info['teamfenhong_pingji_score_percent']:0); ?>">
								</div>
								<?php endif; ?>

								<input type="radio" name="info[teamfenhong_pingji_type]" value="0" title="按奖励金额" <?php if($info['teamfenhong_pingji_type']==0): ?>checked<?php endif; ?>>
								<input type="radio" name="info[teamfenhong_pingji_type]" value="1" title="按订单金额" <?php if($info['teamfenhong_pingji_type']==1): ?>checked<?php endif; ?>>

								<div class="layui-form-mid layui-word-aux layui-clear">如果下级有团队分红并且下级等级和自己等级相同则拿下级团队分红金额的奖励比例+每单奖励金额，<br>按奖励金额表示拿下级团队分红金额的比例,按订单金额表示拿订单金额的比例</div>
							</div>
							  <?php if(getcustom('teamfenhong_pingji_origin')): ?>
							  <div class="layui-form-item">
								  <div class="layui-form-label">团队分红平级奖发放网体</div>
								  <div class="layui-input-inline" style="width: 500px;">
									  <input type="radio" name="info[teamfenhong_pingji_origin]" value="0" title="发放给现上级" <?php if($info['teamfenhong_pingji_origin']==0): ?>checked<?php endif; ?>>
									  <input type="radio" name="info[teamfenhong_pingji_origin]" value="1" title="优先发放原上级" <?php if($info['teamfenhong_pingji_origin']==1): ?>checked<?php endif; ?>>
									  <input type="radio" name="info[teamfenhong_pingji_origin]" value="2" title="仅发放给原上级" <?php if($info['teamfenhong_pingji_origin']==2): ?>checked<?php endif; ?>>
								  </div>
								  <div class="layui-form-mid layui-word-aux layui-clear">
									  发放给现上级：按当前推荐网体关系发放<br/>
									  优先发放原上级：如果是脱离的会员按原上级的推荐网体发放，否则按当前推荐网体发放<br/>
									  仅发放给原上级：仅发放给原上级，没有原上级不发放该奖励
								  </div>
							  </div>
							  <?php endif; if(getcustom('teamfenhong_pingji_num')): ?>
							  <div class="layui-form-item">
								  <label class="layui-form-label">平级奖个数</label>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>发奖个数</div>
									  <input type="text" name="info[teamfenhong_pingji_num]" class="layui-input" value="<?php echo (isset($info['teamfenhong_pingji_num']) && ($info['teamfenhong_pingji_num'] !== '')?$info['teamfenhong_pingji_num']:0); ?>">
								  </div>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>合并级别ID</div>
									  <input type="text" name="info[teamfenhong_pingji_num_levelids]" class="layui-input" value="<?php echo (isset($info['teamfenhong_pingji_num_levelids']) && ($info['teamfenhong_pingji_num_levelids'] !== '')?$info['teamfenhong_pingji_num_levelids']:0); ?>">
								  </div>
								  <div class="layui-form-mid layui-word-aux layui-clear">
									  1、[分红级数]是指该等级会员购物时向上发放奖金层级<br/>
									  2、[发放个数]是指团队分红平级奖发放给该等级的最大人数<br/>
									  3、[合并级别ID]是指该级别与合并级别拿的数量相加不能大于[发放个数]，多个id用英文逗号分割
								  </div>
							  </div>
						  <?php endif; if(getcustom('teamfenhong_pingji_single_bl')): ?>
						  <fieldset class="layui-elem-field">
							  <legend>团队分红平级单独比例</legend>
							  <div class="layui-form-item">
								  <label class="layui-form-label">平级单独比例：</label>
								  <div class="layui-input-inline" style="width:auto; overflow: hidden;">
									  <div class="layui-tab">
										  <div class="layui-tab-content">
											  <div class="layui-tab-item layui-show give-coupon-shop">
												  <table class="layui-table choose-pj-up" style="width:500px" id="choose-pj-up">
													  <thead>
													  <tr>
														  <th>级数</th>
														  <th>奖励比例(%)</th>
														  <th>每单奖励金额</th>
														  <th>操作</th>
													  </tr>
													  </thead>
													  <?php if($teamfenhong_pingji_single_bl): foreach($teamfenhong_pingji_single_bl as $lv=>$item): $set_count = count($teamfenhong_pingji_single_bl); ?>

													  <tr class="choose-tr-list">
														  <td>
															  <span><?php echo $lv; ?></span>级
														  </td>
														  <td>
															  <input type="text" name="teamfenhong_pingji_single_bl[<?php echo $lv; ?>]" value="<?php echo $teamfenhong_pingji_single_bl[$lv]; ?>" class="layui-input" style="display:inline-block;width:80px"/> %
														  </td>
														  <td>
															  <input type="text" name="teamfenhong_pingji_single_money[<?php echo $lv; ?>]" value="<?php echo $teamfenhong_pingji_single_money[$lv]; ?>" class="layui-input" style="display:inline-block;width:80px"/> 元
														  </td>
														  <td class="del-class"><?php if($lv==$set_count): ?><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delpj(this)">删除</button><?php endif; ?></td>
													  </tr>
													  <?php endforeach; else: ?>
													  <tr class="choose-tr-list">
														  <td>
															  <span>1</span>级
														  </td>
														  <td>
															  <input type="text" name="teamfenhong_pingji_single_bl[1]" value="" class="layui-input" style="display:inline-block;width:80px"/> %
														  </td>
														  <td>
															  <input type="text" name="teamfenhong_pingji_single_money[1]" value="" class="layui-input" style="display:inline-block;width:80px"/> 元
														  </td>
														  <td class="del-class"></td>
													  </tr>
													  <?php endif; ?>
													  <tr class="choose-tr-add">
														  <td colspan="5" align="center"><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="addpj()">添加</button></td>
													  </tr>
												  </table>
												  <script>
													  function addpj(){
													  	var lv = $('.choose-pj-up').find('.choose-tr-list').length;
													  	lv = lv+1;
													  	console.log(lv);
														  var tr = '<tr class="choose-tr-list">' +
																  '<td><span>'+lv+'</span>级</td>'+
																  '<td><input type="text" name="teamfenhong_pingji_single_bl['+lv+']" value="" class="layui-input" style="display:inline-block;width:80px"/> %</td>' +
																  '<td><input type="text" name="teamfenhong_pingji_single_money['+lv+']" value="" class="layui-input" style="display:inline-block;width:80px"/> 元</td>' +
																  '<td class="del-class"></td>' +
																  '</tr>';
														  $('.choose-pj-up').find('.choose-tr-list:last').after(tr);
														  $('.choose-pj-up').find('.choose-tr-list').find('.del-class').html('');
														  $('.choose-pj-up').find('.choose-tr-list:last').find('.del-class:last').html('<button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delpj(this)">删除</button>');
													  }
													  function delpj(obj){
														  $(obj).closest('.choose-tr-list').remove();
														  var lv = $('.choose-pj-up').find('.choose-tr-list').length;
														  if(lv>1){
															  $('.choose-pj-up').find('.choose-tr-list:last').find('.del-class:last').html('<button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delpj(this)">删除</button>');
														  }
													  }
												  </script>
											  </div>
										  </div>
									  </div>
								  </div>
								  <div class="layui-form-mid layui-word-aux layui-clear">团队分红平级奖自定义比例，不设置或设置为0按正常比例发放</div>
							  </div>
						  </fieldset>
						  <?php endif; ?>
							<?php endif; if(getcustom('teamfenhong_not_send_cengji')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label">不发放级数</label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>级数</div>
								  <input type="text" name="info[teamfenhong_not_lv]" class="layui-input" value="<?php echo $info['teamfenhong_not_lv']; ?>">
							  </div>
							  <div class="layui-form-mid layui-word-aux ">多个使用逗号间隔，如设置1,2</div>
						  </div>
						  <?php endif; if(getcustom('teamfenhong_jicha')): ?>
						  <!--**********************团队级差分红start 20231118**************************-->
						  <fieldset class="layui-elem-field">
							  <legend>团队级差分红</legend>
						  <div class="layui-form-item">
							  <label class="layui-form-label">团队级差分红</label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红比例(%)</div>
								  <input type="text" name="info[teamjichabl]" class="layui-input" value="<?php echo (isset($info['teamjichabl']) && ($info['teamjichabl'] !== '')?$info['teamjichabl']:0); ?>">
							  </div>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>每单分红金额</div>
								  <input type="text" name="info[teamjicha_money]" class="layui-input" value="<?php echo (isset($info['teamjicha_money']) && ($info['teamjicha_money'] !== '')?$info['teamjicha_money']:0); ?>">
							  </div>
							  <div class="layui-form-mid layui-word-aux layui-clear">设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级所有<?php echo t('会员'); ?>的所有商城订单的分红提成比例+每单分红金额；<br>开启只给最近的上级分红表示如果下单人有多个上级均符合分红条件则只给离他最近的上级分红，其他上级不分红</div>
						  </div>
						  <div class="layui-form-item">
							  <label class="layui-form-label"><?php echo t('团队级差分红'); ?>平级奖</label>

							  <div class="layui-input-inline layui-module-itemL">
								  <div>奖励比例(%)</div>
								  <input type="text" name="info[teamjicha_pingji_bl]" class="layui-input" value="<?php echo (isset($info['teamjicha_pingji_bl']) && ($info['teamjicha_pingji_bl'] !== '')?$info['teamjicha_pingji_bl']:0); ?>">
							  </div>

							  <div class="layui-input-inline layui-module-itemL">
								  <div>每单奖励金额</div>
								  <input type="text" name="info[teamjicha_pingji_money]" class="layui-input" value="<?php echo (isset($info['teamjicha_pingji_money']) && ($info['teamjicha_pingji_money'] !== '')?$info['teamjicha_pingji_money']:0); ?>">
							  </div>
							  <input type="radio" name="info[teamjicha_pingji_type]" value="0" title="按奖励金额" <?php if($info['teamjicha_pingji_type']==0): ?>checked<?php endif; ?>>
							  <input type="radio" name="info[teamjicha_pingji_type]" value="1" title="按订单金额" <?php if($info['teamjicha_pingji_type']==1): ?>checked<?php endif; ?>>
							  <div class="layui-form-mid layui-word-aux layui-clear">如果下级有团队分红并且下级等级和自己等级相同则拿下级团队分红金额的奖励比例+每单奖励金额，<br>按奖励金额表示拿下级团队分红金额的比例,按订单金额表示拿订单金额的比例</div>
						  </div>
						  </fieldset>

						  <!--**********************团队级差分红end 20231118**************************-->
						  <?php endif; ?>
						  <!--****************************团队长分红start 20231123***********************************-->
						  <?php if(getcustom('team_leader_fh')): ?>
						  <fieldset class="layui-elem-field">
							  <legend>团队长分红</legend>
						  <div class="layui-form-item">
							  <label class="layui-form-label">团队长分红</label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红级数</div>
								  <input type="text" name="info[teamleader_fenhonglv]" class="layui-input" value="<?php echo (isset($info['teamleader_fenhonglv']) && ($info['teamleader_fenhonglv'] !== '')?$info['teamleader_fenhonglv']:0); ?>">
							  </div>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红比例(%)</div>
								  <input type="text" name="info[teamleader_fenhongbl]" class="layui-input" value="<?php echo (isset($info['teamleader_fenhongbl']) && ($info['teamleader_fenhongbl'] !== '')?$info['teamleader_fenhongbl']:0); ?>">
							  </div>

							  <div class="layui-input-inline layui-module-itemL">
								  <div>每单分红金额</div>
								  <input type="text" name="info[teamleader_fenhong_money]" class="layui-input" value="<?php echo (isset($info['teamleader_fenhong_money']) && ($info['teamleader_fenhong_money'] !== '')?$info['teamleader_fenhong_money']:0); ?>">
							  </div>
							  <div class="layui-form-mid">包含自己</div>
							  <div class="layui-input-inline" style="width: 70px;">
								  <input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamleader_fenhong_self]" value="1" <?php if($info['teamleader_fenhong_self']==1): ?>checked<?php endif; ?> title="包含自己" lay-skin="primary">
							  </div>
							  <div class="layui-form-mid layui-word-aux layui-clear">
								  设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级所有<?php echo t('会员'); ?>的所有商城订单的分红提成比例+每单分红金额；<br>
							  </div>
						  </div>
						  </fieldset>
						  <?php endif; ?>
						  <!--****************************团队长分红end 20231123*************************************-->
						  <?php if(getcustom('teamfenhong_bole') && ($auth_data=='all' || in_array('teamfenhong_bole',$auth_data))): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label"><?php echo t('团队分红伯乐奖'); ?></label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>奖励比例(%)</div>
								  <input type="text" name="info[teamfenhong_bole_bl]" class="layui-input" value="<?php echo (isset($info['teamfenhong_bole_bl']) && ($info['teamfenhong_bole_bl'] !== '')?$info['teamfenhong_bole_bl']:0); ?>">
							  </div>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>脱离奖励比例(%)</div>
								  <input type="text" name="info[teamfenhong_bole_bl_tuoli]" class="layui-input" value="<?php echo (isset($info['teamfenhong_bole_bl_tuoli']) && ($info['teamfenhong_bole_bl_tuoli'] !== '')?$info['teamfenhong_bole_bl_tuoli']:0); ?>">
							  </div>
							  <?php if($maidan_fenhong_new==1): ?>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>买单奖励比例(%)</div>
								  <input type="text" name="info[teamfenhong_bole_bl_maidan]" class="layui-input" value="<?php echo (isset($info['teamfenhong_bole_bl_maidan']) && ($info['teamfenhong_bole_bl_maidan'] !== '')?$info['teamfenhong_bole_bl_maidan']:0); ?>">
							  </div>
							  <?php endif; ?>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>每单奖励金额</div>
								  <input type="text" name="info[teamfenhong_bole_money]" class="layui-input" value="<?php echo (isset($info['teamfenhong_bole_money']) && ($info['teamfenhong_bole_money'] !== '')?$info['teamfenhong_bole_money']:0); ?>">
							  </div>
							  <div class="layui-input-inline" style="width: auto">
								  <input type="radio" name="info[teamfenhong_bole_type]" value="0" title="按奖励金额" <?php if($info['teamfenhong_bole_type']==0): ?>checked<?php endif; ?>>
								  <input type="radio" name="info[teamfenhong_bole_type]" value="1" title="按订单金额" <?php if($info['teamfenhong_bole_type']==1): ?>checked<?php endif; ?>>
							  </div>
							  <div class="layui-form-mid">本等级只发一次</div>
							  <div class="layui-input-inline" style="width: 80px;">
								  <input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_bole_one]" value="1" <?php if($info['teamfenhong_bole_one']==1): ?>checked<?php endif; ?> title="" lay-skin="primary">
							  </div>
							  <div class="layui-form-mid">仅发放原上级</div><!--新上级不发，只给原上级发-->
							  <div class="layui-input-inline" style="width: 80px;">
								  <input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_bole_origin]" value="1" <?php if($info['teamfenhong_bole_origin']==1): ?>checked<?php endif; ?> title="" lay-skin="primary">
							  </div>
							  <div class="layui-form-mid layui-word-aux layui-clear">如果下级有团队分红则拿下级团队分红金额的奖励比例+每单奖励金额<br>按奖励金额表示拿下级团队分红金额的比例,按订单金额表示拿订单金额的比例
								  <br>仅发放原上级：购买人脱离过的只给原上级或者没脱离过的当前上级发奖励</div>
						  </div>
						  <?php endif; ?>
  						  <!--团队见单分红start-->
  						  <?php if(getcustom('teamfenhong_jiandan')): if($auth_data=='all' || in_array('teamfenhongJiandan',$auth_data)): ?>
							  <div class="layui-form-item">
								  <label class="layui-form-label">团队见单分红</label>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>分红级数</div>
									  <input type="text" name="info[teamfenhong_jiandan_lv]" class="layui-input" value="<?php echo (isset($info['teamfenhong_jiandan_lv']) && ($info['teamfenhong_jiandan_lv'] !== '')?$info['teamfenhong_jiandan_lv']:0); ?>">
								  </div>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>分红比例(%)</div>
									  <input type="text" name="info[teamfenhong_jiandan_bl]" class="layui-input" value="<?php echo (isset($info['teamfenhong_jiandan_bl']) && ($info['teamfenhong_jiandan_bl'] !== '')?$info['teamfenhong_jiandan_bl']:0); ?>">
								  </div>
								  <?php if($maidan_fenhong_new==1): ?>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>买单分红比例(%)</div>
									  <input type="text" name="info[teamfenhong_jiandan_bl_maidan]" class="layui-input" value="<?php echo (isset($info['teamfenhong_jiandan_bl_maidan']) && ($info['teamfenhong_jiandan_bl_maidan'] !== '')?$info['teamfenhong_jiandan_bl_maidan']:0); ?>">
								  </div>
								  <?php endif; ?>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>每单分红金额</div>
									  <input type="text" name="info[teamfenhong_jiandan_money]" class="layui-input" value="<?php echo (isset($info['teamfenhong_jiandan_money']) && ($info['teamfenhong_jiandan_money'] !== '')?$info['teamfenhong_jiandan_money']:0); ?>">
								  </div>
								  <div class="layui-form-mid">只给最近的上级分红</div>
								  <div class="layui-input-inline" style="width: 80px;">
									  <input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_jiandan_only]" value="1" <?php if($info['teamfenhong_jiandan_only']==1): ?>checked<?php endif; ?> title="只返最近的上级" lay-skin="primary">
								  </div>
								  <div class="layui-form-mid">包含自己</div>
								  <div class="layui-input-inline" style="width: 70px;">
									  <input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[teamfenhong_jiandan_self]" value="1" <?php if($info['teamfenhong_jiandan_self']==1): ?>checked<?php endif; ?> title="包含自己" lay-skin="primary">
								  </div>
								  <div class="layui-form-mid layui-word-aux layui-clear">设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级所有<?php echo t('会员'); ?>的所有商城订单的分红提成比例+每单分红金额；<br>开启只给最近的上级分红表示如果下单人有多个上级均符合分红条件则只给离他最近的上级分红，其他上级不分红</div>
							  </div>
							  <?php endif; ?>
  						  <?php endif; ?>
  						  <!--团队见单分红end-->
							<?php if(getcustom('product_teamfenhong')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">商品团队分红</label>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红商品ID</div>
									<input type="text" name="info[product_teamfenhong_ids]" class="layui-input" value="<?php echo (isset($info['product_teamfenhong_ids']) && ($info['product_teamfenhong_ids'] !== '')?$info['product_teamfenhong_ids']:0); ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红级数</div>
									<input type="text" name="info[product_teamfenhonglv]" class="layui-input" value="<?php echo (isset($info['product_teamfenhonglv']) && ($info['product_teamfenhonglv'] !== '')?$info['product_teamfenhonglv']:0); ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>每个商品分红金额</div>
									<input type="text" name="info[product_teamfenhong_money]" class="layui-input" value="<?php echo (isset($info['product_teamfenhong_money']) && ($info['product_teamfenhong_money'] !== '')?$info['product_teamfenhong_money']:0); ?>">
								</div>
								<div class="layui-form-mid">只给最近的上级分红</div>
								<div class="layui-input-inline" style="width: 80px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[product_teamfenhongonly]" value="1" <?php if($info['product_teamfenhongonly']==1): ?>checked<?php endif; ?> title="只返最近的上级" lay-skin="primary">
								</div>
								<div class="layui-form-mid">包含自己</div>
								<div class="layui-input-inline" style="width: 100px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[product_teamfenhong_self]" value="1" <?php if($info['product_teamfenhong_self']==1): ?>checked<?php endif; ?> title="包含自己" lay-skin="primary">
								</div>

								<div class="layui-form-mid layui-word-aux layui-clear">设置分红级数和分红金额后该等级的人可以拿到其下[分红级数]级所有<?php echo t('会员'); ?>的所有商城订单中购买分红商品数量*分红金额；<br>分红商品ID为0时表示不限制商品，多个商品ID用英文逗号分隔</div>
							</div>
							<?php endif; if(getcustom('business_teamfenhong')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label"><?php echo t('商家团队分红'); ?></label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红级数</div>
								  <input type="text" name="info[business_teamfenhonglv]" class="layui-input" value="<?php echo (isset($info['business_teamfenhonglv']) && ($info['business_teamfenhonglv'] !== '')?$info['business_teamfenhonglv']:0); ?>">
							  </div>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红比例(%)</div>
								  <input type="text" name="info[business_teamfenhongbl]" class="layui-input" value="<?php echo (isset($info['business_teamfenhongbl']) && ($info['business_teamfenhongbl'] !== '')?$info['business_teamfenhongbl']:0); ?>">
							  </div>
							  <div class="layui-form-mid layui-word-aux layui-clear">设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级推荐商家的所有商城订单的分红提成比例；</div>
						  </div>
						  <?php endif; if(getcustom('business_teamfenhong_pj')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label"><?php echo t('商家团队分红平级奖'); ?></label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红级数</div>
								  <input type="text" name="info[business_teamfenhonglv_pj]" class="layui-input" value="<?php echo (isset($info['business_teamfenhonglv_pj']) && ($info['business_teamfenhonglv_pj'] !== '')?$info['business_teamfenhonglv_pj']:0); ?>">
							  </div>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红比例(%)</div>
								  <input type="text" name="info[business_teamfenhongbl_pj]" class="layui-input" value="<?php echo (isset($info['business_teamfenhongbl_pj']) && ($info['business_teamfenhongbl_pj'] !== '')?$info['business_teamfenhongbl_pj']:0); ?>">
							  </div>
							  <input type="radio" name="info[business_teamfenhong_pingji_type]" value="0" title="按奖励金额" <?php if($info['business_teamfenhong_pingji_type']==0): ?>checked<?php endif; ?>>
							  <input type="radio" name="info[business_teamfenhong_pingji_type]" value="1" title="按订单金额" <?php if($info['business_teamfenhong_pingji_type']==1): ?>checked<?php endif; ?>>
							  <div class="layui-form-mid layui-word-aux layui-clear">设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级推荐商家的所有商城订单的分红提成比例；</div>
						  </div>
						  <?php endif; if(getcustom('level_teamfenhong')): if($auth_data=='all' || in_array('level_teamfenhong',$auth_data)): ?>
								<div class="layui-form-item">
									<label class="layui-form-label"><?php echo t('等级团队分红'); ?></label>
									<div class="layui-input-inline layui-module-itemL">
										<div>团队等级ID</div>
										<input type="text" name="info[level_teamfenhong_ids]" class="layui-input" value="<?php echo $info['level_teamfenhong_ids']; ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<div>分红级数</div>
										<input type="text" name="info[level_teamfenhonglv]" class="layui-input" value="<?php echo (isset($info['level_teamfenhonglv']) && ($info['level_teamfenhonglv'] !== '')?$info['level_teamfenhonglv']:0); ?>">
									</div>
									<div class="layui-input-inline" style="width: 130px;margin-right: 0;">
										<select name="info[level_teamfenhongbl_type]">
											<option value="0" <?php if(!$info['level_teamfenhongbl_type'] || $info['level_teamfenhongbl_type'] == 0): ?>selected<?php endif; ?> >分红比例(%)</option>
											<option value="1" <?php if($info['level_teamfenhongbl_type'] == 1): ?>selected<?php endif; ?> >分红固定金额</option>
										</select>
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<input type="text" name="info[level_teamfenhongbl]" class="layui-input" value="<?php echo (isset($info['level_teamfenhongbl']) && ($info['level_teamfenhongbl'] !== '')?$info['level_teamfenhongbl']:0); ?>">
									</div>
									<div class="layui-input-inline layui-module-itemL">
										<div>每单分红金额</div>
										<input type="text" name="info[level_teamfenhong_money]" class="layui-input" value="<?php echo (isset($info['level_teamfenhong_money']) && ($info['level_teamfenhong_money'] !== '')?$info['level_teamfenhong_money']:0); ?>">
									</div>
									<div class="layui-form-mid">只给最近的上级分红</div>
									<div class="layui-input-inline" style="width: 100px;">
										<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[level_teamfenhongonly]" value="1" <?php if($info['level_teamfenhongonly']==1): ?>checked<?php endif; ?> title="只返最近的上级" lay-skin="primary">
									</div>
									<div class="layui-form-mid">直属下级等级超越此等级</div>
									<div class="layui-input-inline" style="width: 100px;">
										<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[level_surpass]" value="1" <?php if($info['level_surpass']==1): ?>checked<?php endif; ?> title="直属下级等级超越此级别" lay-skin="primary">
									</div>
									<div class="layui-form-mid">级差</div>
									<div class="layui-input-inline" style="width: 130px;margin-right: 0;">
										<select name="info[level_jicha]">
											<option value="-1" <?php if($info['level_jicha'] == -1): ?>selected<?php endif; ?> >关闭</option>
											<option value="0" <?php if(!$info['level_jicha'] || $info['level_jicha'] == 0): ?>selected<?php endif; ?> >跟随系统设置</option>
											<option value="1" <?php if($info['level_jicha'] == 1): ?>selected<?php endif; ?> >开启</option>
										</select>
									</div>
									<div class="layui-form-mid layui-word-aux layui-clear">
										等级ID：多个用英文逗号“,”分隔；设置等级ID、分红级数和分红比例后伞下该等级的人可以拿到其下等级几代ID下[分红级数]所有<?php echo t('会员'); ?>的所有商城订单的分红提成比例或分红固定金额+每单分红金额；
										<br>开启只给最近的上级分红表示如果下单人有多个上级均符合分红条件则只给离他最近的上级分红，其他上级不分红
										<br>开启直属下级等级超越此级别后，需要直属下级等级大于此等级，且直属下级及直属下级的下级团队符合[团队等级ID]设置
									</div>
								</div>
								<?php endif; ?>
							<?php endif; ?>
							<!--运费补贴 start-->
							<?php if($teamfenhong_freight): ?>
							<fieldset class="layui-elem-field">
							  <legend>运费补贴</legend>
							<div class="layui-form-item">
							  <label class="layui-form-label">运费补贴</label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>分红级数</div>
								  <input type="text" name="info[teamfenhong_freight_lv]" class="layui-input" value="<?php echo (isset($info['teamfenhong_freight_lv']) && ($info['teamfenhong_freight_lv'] !== '')?$info['teamfenhong_freight_lv']:0); ?>">
							  </div>

							  <div class="layui-input-inline layui-module-itemL">
								  <div>每单奖励金额</div>
								  <input type="text" name="info[teamfenhong_freight_money]" class="layui-input" value="<?php echo (isset($info['teamfenhong_freight_money']) && ($info['teamfenhong_freight_money'] !== '')?$info['teamfenhong_freight_money']:0); ?>">
							  </div>
							  <div class="layui-form-mid layui-word-aux layui-clear">设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级所有会员的所有商城订单运费的分红提成比例+每单分红金额；</div>
							</div>
							<?php endif; ?>
							<!--运费补贴 end-->

						<!--运费分红平级奖-->
						<?php if($teamfenhong_freight_pingji): ?>
						<div class="layui-form-item">
						  <label class="layui-form-label">团队运费分红平级奖</label>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>分红级数</div>
							  <input type="text" name="info[teamfenhong_freight_pingji_lv]" class="layui-input" value="<?php echo (isset($info['teamfenhong_freight_pingji_lv']) && ($info['teamfenhong_freight_pingji_lv'] !== '')?$info['teamfenhong_freight_pingji_lv']:0); ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>每单奖励金额</div>
							  <input type="text" name="info[teamfenhong_freight_pingji_money]" class="layui-input" value="<?php echo (isset($info['teamfenhong_freight_pingji_money']) && ($info['teamfenhong_freight_pingji_money'] !== '')?$info['teamfenhong_freight_pingji_money']:0); ?>">
						  </div>
						
						  <div class="layui-form-mid layui-word-aux layui-clear">如果下级有运费补贴并且下级等级和自己等级相同则拿下级运费补贴金额的奖励比例+每单奖励金额，每个级别平级奖只发一次</div>
						</div>
						<?php endif; ?>
						</fieldset>
						<!--运费分红平级奖-->
						<?php endif; if($auth_data=='all' || in_array('gdfenhong',$auth_data)): if(getcustom('fenhong_gudong_yeji')): ?>
						  <fieldset class="layui-elem-field">
							  <legend>股东分红设置</legend>
					  	<?php endif; ?>
							<div class="layui-form-item">
								<label class="layui-form-label">股东分红</label>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红比例(%)</div>
									<input type="text" name="info[fenhong]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong'] : 0; ?>">
								</div>
								<?php if(getcustom('fenhong_score_percent')): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红<?php echo t('积分'); ?>比例(%)</div>
									<input type="text" name="info[fenhong_score_percent]" class="layui-input" value="<?php echo (isset($info['fenhong_score_percent']) && ($info['fenhong_score_percent'] !== '')?$info['fenhong_score_percent']:0); ?>">
								</div>
								<?php endif; if(getcustom('fenhong_maidan_percent') || $maidan_fenhong_new==1): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红买单比例(%)</div>
									<input type="text" name="info[fenhong_maidan_percent]" class="layui-input" value="<?php echo (isset($info['fenhong_maidan_percent']) && ($info['fenhong_maidan_percent'] !== '')?$info['fenhong_maidan_percent']:0); ?>">
								</div>
								<?php endif; if(getcustom('fenhong_limit_num')): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红限制人数</div>
									<input type="text" name="info[fenhong_num]" class="layui-input" value="<?php echo (isset($info['fenhong_num']) && ($info['fenhong_num'] !== '')?$info['fenhong_num']:0); ?>">
								</div>
								<?php endif; if(getcustom('plug_sanyang') || getcustom('everyday_hongbao') || getcustom('fenhong_max')): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>每人分红金额上限</div>
									<input type="number" min="0" name="info[fenhong_max_money]" class="layui-input" value="<?php echo (isset($info['fenhong_max_money']) && ($info['fenhong_max_money'] !== '')?$info['fenhong_max_money']:0); ?>">
								</div>
								<?php endif; if($sysset['partner_gongxian']==1): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>团队业绩达</div>
									<input type="number" min="0" name="info[fenhong_gongxian_minyeji]" class="layui-input" value="<?php echo $info['fenhong_gongxian_minyeji']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>贡献分红比例(%)</div>
									<input type="number" min="0" name="info[fenhong_gongxian_percent]" class="layui-input" value="<?php echo $info['fenhong_gongxian_percent']; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>下级每出现一个同级股东增加份额</div>
									<input type="number" min="0" name="info[fenhong_gongxian_peraddnum]" class="layui-input" value="<?php echo $info['fenhong_gongxian_peraddnum']; ?>">
								</div>
								<?php endif; if(getcustom('fenhong_removefenxiao')): ?>
								<div class="layui-form-mid">扣除分销<?php echo t('佣金'); ?></div>
								<div class="layui-input-inline" style="width: 70px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[gdfenhong_removefenxiao]" value="1" <?php if($info['gdfenhong_removefenxiao']==1): ?>checked<?php endif; ?> lay-skin="primary">
								</div>
								<?php endif; ?>
								<div class="layui-form-mid layui-word-aux layui-clear">用于合伙人或股东分红，设置分红比例后该等级的所有人平均分摊所有商城订单的分红提成比例<?php if(getcustom('plug_sanyang')): ?>，分红上限为0则不限制<?php endif; ?></div>
							</div>
							  <?php if(getcustom('fenhong_gudong_yeji')): ?>
							  <div class="layui-form-item">
								  <label class="layui-form-label">股东分红拿奖条件</label>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>团队级数</div>
									  <input type="text" name="info[fenhong_yeji_lv]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong_yeji_lv'] : 0; ?>">
								  </div>
								  <div class="layui-input-inline layui-module-itemL">
									  <div>团队业绩达</div>
									  <input type="number" min="0" name="info[fenhong_yeji_num]" class="layui-input" value="<?php echo $info['fenhong_yeji_num']; ?>">
								  </div>
								  <div class="layui-form-mid layui-word-aux layui-clear">X级内团队业绩达到Y才可以拿股东分红奖，团队级数设置0代表所有团队，团队业绩设置0代表不考核业绩</div>
							  </div>
						  </fieldset>
						  <?php endif; ?>

						<?php endif; if(getcustom('fenhong_gudong_huiben')): if($auth_data=='all' || in_array('gdfenhong_huiben',$auth_data)): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label"><?php echo t('回本股东分红'); ?></label>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>分红比例(%)</div>
							  <input type="text" name="info[fenhong_huiben]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong_huiben'] : 0; ?>">
						  </div>

						  <div class="layui-input-inline layui-module-itemL">
							  <div>每人分红金额上限</div>
							  <input type="number" min="0" name="info[fenhong_max_money_huiben]" class="layui-input" value="<?php echo (isset($info['fenhong_max_money_huiben']) && ($info['fenhong_max_money_huiben'] !== '')?$info['fenhong_max_money_huiben']:0); ?>">
						  </div>
						  <div class="layui-form-mid layui-word-aux layui-clear">用于合伙人或股东分红，设置分红比例后该等级的所有人平均分摊所有商城订单的分红提成比例，分红上限为0则不限制</div>
					  </div>
  						<?php endif; ?>
					  <?php endif; if($auth_data=='all' || in_array('areafenhong',$auth_data)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">区域代理</label>
								<div class="layui-input-inline" style="width:350px;">
									<input type="radio" name="info[areafenhong]" value="0" title="关闭" <?php if($info['areafenhong']==0): ?>checked<?php endif; ?>>
									<?php if(getcustom('areafenhong_jiaquan') && ($auth_data=='all' || in_array('Largearea/*',$auth_data))): ?>
									<input type="radio" name="info[areafenhong]" value="10" title="大区" <?php if($info['areafenhong']==10): ?>checked<?php endif; ?>>
									<?php endif; ?>
									<input type="radio" name="info[areafenhong]" value="1" title="省级" <?php if($info['areafenhong']==1): ?>checked<?php endif; ?>>
									<input type="radio" name="info[areafenhong]" value="2" title="市级" <?php if($info['areafenhong']==2): ?>checked<?php endif; ?>>
									<input type="radio" name="info[areafenhong]" value="3" title="区县" <?php if($info['areafenhong']==3): ?>checked<?php endif; ?>>
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红比例(%)</div>
									<input type="text" name="info[areafenhongbl]" class="layui-input" value="<?php echo (isset($info['areafenhongbl']) && ($info['areafenhongbl'] !== '')?$info['areafenhongbl']:0); ?>">
								</div>
								<?php if($maidan_fenhong_new==1): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>买单分红比例(%)</div>
									<input type="text" name="info[areafenhongbl_maidan]" class="layui-input" value="<?php echo (isset($info['areafenhongbl_maidan']) && ($info['areafenhongbl_maidan'] !== '')?$info['areafenhongbl_maidan']:0); ?>">
								</div>
								<?php endif; if(getcustom('fenhong_score_percent')): ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红<?php echo t('积分'); ?>比例(%)</div>
									<input type="text" name="info[areafenhong_score_percent]" class="layui-input" value="<?php echo (isset($info['areafenhong_score_percent']) && ($info['areafenhong_score_percent'] !== '')?$info['areafenhong_score_percent']:0); ?>">
								</div>
								<?php endif; ?>
								<div class="layui-input-inline layui-module-itemL">
									<div>人数限制</div>
									<input type="text" name="info[areafenhongmaxnum]" class="layui-input" value="<?php echo (isset($info['areafenhongmaxnum']) && ($info['areafenhongmaxnum'] !== '')?$info['areafenhongmaxnum']:0); ?>">
								</div>
								<?php if(getcustom('fenhong_removefenxiao')): ?>
								<div class="layui-form-mid">扣除分销<?php echo t('佣金'); ?></div>
								<div class="layui-input-inline" style="width: 70px;">
									<input type="checkbox" lay-skin="switch" lay-text="开启|关闭" name="info[areafenhong_removefenxiao]" value="1" <?php if($info['areafenhong_removefenxiao']==1): ?>checked<?php endif; ?> lay-skin="primary">
								</div>
								<?php endif; ?>
								<div class="layui-form-mid layui-word-aux layui-clear">开启区域代理后需要开启用户申请升级，用户填写申请资料时选择要申请的代理区域<br>设置分红比例后该等级的同一个代理区域的人平均分摊所有商城内该区域的订单的分红提成比例，人数限制表示每个区域最多可以有多少区域代理 0表示不限制</div>
							</div>
						<?php endif; if(getcustom('fenhong_jiaquan_area')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label"><?php echo t('区域代理加权分红'); ?></label>
								<div class="layui-input-inline layui-module-itemL">
									<div>平均分红比例(%)</div>
									<input type="text" name="info[fenhong_jiaquan_area_pjbl]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong_jiaquan_area_pjbl'] : 0; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>加权分红比例(%)</div>
									<input type="text" name="info[fenhong_jiaquan_area_jqbl]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong_jiaquan_area_jqbl'] : 0; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">
									设置平均分红比例后，区域代理分红会乘以此比例后再进行平均分配（每季度一发）
									<br/>
									设置加权分红比例后，区域代理分红会乘以此比例后再进行加权发放（每季度一发）
								</div>
							</div>
						<?php endif; if(getcustom('fenhong_area_zhitui_pingji')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label"><?php echo t('区域代理分红直推平级奖'); ?></label>
								<div class="layui-input-inline layui-module-itemL">
									<div>分红比例(%)</div>
									<input type="text" name="info[fenhong_area_zhitui_pingjibl]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong_area_zhitui_pingjibl'] : 0; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">设置后会发放直推区域代理收入的百分比奖励（每季度一发）</div>
							</div>
						<?php endif; if(getcustom('fenhong_jiaquan_gudong')): ?>
							<div class="layui-form-item">
								<label class="layui-form-label"><?php echo t('股东加权分红'); ?></label>
								<div class="layui-input-inline layui-module-itemL">
									<div>平均分红比例(%)</div>
									<input type="text" name="info[fenhong_jiaquan_gudong_pjbl]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong_jiaquan_gudong_pjbl'] : 0; ?>">
								</div>
								<div class="layui-input-inline layui-module-itemL">
									<div>加权分红比例(%)</div>
									<input type="text" name="info[fenhong_jiaquan_gudong_jqbl]" class="layui-input" value="<?php echo !empty($info['id']) ? $info['fenhong_jiaquan_gudong_jqbl'] : 0; ?>">
								</div>
								<div class="layui-form-mid layui-word-aux layui-clear">
									设置平均分红比例后，股东分红会乘以此比例后再进行平均分配（每季度一发）
									<br/>
									设置加权分红比例后，股东分红会乘以此比例后再进行加权发放（每季度一发）
								</div>
							</div>
						<?php endif; if(getcustom('member_gongxian')): if($member_gongxian_status): ?>
							<div class="layui-form-item">
								<label class="layui-form-label"><?php echo t('贡献'); ?>有效期</label>
							  <div class="layui-input-inline layui-module-itemR">
								  <input type="number" min="0" name="info[gongxian_days]" class="layui-input" value="<?php echo $info['gongxian_days']; ?>"><div>天</div>
							  </div>
							  <div class="layui-form-mid layui-word-aux" style="margin-left:10px;">如设置的有效期为30天，则30天后过期，此项设置优先级高于平台设置</div>
							</div>
						  <?php endif; ?>
						<?php endif; if(getcustom('teamfenhong_gouche')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label"><?php echo t('购车基金'); ?>条件</label>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>直推下一级前（个会员）</div>
								  <input type="text" name="info[gouche_down_num]" class="layui-input" value="<?php echo $info['gouche_down_num']; ?>">
							  </div>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>指定等级ID</div>
								  <input type="text" name="info[gouche_levelid]" class="layui-input" value="<?php echo $info['gouche_levelid']; ?>" placeholder="选填">
							  </div>
							  <div class="layui-input-inline layui-module-itemL">
								  <div>收入满(元)</div>
								  <input type="text" name="info[gouche_bonus_total]" class="layui-input" value="<?php echo $info['gouche_bonus_total']; ?>" placeholder="选填">
							  </div>
							  <div class="layui-form-mid layui-word-aux">满足该条件可拿<?php echo t('购车基金'); ?>奖励，达到条件后不再受修改参数影响</div>
						  </div>
						  <?php endif; if(getcustom('teamfenhong_lvyou')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label"><?php echo t('旅游基金'); ?>条件</label>
						  <div class="layui-input-inline layui-module-itemL">
								<div>直推下二级前（个会员）</div>
							  <input type="text" name="info[lvyou_down_num]" class="layui-input" value="<?php echo $info['lvyou_down_num']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
								<div>指定等级ID</div>
							  <input type="text" name="info[lvyou_levelid]" class="layui-input" value="<?php echo $info['lvyou_levelid']; ?>" placeholder="选填">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
								<div>收入满(元)</div>
							  <input type="text" name="info[lvyou_bonus_total]" class="layui-input" value="<?php echo $info['lvyou_bonus_total']; ?>" placeholder="选填">
						  </div>
						  <div class="layui-form-mid layui-word-aux">满足该条件可拿<?php echo t('旅游基金'); ?>奖励，达到条件后不再受修改参数影响</div>
					  </div>
					  <?php endif; if(getcustom('teamfenhong_shouyi')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label"><?php echo t('团队收益'); ?></label>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>分红级数</div>
							  <input type="text" name="info[team_shouyi_lv]" class="layui-input" value="<?php echo $info['team_shouyi_lv']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>分红比例(%)</div>
							  <input type="text" name="info[team_shouyi]" class="layui-input" value="<?php echo $info['team_shouyi']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>最低奖励金额(元)</div>
							  <input type="text" name="info[team_shouyi_min]" class="layui-input" value="<?php echo $info['team_shouyi_min']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>累计消费达到(元)</div>
							  <input type="text" name="info[team_shouyi_ordermoney]" class="layui-input" value="<?php echo $info['team_shouyi_ordermoney']; ?>">
						  </div>

						  <div class="layui-form-mid layui-word-aux layui-clear">
							  分红级数：不设置级数，一直向上发放到分红金额不足最低奖励金额为止，
							  <br/>分红比例：拿奖计算比例，
							  <br/>最低奖励金额：可发放的最小奖励金额，
							  <br/>累计消费：不满足累计消费的会员跳过不拿奖,0为不限制
							  <br/>举例说明 : A 推 B、B 推 C(C收益的 50%给 B,B 收益的 50%级给 A)，层层这样
							  C收入 100元，B拿50，A拿25，
						  </div>
					  </div>
					  <?php endif; if(getcustom('member_level_salary_bonus')): ?>
					<span style="color:#333">工资补贴</span><span style="font-size: 12px;color: #999;">(从上到下从小到大设置工资奖励)</span><hr/>
					<div class="layui-form-item">
						<?php if(is_array($salary) || $salary instanceof \think\Collection || $salary instanceof \think\Paginator): $i = 0; $__LIST__ = $salary;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
						  <div class="salary_bonus" style="width: 100%;padding:0 10px;background: #f8f8f8;display: flex;align-items: center;">
							  <div class="layui-form-mid">直推会员满</div>
							  <div class="layui-input-inline" style="width: 90px;">
								  <input type="text" name="salary[member_num][]" class="layui-input" value="<?php echo $item['member_num']; ?>">
							  </div>
							  <div class="layui-form-mid">部门业绩达到</div>
							  <div class="layui-input-inline" style="width: 90px;">
								  <input type="text" name="salary[yj_amount][]" class="layui-input" value="<?php echo $item['yj_amount']; ?>">
							  </div>
							  <div class="layui-form-mid">元，补贴薪资</div>
							  <div class="layui-input-inline" style="width: 90px;">
								  <input type="text" name="salary[bonus][]" class="layui-input" value="<?php echo $item['bonus']; ?>">
							  </div>
							  <div class="layui-form-mid">元，进入佣金账号</div>
							  <div class="layui-form-mid"><button class="layui-btn layui-btn-sm" onclick="addSalaryRow(this)">+</button><button class="layui-btn layui-btn-sm layui-btn-warm" onclick="delSalaryRow(this)">-</button></div>
						  </div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<?php endif; if(getcustom('fenhong_jiaquan_bylevel')): ?>
  					<span style="color:#333"><?php echo t('加权分红'); ?>设置</span><hr/>
					<div class="layui-form-item">
					  <label class="layui-form-label"><?php echo t('分红份数'); ?></label>
					  <div class="layui-input-inline">
						  <input type="text" name="info[fenhong_copies]" class="layui-input" value="<?php echo $info['fenhong_copies']; ?>" lay-verType="tips">
					  </div>
					  <div class="layui-form-mid layui-word-aux">份，升级到该等级，可获得的<?php echo t('分红份数'); ?></div>
					</div>
					<div class="layui-form-item">
					  <label class="layui-form-label">直推<?php echo t('分红份数'); ?></label>
					  <div class="layui-input-inline">
						  <input type="text" name="info[fenhong_zt_copies]" class="layui-input" value="<?php echo $info['fenhong_zt_copies']; ?>" lay-verType="tips">
					  </div>
					  <div class="layui-form-mid layui-word-aux">份，直推会员购买分红产品（含自购)，可拿到的<?php echo t('分红份数'); ?></div>
					</div>
					<?php if(getcustom('fenhong_jiaquan_copies')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">时间限制</label>
						  <div class="layui-input-inline">
							  <input type="text" name="info[fenhong_limit_stime]" id="fenhong_limit_stime" class="layui-input" value="<?php if($info['fenhong_limit_stime']): ?><?php echo date('Y-m-d H:i',!is_numeric($info['fenhong_limit_stime'])? strtotime($info['fenhong_limit_stime']) : $info['fenhong_limit_stime']); ?><?php endif; ?>">
						  </div>
						  <div class="layui-form-mid"> ~ </div>
						  <div class="layui-input-inline">
							  <input type="text" name="info[fenhong_limit_etime]" id="fenhong_limit_etime" class="layui-input" value="<?php if($info['fenhong_limit_etime']): ?><?php echo date('Y-m-d H:i',!is_numeric($info['fenhong_limit_etime'])? strtotime($info['fenhong_limit_etime']) : $info['fenhong_limit_etime']); ?><?php endif; ?>">
						  </div>
						  <div class="layui-form-mid layui-word-aux">该时间段下单的订单有效</div>
					  </div>
					  <div class="layui-form-item">
						  <label class="layui-form-label">分红金额上限</label>
						  <div class="layui-input-inline">
							  <input type="number" name="info[fenhong_jiaquan_maxmoney]" class="layui-input" value="<?php echo $info['fenhong_jiaquan_maxmoney']; ?>" lay-verType="tips">
						  </div>
						  <div class="layui-form-mid layui-word-aux">元，该等级，每个<?php echo t('会员'); ?>可获得的金额上限，"-1"表示不限制</div>
					  </div>
					<?php endif; ?>
				  <?php endif; if(getcustom('ciruikang_fenxiao')): ?>
  				<span style="color:#333">加权合作分红设置</span><hr/>
  				<div class="layui-form-item">
  					<label class="layui-form-label">加权合作分红</label>
	  					<div class="layui-input-inline layui-module-itemL">
							<div>直推人数满</div>
							<input type="text" name="info[fenhong_weight_ztnum]" class="layui-input" value="<?php echo $info['fenhong_weight_ztnum']; ?>" style="margin-right: 0;">
							<div>人</div>
						</div>
						<div class="layui-input-inline layui-module-itemL">
							<div>等级ID为</div>
							<input type="text" name="info[fenhong_weight_levelid]" class="layui-input" value="<?php echo $info['fenhong_weight_levelid']; ?>"style="margin-right: 0;">
							<div>的下级</div>
						</div>
						<div class="layui-input-inline layui-module-itemL">
							<div>当月业绩满</div>
							<input type="text" name="info[fenhong_weight_yeji]" class="layui-input" value="<?php echo $info['fenhong_weight_yeji']; ?>"style="margin-right: 0;">
							<div>万</div>
						</div>
						<div class="layui-input-inline layui-module-itemL">
							<div>享公司当月业绩</div>
							<input type="text" name="info[fenhong_weight_ratio]" class="layui-input" value="<?php echo $info['fenhong_weight_ratio']; ?>" style="margin-right: 0;">
							<div>%的加权合作分红</div>
						</div>
						<div class="layui-form-mid layui-word-aux layui-clear">直推X个等级ID为Y的下级且自身和团队当月业绩满N万，享公司当月业绩Z%的加权合作分红；<br>等级ID、当月业绩、享公司当月业绩三个参数缺一不起效果；<br>等级ID填写一个等级ID，不能多填；<br>统计当月商城商品全部已确认收货的订单金额，下月月初凌晨发放</div>
					</div>
				  <?php endif; if(getcustom('team_jiandian') && ($auth_data=='all' || in_array('team_jiandian',$auth_data))): ?>
				  <div class="layui-form-item">
					  <label class="layui-form-label">购物发放<?php echo t('团队见点奖'); ?></label>
					  <div class="layui-input-inline" style="width:200px;">
						  <input type="radio" name="info[team_jiandian_status]" value="0" title="关闭" <?php if($info['team_jiandian_status']==0): ?>checked<?php endif; ?>>
						  <input type="radio" name="info[team_jiandian_status]" value="1" title="开启" <?php if($info['team_jiandian_status']==1): ?>checked<?php endif; ?>>
					  </div>
					  <div class="layui-input-inline layui-module-itemL">
						  <div>发放人数</div>
						  <input type="text" name="info[team_jiandian_people]" class="layui-input" value="<?php echo (isset($info['team_jiandian_people']) && ($info['team_jiandian_people'] !== '')?$info['team_jiandian_people']:0); ?>">
					  </div>
					  <div class="layui-form-mid layui-word-aux layui-clear">开启后，该等级会员购物时按产品设置对上级发放<?php echo t('团队见点奖'); ?>；</div>
				  </div>
				  <?php endif; if(getcustom('team_fuchijin')): ?>
				  <div class="layui-form-item">
					  <label class="layui-form-label"><?php echo t('团队扶持金'); ?></label>
					  <div class="layui-input-inline layui-module-itemL">
						  <div>分红级数</div>
						  <input type="text" name="info[team_fuchijin_lv]" class="layui-input" value="<?php echo (isset($info['team_fuchijin_lv']) && ($info['team_fuchijin_lv'] !== '')?$info['team_fuchijin_lv']:0); ?>">
					  </div>
					  <div class="layui-input-inline layui-module-itemL">
						  <div>分红比例(%)</div>
						  <input type="text" name="info[team_fuchijin_bl]" class="layui-input" value="<?php echo (isset($info['team_fuchijin_bl']) && ($info['team_fuchijin_bl'] !== '')?$info['team_fuchijin_bl']:0); ?>">
					  </div>
					  <div class="layui-form-mid layui-word-aux layui-clear">
						  设置分红级数和分红比例后该等级的人可以拿到其下[分红级数]级所有<?php echo t('会员'); ?>的所有商城订单的金额的分红比例；
						  <br>有紧缩
						  <br>计算方式：找到设置的[分红级数]个人，平分[分红比例]*订单金额；
						  </br>
					  </div>
				  </div>
				  <?php endif; if(getcustom('level_business_shopbuyfenhong')): ?>
				  <div class="layui-form-item">
					  <label class="layui-form-label">店铺分红</label>
					  <div class="layui-input-inline layui-module-itemL">
						  <div>一级分红比例(%)</div>
						  <input type="text" name="info[business_shopbuy_fenhongbl]" class="layui-input" value="<?php echo (isset($info['business_shopbuy_fenhongbl']) && ($info['business_shopbuy_fenhongbl'] !== '')?$info['business_shopbuy_fenhongbl']:0); ?>">
					  </div>
					  <div class="layui-input-inline layui-module-itemL">
						  <div>二级分红比例(%)</div>
						  <input type="text" name="info[business_shopbuy_fenhongbl2]" class="layui-input" value="<?php echo (isset($info['business_shopbuy_fenhongbl2']) && ($info['business_shopbuy_fenhongbl2'] !== '')?$info['business_shopbuy_fenhongbl2']:0); ?>">
					  </div>
					  <div class="layui-form-mid layui-word-aux layui-clear">
					  	一级分红比例即推荐人等级比例，二级分红比例即推荐人上级分红比例；<br>
					  	设置比例大0立即生效，当商户商城商品购买确认收货、买单付款后，给商户推荐人及推荐人上级发放分红；<br>
					  	分红结算方式跟随[系统]-[系统设置]-[分红结算方式]
					  </div>
				  </div>
				  <?php endif; ?>
						<span style="color:#333">其他设置</span><hr/>
						<?php if($info['isdefault'] != 1): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">等级有效期</label>
							<div class="layui-input-inline">
								<input type="text" name="info[yxqdate]" class="layui-input" value="<?php echo $info['yxqdate']; ?>" lay-verType="tips">
							</div>
							<div class="layui-form-mid">天</div>
							<div class="layui-form-mid layui-word-aux">升级成为该等级后多少天自动变回默认等级，0表示长期</div>
						</div>
						<?php endif; if(getcustom('level_auto_up')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label"></label>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>降级后自动升级考核天数(天)</div>
							  <input type="text" name="info[up_level_days]" class="layui-input" value="<?php echo $info['up_level_days']; ?>">
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
							  <div>升级考核团队业绩</div>
							  <input type="text" name="info[up_level_teamyeji]" class="layui-input" value="<?php echo $info['up_level_teamyeji']; ?>">
						  </div>
						  <div class="layui-form-mid layui-word-aux layui-clear">
						  </div>
						  <div class="layui-form-mid layui-word-aux">降级后X天内团队业绩达到条件恢复等级</div>
					  </div>
					  <?php endif; if(getcustom('level_auto_down')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label"></label>
						  <div class="layui-input-inline layui-module-itemL">
								<div>降级考核推广人数(人)</div>
							  <input type="text" name="info[down_level_tjr]" class="layui-input" value="<?php echo $info['down_level_tjr']; ?>">
						  </div>
						  <div class="layui-input-inline" style="width: 100px;">
							  <select name="info[tjr_level_id]">
								  <?php foreach($all_level as $level): ?>
								  <option value="<?php echo $level['id']; ?>" <?php if($info['tjr_level_id']==$level['id']): ?>selected<?php endif; ?>><?php echo $level['name']; ?></option>
								  <?php endforeach; ?>
							  </select>
						  </div>
						  <div class="layui-input-inline layui-module-itemL">
								<div>降级考核团队业绩</div>
							  <input type="text" name="info[down_level_teamyeji]" class="layui-input" value="<?php echo $info['down_level_teamyeji']; ?>">
						  </div>
						  <div class="layui-form-mid layui-word-aux layui-clear">
						  </div>
					  </div>
					  <div class="layui-form-item">
						  <label class="layui-form-label">考核方式</label>
						  <div class="layui-input-inline" style="width:500px">
							  <input type="radio" name="info[check_type]" value="0" title="不考核" <?php if($info['check_type']==0 || $info['check_type']==''): ?>checked<?php endif; ?>>
							  <input type="radio" name="info[check_type]" value="1" title="一次性考核" <?php if($info['check_type']==1): ?>checked<?php endif; ?>>
							  <input type="radio" name="info[check_type]" value="2" title="长期考核" <?php if($info['check_type']==2): ?>checked<?php endif; ?>>
						  </div>
						  <div class="layui-form-mid layui-word-aux layui-clear">一次性考核为第一次考核通过后更改为长期有效，长期考核为每次考核通过后考核时间向后推移</div>
					  </div>
					  <?php endif; if(getcustom('member_level_down_commission')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label"></label>
						   <div class="layui-input-inline layui-module-itemL">
								<div>累计业绩达到</div>
							  <input type="text" name="info[down_level_totalcommission]" class="layui-input" value="<?php echo $info['down_level_totalcommission']; ?>">
						  </div>
						  <div class="layui-form-mid">元降为 </div>
						  <div class="layui-input-inline" style="width: 100px;">
							  <select name="info[down_level_id2]">
								  <?php foreach($all_level as $level): ?>
								  <option value="<?php echo $level['id']; ?>" <?php if($info['down_level_id2']==$level['id']): ?>selected<?php endif; ?>><?php echo $level['name']; ?></option>
								  <?php endforeach; ?>
							  </select>
						  </div>
					  </div>
					   <style>
						  .layui-form-select dl {z-index:1000}
					   </style>
					 	 <div class="layui-form-item">
						  <label class="layui-form-label">恢复条件</label>
						   <div class="layui-input-inline layui-module-itemL">
							   <div>购买商品ID</div>
							  <input type="text" name="info[recovery_level_proid]" class="layui-input" value="<?php echo $info['recovery_level_proid']; ?>">
						  </div>
						  <div class="layui-form-mid">降级后购买此商品ID后恢复等级,多个商品用,隔开 </div>
					  </div>
					  <?php endif; if(getcustom('next_level_set') || getcustom('level_auto_down')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">到期等级</label>
							<div class="layui-input-inline">
								<span id="next_level_name" style="line-height: 40px;background: #eb8025;padding: 3px 6px;color: #fff;"><?php echo (isset($info['next_level_name']) && ($info['next_level_name'] !== '')?$info['next_level_name']:"默认等级"); ?></span>
								<input type="hidden" id="next_level_id" name="info[next_level_id]" class="layui-input" value="<?php echo $info['next_level_id']; ?>">
							</div>
							<div class="layui-input-inline">
								<button class="layui-btn layui-btn-primary" onclick="showChooseLevel()">选择等级</button>
							</div>
							<div class="layui-form-mid layui-word-aux">该等级到期后，指定下个等级，如果不指定，即回到默认等级</div>
						</div>
						<script>
							var chooseLevelLayer;
							function showChooseLevel(){
								chooseLevelLayer = layer.open({type:2,title:'选择<?php echo t('等级'); ?>',content:"<?php echo url('MemberLevel/chooselevel'); ?>",area:['1000px','600px'],shadeClose:true});
							}
							function chooselevel(res,args){
								$('#next_level_name').html(res.name)
								$('#next_level_id').val(res.id)
							}
						</script>
						<?php endif; if($plug_businessqr): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">是否显示在商家</label>
							<div class="layui-input-inline" style="width:500px">
								<input type="radio" name="info[show_business]" value="0" title="否" <?php if($info['show_business']==0 || $info['show_business']==''): ?>checked<?php endif; ?>>
								<input type="radio" name="info[show_business]" value="1" title="是" <?php if($info['show_business']==1): ?>checked<?php endif; ?>>
							</div>
							<div class="layui-form-mid layui-word-aux layui-clear">关闭后商家编辑商品等不显示此等级</div>
						</div>
						<?php endif; if(getcustom('level_comwithdraw')): ?>
						<div class="layui-form-item">
							<label class="layui-form-label">佣金提现</label>
							<div class="layui-input-inline" style="width:500px">
								<input type="radio" name="info[comwithdraw]" value="1" title="开启" <?php if(!$info['id'] || $info['comwithdraw']==1): ?>checked<?php endif; ?>>
								<input type="radio" name="info[comwithdraw]" value="0" title="关闭" <?php if($info['id'] && $info['comwithdraw']==0): ?>checked<?php endif; ?>>
							</div>
						</div>
						<?php endif; if(getcustom('article_files')): ?>
						<div class="layui-form-item">
						  <label class="layui-form-label">是否可查看资源</label>
						  <div class="layui-input-inline" style="width:500px">
							  <input type="radio" name="info[is_look_resource]" value="1" title="开启" <?php if(!$info['id'] || $info['is_look_resource']==1): ?>checked<?php endif; ?>>
							  <input type="radio" name="info[is_look_resource]" value="0" title="关闭" <?php if($info['id'] && $info['is_look_resource']==0): ?>checked<?php endif; ?>>
						  </div>
						</div>
						<div class="layui-form-item">
						  <label class="layui-form-label">是否可下载素材</label>
						  <div class="layui-input-inline" style="width:500px">
							  <input type="radio" name="info[is_download_resource]" value="1" title="开启" <?php if(!$info['id'] || $info['is_download_resource']==1): ?>checked<?php endif; ?>>
							  <input type="radio" name="info[is_download_resource]" value="0" title="关闭" <?php if($info['id'] && $info['is_download_resource']==0): ?>checked<?php endif; ?>>
						  </div>
						</div>
						<?php endif; if(getcustom('member_recharge_yj')): ?>
		  			<div class="layui-form-item">
							<label class="layui-form-label">是否开启业绩</label>
							<div class="layui-input-inline">
								<input type="radio" name="info[open_yj]" value="1" title="是" <?php if($info['open_yj']==1): ?>checked<?php endif; ?> lay-filter="openyjset">
								<input type="radio" name="info[open_yj]" value="0" title="否" <?php if($info['open_yj']!=1): ?>checked<?php endif; ?> lay-filter="openyjset">
							</div>
							<div class="layui-form-mid layui-word-aux">只有充值可得业绩</div>
						</div>
						<div id="openyj" style="<?php if(!$info['open_yj']|$info['open_yj'] ==0): ?>display: none;<?php endif; ?>">
							<div class="layui-form-item">
								<label class="layui-form-label">充值业绩比例</label>
								<div class="layui-input-inline">
									<span style="color:#000">1：</span>
									<input type="text" name="info[recharge_yj_ratio]" class="layui-input" value="<?php echo !empty($info['recharge_yj_ratio']) ? $info['recharge_yj_ratio'] : 1; ?>" style="display:inline-block;width: 100px;">
								</div>
								<div class="layui-form-mid layui-word-aux">充值金额和获得业绩金额为1:1，即冲1元，得1元的业绩</div>
							</div>
						  <div class="layui-form-item">
							  <label class="layui-form-label">业绩提现比例：</label>
							  <div class="layui-input-inline" style="width:auto; overflow: hidden;">
								<div class="layui-tab">
								  <div class="layui-tab-content">
									  <div class="layui-tab-item layui-show give-coupon-shop">
									  	<table class="layui-table choose-yj-up" style="width:500px" id="choose-yj-up">
										  <thead>
											  <tr>
												  <th>金额</th>
												  <th>提现比例</th>
												  <th>操作</th>
											  </tr>
										  </thead>
										  <?php if($yjlist): foreach($yjlist as $k=>$item): ?>
											  <tr class="choose-tr-list">
												  <td>
												  	<input type="text" name="info[yj_datas][moneys][]" value="<?php echo $item['money']; ?>" class="layui-input" style="display:inline-block;width:80px"/> 元及之内
												  </td>
												  <td>
													  <input type="text" name="info[yj_datas][ratios][]" value="<?php echo $item['ratio']; ?>" class="layui-input" style="display:inline-block;width:80px"/> %
												  </td>
												  <td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delyj(this)">删除</button></td>
											  </tr>
											  <?php endforeach; ?>
										  <?php endif; ?>
										  <tr class="choose-tr-list" id="yj_after">
											  <td>
											  	<input type="text" name="info[yj_moneys_after]" value="<?php echo $info['yj_moneys_after']; ?>" class="layui-input" style="display:inline-block;width:80px"/> 元之外
											  </td>
											  <td>
												  <input type="text" name="info[yj_ratios_after]" value="<?php echo $info['yj_ratios_after']; ?>" class="layui-input" style="display:inline-block;width:80px"/> %
											  </td>
											  <td></td>
										  </tr>
										  <tr class="choose-tr-add">
											  <td colspan="5" align="center"><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="addyj()">添加</button></td>
										  </tr>
									  	</table>
											  <script>
												  function addyj(){
													  var tr = '<tr class="choose-tr-list">' +
															  '<td><input type="text" name="info[yj_datas][moneys][]" value="" class="layui-input" style="display:inline-block;width:80px"/> 元及之内</td>' +
															  '<td><input type="text" name="info[yj_datas][ratios][]" value="" class="layui-input" style="display:inline-block;width:80px"/> %</td>' +
															  '<td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary" onclick="delyj(this)">删除</button></td>' +
															  '</tr>';
													  $('.choose-yj-up').find('#yj_after').before(tr);
												  }
												  function delyj(obj){
													  $(obj).closest('.choose-tr-list').remove();
												  }
											  </script>
										  </div>
								  </div>
								</div>
							  </div>
						  </div>
						</div>
					<?php endif; if(getcustom('shop_zthx_backmoney')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label">订单自提核销返现</label>
							  <div class="layui-input-inline">
								  <input type="text" name="info[zthx_backmoney]" lay-verify="required" lay-verType="tips" class="layui-input" value="<?php echo (isset($info['zthx_backmoney']) && ($info['zthx_backmoney'] !== '')?$info['zthx_backmoney']: 0); ?>">
							  </div>
							  <div class="layui-form-mid">%</div>
							  <div class="layui-form-mid layui-word-aux" style="margin-left:10px;">自提核销的时候发放商品总金额（不含会员折扣等优惠）的百分比给买家到余额</div>
						  </div>
					  <?php endif; if(getcustom('score_transfer_sxf')): ?>
						  <div class="layui-form-item">
							  <label class="layui-form-label"><?php echo t('积分'); ?>转赠手续费比例</label>
							  <div class="layui-input-inline">
								  <input type="text" name="info[score_transfer_sxf_ratio]" lay-verify="required" lay-verType="tips" class="layui-input" value="<?php echo (isset($info['score_transfer_sxf_ratio']) && ($info['score_transfer_sxf_ratio'] !== '')?$info['score_transfer_sxf_ratio']: 0.00); ?>">
							  </div>
							  <div class="layui-form-mid">%</div>
							  <div class="layui-form-mid layui-word-aux" style="margin-left:10px;">积分转赠时支付的手续费比例</div>
						  </div>
					  <?php endif; ?>
						<div class="layui-form-item">
							<label class="layui-form-label">特权说明</label>
							<div class="layui-input-inline" style="width:500px">
								<script id="explain" name="info[explain]" type="text/plain" style="width:100%;height:400px"><?php echo $info['explain']; ?></script>
							</div>
						</div>
					  <?php if(getcustom('up_level_agree') || getcustom('up_level_agree2') || getcustom('up_level_agree3')): ?>
					  <div class="layui-form-item">
						  <label class="layui-form-label">是否开启升级协议</label>
						  <div class="layui-input-inline">
							  <input type="radio" name="info[is_agree]" value="1" title="是" <?php if($info['is_agree']==1): ?>checked<?php endif; ?> >
							  <input type="radio" name="info[is_agree]" value="0" title="否" <?php if($info['is_agree']!=1): ?>checked<?php endif; ?> >
						  </div>
						  <div class="layui-form-mid layui-word-aux"><?php echo $agree_desc; ?></div>
					  </div>
					  <div class="layui-form-item">
						  <label class="layui-form-label">升级协议</label>
						  <div class="layui-input-inline" style="width:500px">
							  <script id="agree_content" name="info[agree_content]" type="text/plain" style="width:100%;height:400px"><?php echo $info['agree_content']; ?></script>
						  </div>
					  </div>
					  <?php endif; ?>
						<div class="layui-form-item">
							<label class="layui-form-label"></label>
							<div class="layui-input-block">
								<button class="layui-btn" lay-submit lay-filter="formsubmit">提 交</button>
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
	var ueditor = UE.getEditor('explain',{imageScaleEnabled:false});
	<?php if(getcustom('up_level_agree') || getcustom('up_level_agree2') || getcustom('up_level_agree3')): ?>
	var ueditor2 = UE.getEditor('agree_content',{imageScaleEnabled:false});
	<?php endif; ?>

	layui.form.on('submit(formsubmit)', function(obj){
		var field = obj.field
		//return;
		field['info[explain]'] = ueditor.getContent();
		<?php if(getcustom('up_level_agree') || getcustom('up_level_agree2') || getcustom('up_level_agree3')): ?>
		field['info[agree_content]'] = ueditor2.getContent();
		<?php endif; ?>
		if(!field['info[up_getmembercard]']) field['info[up_getmembercard]'] = 0
		if(!field['info[team_showtel]']) field['info[team_showtel]'] = 0
		if(!field['info[team_givemoney]']) field['info[team_givemoney]'] = 0
		if(!field['info[team_givescore]']) field['info[team_givescore]'] = 0
		if(!field['info[team_levelup]']) field['info[team_levelup]'] = 0
		if(!field['info[teamfenhongonly]']) field['info[teamfenhongonly]'] = 0
		if(!field['info[level_teamfenhongonly]']) field['info[level_teamfenhongonly]'] = 0
		if(!field['info[teamfenhong_self]']) field['info[teamfenhong_self]'] = 0
		if(!field['info[product_teamfenhong_self]']) field['info[product_teamfenhong_self]'] = 0
		if(!field['info[teamfenhong_removemax]']) field['info[teamfenhong_removemax]'] = 0
		<?php if(getcustom('fenhong_removefenxiao')): ?>
		if(!field['info[teamfenhong_removefenxiao]']) field['info[teamfenhong_removefenxiao]'] = 0
		if(!field['info[gdfenhong_removefenxiao]']) field['info[gdfenhong_removefenxiao]'] = 0
		if(!field['info[areafenhong_removefenxiao]']) field['info[areafenhong_removefenxiao]'] = 0
		<?php endif; if(getcustom('teamfenhong_jiandan')): ?>
		if(!field['info[teamfenhong_jiandan_only]']) field['info[teamfenhong_jiandan_only]'] = 0
		if(!field['info[teamfenhong_jiandan_self]']) field['info[teamfenhong_jiandan_self]'] = 0
		<?php endif; if(getcustom('level_teamfenhong')): ?>
		if(!field['info[level_surpass]']) field['info[level_surpass]'] = 0
		<?php endif; if(getcustom('teamfenhong_yejitj')): ?>
		if(!field['info[teamfenhong_yeji_self]']) field['info[teamfenhong_yeji_self]'] = 0;
		if(!field['info[teamfenhong_yeji_yunfee]']) field['info[teamfenhong_yeji_yunfee]'] = 0;
		if(!field['info[teamfenhong_yeji_total]']) field['info[teamfenhong_yeji_total]'] = 0
		<?php endif; ?>
		var index = layer.load();
	  // console.log(obj)
	  //return;
		$.post("<?php echo url('save'); ?>",obj.field,function(data){
			layer.close(index);
			dialog(data.msg,data.status);
			if(data.status == 1){
				setTimeout(function(){
					parent.layer.closeAll();
					parent.tableIns.reload()
				},1000)
			}
		})
	})
	//自定义表单验证
	layui.form.verify({
		Ndouble:[
			/^[0-9]\d*$/
			,'只能输入整数哦'
		]
	});
	layui.form.on('select(changeCategory)', function(data){
		var default_cat_id = $("#default_cat_id").val();
		if(data.value == default_cat_id){
			$('#can_commission').show();
			$('.notDefaultShow').show();
		}else{
			$('#can_commission').hide();
			$('.notDefaultShow').hide();
		}
	})
	layui.form.on('radio(can_apply)', function(data){
		if(data.value == '1'){
			$('#can_applyset').show();
		}else{
			$('#can_applyset').hide();
		}
	})
	layui.form.on('radio(can_agent)', function(data){
		if(data.value != '0'){
			if(data.value=='1'){
				$('*[commission2]').hide();
				$('[commission3]').hide();
			}else if(data.value=='2'){
				$('*[commission2]').show();
				$('[commission3]').hide();
			}else if(data.value=='3'){
				$('*[commission2]').show();
				$('[commission3]').show();
			}
			$('#can_agentset').show();
		}else{
			$('#can_agentset').hide();
		}
		if(data.value==99){
			$('.canAgent99').show();
			$('.canAgentF').hide();
			$('.canAgentF-radio').attr('disabled','disabled');
			$('.canAgent99-radio').attr('disabled',false);
			layui.form.render('radio')
		}else{
			$('.canAgent99').hide();
			$('.canAgentF').show();
			$('.canAgentF-radio').attr('disabled',false);
			$('.canAgent99-radio').attr('disabled','disabled');
			layui.form.render('radio');
		}
	})

	layui.form.on('radio(can_up)', function(data){
		if(data.value == '1'){
			$('#can_upset').show();
		}else{
			$('#can_upset').hide();
		}
	})
	layui.form.on('radio(commissiontype)', function(data){
		if(data.value == '1'){
			$('.commissionunit').html('元');
		}else{
			$('.commissionunit').html('%');
		}
		if(data.value==2){
			$('#tichengBox2').show();
			$('#tichengBox1').hide();
		}else {
			$('#tichengBox1').show();
			$('#tichengBox2').hide();
		}
	})
		layui.form.on('radio(commissionpj)', function(data){
			if(data.value == '1'){
				$('.commissionpj').show();
			}else{
				$('.commissionpj').hide();
			}
		})
	layui.form.on('checkbox(team_levelup)', function(data){
		// console.log(data.elem.checked );
		if(data.elem.checked){
			$('.team_levelup_div').show();
		}else{
			$('.team_levelup_div').hide();
		}
	})

	layui.form.on('radio(openyjset)', function(data){
		if(data.value == '1'){
			$('#openyj').show();
		}else{
			$('#openyj').hide();
		}
	})

	layui.form.on('radio(commission_percent_to_parent_status)', function(data){
		if(data.value == '1'){
			$('#commission_percent_to_parent').show();
		}else{
			$('#commission_percent_to_parent').hide();
		}
	})
	layui.form.on('radio(commission_percent_to_parent_condition)', function(data){
		if(data.value == '1'){
			$('#commission_percent_to_parent_condition').show();
		}else{
			$('#commission_percent_to_parent_condition').hide();
		}
	})

	var dhdata = <?php echo $info['apply_formdata']; ?>;
	$(function(){
		for(var i=0;i<dhdata.length;i++){
			addelement(dhdata[i].key,dhdata[i].val1,dhdata[i].val2,dhdata[i].val3,dhdata[i].val4,dhdata[i].val6,dhdata[i].addmendian,dhdata[i].name)
		}
	});
	function toup(obj){
		var onthis=$(obj).parent().parent();
		var getUp=onthis.prev();
		if (getUp.length<=0)  {
			layer.msg("到顶了");
			return;
		}
		onthis.after(getUp);
	}
	function todown(obj){
		var onthis=$(obj).parent().parent();
		var getdown=onthis.next();
		if (getdown.length<=0){
			layer.msg("到底了");
			return;
		}
		getdown.after(onthis);
	}
	<?php if(getcustom('member_level_add_apply_mendian')): ?>
		var mendian = <?php echo $info['mendian']; ?>;
		function addmendian(){
			for(var i=0;i<mendian.length;i++){
				addelement(mendian[i].key,mendian[i].val1,mendian[i].val2,mendian[i].val3,mendian[i].val4,mendian[i].val6,1,mendian[i].name)
			}
		}
	<?php endif; ?>
	var ekey = 0;
	//添加元素
	function addelement(type,val1,val2,val3,val4,extVal6='',addmendian=0,mendianname=''){
		if(type=='input'){
			var name = '单行输入';
		}else if(type=='textarea'){
			var name = '多行输入';
		}else if(type=='radio'){
			var name = '单项选择';
		}else if(type=='checkbox'){
			var name = '多项选择';
		}else if(type=='selector'){
			var name = '普通选择';
		}else if(type=='time'){
			var name = '时间选择';
		}else if(type=='date'){
			var name = '日期选择';
		}else if(type=='region'){
			var name = '省市区选择';
		}else if(type=='switch'){
			var name = '开关选择';
		}else if(type=='upload'){
			var name = '上传图片';
		}else if(type=='zuobiao'){
			var name = '坐标选择';
		}else if(type=='region2'){
			var name = '省市区街道';
		}
		var addhtml = '';
		addhtml += '<tr>'
		<?php if(getcustom('member_level_add_apply_mendian')): ?>
			if(addmendian == 1){
				addhtml += '<input type="hidden" name="addmendian['+ekey+']" value="1"/>'
				addhtml += '<input type="hidden" name="mendian_name['+ekey+']" value="'+mendianname+'"/>'
			}
		<?php endif; ?>
		addhtml += '<td>'+name+'<input type="hidden" name="datatype['+ekey+']" value="'+type+'"/></td>'
		addhtml += '<td><input class="layui-input" type="text" style="width:120px" name="dataval1['+ekey+']" value="'+val1+'" placeholder="请输入字段名称"></td>'
		addhtml += '<td>'
		if(type=='input'){
			addhtml += '<input class="layui-input" type="text" style="width:150px" name="dataval2['+ekey+']" value="'+val2+'" placeholder="请输入提示信息">'
			<?php if(getcustom('member_up_binding_tel')): ?>
			var authhtml = '';
			addhtml += '<div style="display: inline-block"><p style="width: 85px;display: inline-block" class="input_fied"><select style="width:80px" name="dataval4['+ekey+']" lay-filter="selectItemChange"><option value="0">文本</option><option value="2" '+(val4==2?'selected="selected"':'')+'>手机号</option></select></p>';
			if(val4==2){
				 authhtml = '<input type="checkbox" name="dataval6['+ekey+']" value="1" lay-skin="switch" lay-text="开启验证码|关闭验证码" '+(extVal6==1?'checked':'')+'>'
			}
			addhtml += '<div  class="auth_tel">'+authhtml+'</div></div>';
			<?php endif; ?>
		}else if(type=='textarea'){
			addhtml += '<input class="layui-input" type="text" style="width:200px" name="dataval2['+ekey+']" value="'+val2+'" placeholder="请输入提示信息">'
		}else if(type=='radio' || type=='checkbox' || type=='selector'){
			if(val2){
				for(var i=0;i<val2.length;i++){
					addhtml += '<div><input class="layui-input" type="text" style="width:180px" name="dataval2['+ekey+'][]" value="'+val2[i]+'" placeholder="请输入选项名称">';
					if(i==0){
						addhtml += '<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addxuanxiang(this,'+ekey+')"><i class="fa fa-plus"></i></button></div>'
					}else{
						addhtml += '<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="$(this).parent().remove()"><i class="fa fa-minus"></i></button></div>'
					}
				}
			}else{
				addhtml += '<div><input class="layui-input" type="text" style="width:180px" name="dataval2['+ekey+'][]" value="" placeholder="请输入选项名称">';
				addhtml += '<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="addxuanxiang(this,'+ekey+')"><i class="fa fa-plus"></i></button></div>'
			}
		}else if(type == 'time'){

			addhtml += '<div><input class="layui-input" type="text" style="width:200px" name="dataval2['+ekey+'][0]" value="'+(val2[0]?val2[0]:'00:00')+'" placeholder=\'开始时间，格式为"hh:mm"\'>';
			addhtml += '<div><input class="layui-input" type="text" style="width:200px" name="dataval2['+ekey+'][1]" value="'+(val2[1]?val2[1]:'23:59')+'" placeholder=\'结束时间，格式为"hh:mm"\'>';
		}else if(type == 'date'){
			addhtml += '<div><input class="layui-input" type="text" style="width:200px" name="dataval2['+ekey+'][0]" value="'+(val2[0]?val2[0]:'1970-01-01')+'" placeholder=\'开始日期，格式为"YYYY-MM-DD"\'>';
			addhtml += '<div><input class="layui-input" type="text" style="width:200px" name="dataval2['+ekey+'][1]" value="'+(val2[1]?val2[1]:'2080-01-01')+'" placeholder=\'结束日期，格式为"YYYY-MM-DD"\'>';
		}else if(type == 'region'){
			addhtml += '选择省市区';
		}else if(type == 'switch'){
			addhtml += '开启和关闭';
		}else if(type == 'upload'){
			addhtml += '<input class="layui-input" type="text" style="width:200px" name="dataval2['+ekey+']" value="'+val2+'" placeholder="请输入提示信息">'
		}else if(type == 'zuobiao'){
			addhtml += '选择位置';
		}else if(type == 'region2'){
			addhtml += '选择省市区街道';
		}
		addhtml += '</td>'
		//addhtml += '<td><select style="width:60px" name="dataval3['+ekey+']"><option value="1">是</option><option value="0" '+(val3==0?'selected="selected"':'')+'>否</option></select></td>'
		addhtml += '<td><input type="checkbox" name="dataval3['+ekey+']" value="1" lay-skin="switch" lay-text="开启|关闭" '+(val3==1?'checked':'')+'></td>'
		addhtml += '<td>'
		addhtml += '	<button title="删除" type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>'
		addhtml += '	<button title="上移" type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="toup(this)"><i class="fa fa-arrow-up"></i></button>'
		addhtml += '	<button title="下移" type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="todown(this)"><i class="fa fa-arrow-down"></i></button>'
		addhtml += '</td>'
		addhtml += '</tr>'
		// console.log(addhtml)
		$('#datatable').append(addhtml);
		layui.form.render('checkbox');
		layui.form.render('select');
		ekey++;
	}
	layui.form.on('select(selectItemChange)',function (data) {
		console.log(data);
		var authhtml = '';
		if(data.value==2){
			<?php if(getcustom('member_up_binding_tel')): ?>
				var authhtml = '<input type="checkbox" name="dataval6['+ekey+']" value="1" lay-skin="switch" lay-text="开启验证码|关闭验证码" >'
			<?php endif; ?>
		}
		$(data.elem).closest('div').find('.auth_tel').html(authhtml)
		layui.form.render('checkbox');
	})
	//添加选项
	function addxuanxiang(obj,ekey){
		$(obj).parent().parent().append('<div><input class="layui-input" type="text" style="width:180px" name="dataval2['+ekey+'][]" value="" placeholder="请输入选项名称"><button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="$(this).parent().remove()"><i class="fa fa-minus"></i></button></div>');
	}
	//开关 radio联动下方div显示隐藏
	layui.form.on('radio(diandaSwitchNew)', function(data){
		// console.log(data.elem.name);
		if(data.value == '0'){
			$("div[diandaSwitchNew='"+data.elem.name+"']").show();
		}else{
			$("div[diandaSwitchNew='"+data.elem.name+"']").hide();
		}
	})
<?php if(getcustom('member_level_salary_bonus')): ?>
	function addSalaryRow(obj){
		var html  = `<div class="salary_bonus"
			 style="width: 100%;padding:0 10px;background: #f8f8f8;display: flex;align-items: center;">
			<div class="layui-form-mid">直推会员满</div>
			<div class="layui-input-inline" style="width: 90px;">
				<input type="text" name="salary[member_num][]" class="layui-input" value="" >
			</div>
			<div class="layui-form-mid">部门业绩达到</div>
			<div class="layui-input-inline" style="width: 90px;">
				<input type="text" name="salary[yj_amount][]" class="layui-input" value="">
			</div>
			<div class="layui-form-mid">元，补贴薪资</div>
			<div class="layui-input-inline" style="width: 90px;">
				<input type="text" name="salary[bonus][]" class="layui-input" value="">
			</div>
			<div class="layui-form-mid">元，进入佣金账号</div>
			<div class="layui-form-mid">
				<button class="layui-btn layui-btn-sm" onClick="addSalaryRow(this)">+</button>
				<button class="layui-btn layui-btn-sm layui-btn-warm" onClick="delSalaryRow(this)">-
				</button>
			</div>
		</div>`;
		$(obj).closest('.layui-form-item').append(html)
	}
	function delSalaryRow(obj){
		var len = $(obj).closest('.layui-form-item').find('.salary_bonus').length;
		if(len==1){
			layer.msg('主人，留我一个吧~');
			return;
		}
		$(obj).closest('.salary_bonus').remove()
	}
<?php endif; if(getcustom('fenhong_jiaquan_copies')): ?>
	layui.laydate.render({
		elem: '#fenhong_limit_stime',
		trigger: 'click',
		type:'datetime',
		format:'yyyy-MM-dd HH:mm'
	});
	layui.laydate.render({
		elem: '#fenhong_limit_etime',
		trigger: 'click',
		type:'datetime',
		format:'yyyy-MM-dd HH:mm'
	});
	<?php endif; if(getcustom('teamfenhong_yejitj')): ?>
		layui.form.on('checkbox(teamfenhong_yeji_total)', function(data){
			if(data.elem.checked){
				$("#teamfenhong_yeji_month_set").show();
			}else{
				$("#teamfenhong_yeji_month_set").hide();
			}
		})
	<?php endif; if(getcustom('member_level_price_show')): ?>
		layui.form.on('radio(price_show)', function(data){
			if(data.value == '1'){
				$('#priceshowtextset').show();
			}else{
				$('#priceshowtextset').hide();
			}
		})
	<?php endif; if(getcustom('business_agent_jt_jinsuo')): ?>
		layui.form.on('switch(jt_jinsuo)', function(data){
			if(data.elem.checked){
				$('#pjjinsuo').show();
			}else{
				$('#pjjinsuo').hide();
			}
		})
	<?php endif; ?>
	layui.form.on('radio(apply_payfenxiao)', function(data){
		if(data.value == '2'){
			$('#paymoney_commissionset').show();
		}else{
			$('#paymoney_commissionset').hide();
		}
	})
  </script>
	
</body>
</html>