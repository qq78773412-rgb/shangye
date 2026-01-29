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

// custom_file(extend_qrcode)
namespace app\controller;
use think\facade\Db;
class ApiQrcode extends ApiCommon
{   
    public function initialize(){
        parent::initialize();
        if(!getcustom('extend_qrcode')  || bid>0) showmsg('无访问权限');
    }
    public function index(){
        if(request()->isPost()){

            $code = input('code')?trim(input('code')):'';
            if(!$code){
                return $this->json(['status'=>0,'msg'=>'无码']);
            }
            //查询二维码
            $list = Db::name('qrcode_list')->where('code',$code)->where('aid',aid)->find();
            if(!$list){
                return $this->json(['status'=>0,'msg'=>'二维码不存']);
            }

            //查询二维码设置
            $qrcode = Db::name('qrcode')->where('id',$list['qid'])->where('status',1)->where('aid',aid)->find();
            if(!$qrcode){
                return $this->json(['status'=>0,'msg'=>'活码不存']);
            }

            $pid  = $list['pid'];//上级id
            //查询是否绑定分销商且开启绑定分销商
            if(!$list['pid'] && $list['bindstatus'] == 1){
                //如果未登录，则需要去登录
                if(!$this->member || !mid){
                    return $this->json(['status'=>2,'qrcode'=>$code,'msg'=>'请先登录']);
                }else{
                    //如果已登录,查询用户是否有分销权限
                    $can_agent = Db::name('member')
                        ->alias('m')
                        ->join('member_level ml','ml.id=m.levelid')
                        ->where('m.id',mid)
                        ->where('ml.can_agent','>',0)
                        ->field('m.id')
                        ->count('m.id');
                    if($can_agent){
                        //更新使用状态
                        $uplist = Db::name('qrcode_list')->where('id',$list['id'])->update(['pid'=>mid,'bindtime'=>time()]);
                        $pid  = mid;//上级id
                    }
                }
            }

            //跳转链接
            $formurl = $pid?$qrcode['formurl'].'?pid='.$pid:$qrcode['formurl'];
            return $this->json(['status'=>1,'pid'=>$pid,'formurl'=>$formurl,'msg'=>'成功']);
        }
    }
}