<?php
/**
 * 点大商城（www.diandashop.com） - 微信公众号小程序商城系统!
 * Copyright © 2020 山东点大网络科技有限公司 保留所有权利
 * =========================================================
 * 版本：V2
 * 授权主体：乐扬科技有限公司
 * 授权域名：266.xfdianda.com
 * 授权码：OStjSGnXAQjzHsXwkXnCRSZcd
 * ----------------------------------------------
 * 您只能在商业授权范围内使用，不可二次转售、分发、分享、传播
 * 任何企业和个人不得对代码以任何目的任何形式的再发布
 * =========================================================
 */

// +----------------------------------------------------------------------
// | 公众号支付设置
// +----------------------------------------------------------------------
namespace app\controller;
use think\facade\View;
use think\facade\Db;

class Wxpay extends Common
{
    public function initialize(){
		parent::initialize();
		if(bid > 0) showmsg('无访问权限');
	}
	//公众号支付设置
    public function set(){
		if(request()->isPost()){
			$info = input('post.info/a');
			$rs = Db::name('admin_setapp_wx')->where('aid',aid)->find();
			$info['wxpay_mchid'] = trim($info['wxpay_mchid']);
			$info['wxpay_mchkey'] = trim($info['wxpay_mchkey']);
			$info['wxpay_sub_mchid'] = trim($info['wxpay_sub_mchid']);
			$info['wxpay_apiclient_cert'] = str_replace(PRE_URL.'/','',$info['wxpay_apiclient_cert']);
			$info['wxpay_apiclient_key'] = str_replace(PRE_URL.'/','',$info['wxpay_apiclient_key']);
            $info['wxpay_wechatpay_pem'] = str_replace(PRE_URL.'/','',$info['wxpay_wechatpay_pem']);
			if(!empty($info['wxpay_apiclient_cert']) && substr($info['wxpay_apiclient_cert'], -4) != '.pem'){
				return json(['status'=>0,'msg'=>'PEM证书格式错误']);
			}
			if(!empty($info['wxpay_apiclient_key']) && substr($info['wxpay_apiclient_key'], -4) != '.pem'){
				return json(['status'=>0,'msg'=>'证书密钥格式错误']);
			}
            if(!empty($info['wxpay_wechatpay_pem']) && substr($info['wxpay_wechatpay_pem'], -4) != '.pem'){
                return json(['status'=>0,'msg'=>'平台证书格式错误']);
            }
            //支付公钥
            $info['sign_type'] = $info['sign_type'];
            $info['public_key_id'] = trim($info['public_key_id']);
            $info['public_key_pem'] = str_replace(PRE_URL.'/','',$info['public_key_pem']);

			$info['sxpay_mno'] = trim($info['sxpay_mno']);
            $info['transfer_scene_id'] = trim($info['transfer_scene_id']);
            $info['transfer_scene_type'] = trim($info['transfer_scene_type']);
            $info['transfer_scene_content'] = trim($info['transfer_scene_content']);
			Db::name('admin_setapp_wx')->where('aid',aid)->update($info);
			\app\common\System::plog('微信小程序支付设置');
			return json(['status'=>1,'msg'=>'设置成功','url'=>true]);
		}
		$info = Db::name('admin_setapp_wx')->where('aid',aid)->find();
		if(!$info) Db::name('admin_setapp_wx')->insert(['aid'=>aid]);
		View::assign('info',$info);
        //随行付进件状态
        $incomeStatus = \app\custom\Sxpay::getIncomeStatus(aid);
        View::assign('incomeStatus',$incomeStatus);
		return View::fetch();
	}
}