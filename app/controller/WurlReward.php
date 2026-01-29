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

//custom_file(wurl_reward)
namespace app\controller;
use think\facade\View;
use think\facade\Db;

class WurlReward extends Common
{
    public function initialize(){
        parent::initialize();
        if(bid > 0) showmsg('无访问权限');
    }
    public function index(){
        if(request()->isAjax()){
            $page = input('param.page');
            $limit = input('param.limit');
            if(input('param.field') && input('param.order')){
                $order = 'member_wurl_rewardlog.'.input('param.field').' '.input('param.order');
            }else{
                $order = 'member_wurl_rewardlog.id desc';
            }
            $where = array();
            $where[] = ['member_wurl_rewardlog.aid','=',aid];
            if(input('param.ctime') ){
                $ctime = explode(' ~ ',input('param.ctime'));
                $where[] = ['member_wurl_rewardlog.createtime','>=',strtotime($ctime[0])];
                $where[] = ['member_wurl_rewardlog.createtime','<',strtotime($ctime[1]) + 86400];
            }
            
            if(input('param.nickname')) $where[] = ['member.nickname','like','%'.trim(input('param.nickname')).'%'];
            if(input('param.mid')) $where[] = ['member_wurl_rewardlog.mid','=',trim(input('param.mid'))];
            $count = 0 + Db::name('member_wurl_rewardlog')->alias('member_wurl_rewardlog')->field('member.nickname,member.headimg,member_wurl_rewardlog.*')->join('member member','member.id=member_wurl_rewardlog.mid')->where($where)->count();
            $data = Db::name('member_wurl_rewardlog')->alias('member_wurl_rewardlog')->field('member.nickname,member.headimg,member_wurl_rewardlog.*')->join('member member','member.id=member_wurl_rewardlog.mid')->where($where)->page($page,$limit)->order($order)->select()->toArray();
            return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$data]);
        }
        return View::fetch();
    }
    public function set(){
        if(request()->isPost()){
            $info = input('post.info/a');

            $rewardurls = input('post.urls/a');
            $info['rewardurls'] = $rewardurls?jsonEncode($rewardurls):'';

            $commissiondata = input('post.commissiondata/a');
            foreach($commissiondata as $cv){
                if($cv['money']<0){
                    return json(['status'=>0,'msg'=>'设置的'.t('余额').'数值必须大于等于0']);
                }
                if($cv['score']<0){
                    return json(['status'=>0,'msg'=>'设置的'.t('积分').'数值必须大于等于0']);
                }
                if($cv['commission']<0){
                    return json(['status'=>0,'msg'=>'设置的'.t('佣金').'数值必须大于等于0']);
                }
            }
            $info['commissiondata'] = jsonEncode($commissiondata);
            $info['updatetime'] = time();
            $up = Db::name('wurl_reward_set')->where('aid',aid)->update($info);
            if(!$up){
                return json(['status'=>0,'msg'=>'设置失败']);
            }
            \app\common\System::plog('外部链接奖励设置');
            return json(['status'=>1,'msg'=>'保存成功']);
        }else{
            $info = Db::name('wurl_reward_set')->where('aid',aid)->find();
            if(!$info){
                $data = [];
                $data['aid'] = aid;
                $data['createtime'] = time();
                $info['id'] = Db::name('wurl_reward_set')->insertGetId($data);
            }

            View::assign('info',$info);
            if($info['rewardurls']){
                $info['rewardurls'] = json_decode($info['rewardurls'],true);
            }
            View::assign('rewardurls',$info['rewardurls']);

            if($info['commissiondata']){
                $info['commissiondata'] = json_decode($info['commissiondata'],true);
            }
            View::assign('commissiondata',$info['commissiondata']);

            $default_cid = Db::name('member_level_category')->where('aid',aid)->where('isdefault', 1)->value('id');
            $default_cid = $default_cid ? $default_cid : 0;
            $levellist = Db::name('member_level')->where('aid',aid)->where('cid', $default_cid)->order('sort,id')->select()->toArray();
            View::assign('levellist',$levellist);
            return View::fetch();
        }
        
    }
}