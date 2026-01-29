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

//custom_file(maidan_qrcode)
namespace app\custom;

use think\facade\Db;
use think\facade\Log;

class MaidanQrcode
{
    //处理买单业务员分成
    public static function deal_ycommission($order='',$member='')
    {
        //处理推荐关系
        if($order['ymid'] && $order['ymid']!=$member['id'] && $order['ymid']!=$member['pid']){
            $upuser = Db::name('member')->where('id',$order['ymid'])->find();
            if($upuser){
                $uplv = Db::name('member_level')->where('id',$upuser['levelid'])->where('aid',$order['aid'])->find();
                if($uplv && $uplv['can_agent']!=0){
                    if($uplv['agent_rule']==2){
                        //不绑定推荐关系：即使该会员有推荐人，当被另一个人推荐时，TA的推荐人就会变成后来推荐TA的人。
                        $rs = \app\model\Member::edit($order['aid'],['id'=>$member['id'],'pid'=>$order['ymid']]);
                        if($rs['status'] == 1){
                            \app\common\Common::user_tjscore($order['aid'],$member['id']);
                            $member['pid'] = $order['ymid'];
                        }
                    }else{
                        if(!$member['pid']){
                            $rs = \app\model\Member::edit($order['aid'],['id'=>$member['id'],'pid'=>$order['ymid']]);
                            if($rs['status'] == 1){
                                \app\common\Common::user_tjscore($order['aid'],$member['id']);
                                $member['pid'] = $order['ymid'];
                            }
                        }
                    }
                }
            }
        }

        //发直推人扫码分成 （买单上级与业务员是同一个人）
        if($member['pid'] == $order['ymid']){
            //查询买单上级是否是业务员
            if($member['pid']>0){

                $ymember = Db::name('member')->where('id',$member['pid'])->where('aid',$order['aid'])->field('id,levelid')->find();
                if($ymember){

                    //查询此业务员状态
                    $count_yw = Db::name('maidan_qrcode')->where('mid',$member['pid'])->where('aid',$order['aid'])->where('bid',$order['bid'])->where('status',1)->count();
                    if($count_yw){

                        //查询买单权限
                        $ylevel = Db::name('member_level')->where('id',$ymember['levelid'])->where('can_agent','>',0)->where('aid',$order['aid'])->field('maidan_zt_ratio')->find();
                        if($ylevel && $ylevel['maidan_zt_ratio'] >0){

                            //发直推人扫码分成
                            $send_commission = $order['paymoney']*$ylevel['maidan_zt_ratio']/100;
                            $send_commission = round($send_commission,2);
                            if($send_commission>0){
                                \app\common\Member::addcommission($order['aid'],$member['pid'],$order['mid'],$send_commission,'买单直推人扫码分成');
                            }

                        }
                    }
                }
            }

        //发直推人间接消费分成 和 非直推人收款分成
        }else{

            //直推人间接消费分成
            if($member['pid']>0){
                //查询用户上级是否是业务员
                $ymember = Db::name('member')->where('id',$member['pid'])->where('aid',$order['aid'])->field('id,levelid')->find();
                if($ymember){

                    //查询此业务员状态
                    $count_yw = Db::name('maidan_qrcode')->where('mid',$member['pid'])->where('aid',$order['aid'])->where('bid',$order['bid'])->where('status',1)->count();
                    if($count_yw){

                        //查询买单权限
                        $ylevel = Db::name('member_level')->where('id',$ymember['levelid'])->where('can_agent','>',0)->where('aid',$order['aid'])->field('maidan_zt_payother_ratio')->find();
                        if($ylevel && $ylevel['maidan_zt_payother_ratio'] >0){

                            //发直推人间接消费分成
                            $send_commission = $order['paymoney']*$ylevel['maidan_zt_payother_ratio']/100;
                            $send_commission = round($send_commission,2);
                            if($send_commission>0){
                                \app\common\Member::addcommission($order['aid'],$member['pid'],$order['mid'],$send_commission,'买单直推人间接消费分成');
                            }

                        }
                    }
                }
            }

            //非直推人收款分成
            if($order['ymid']>0){
                //验证业务员是否存在
                $ymember = Db::name('member')->where('id',$order['ymid'])->where('aid',$order['aid'])->field('id,levelid')->find();
                if($ymember){
                    
                    //查询此业务员状态
                    $count_yw = Db::name('maidan_qrcode')->where('mid',$order['ymid'])->where('aid',$order['aid'])->where('bid',$order['bid'])->where('status',1)->count();
                    if($count_yw){

                        //查询买单权限
                        $ylevel = Db::name('member_level')->where('id',$ymember['levelid'])->where('can_agent','>',0)->where('aid',$order['aid'])->field('maidan_nzt_payself_ratio')->find();
                        if($ylevel && $ylevel['maidan_nzt_payself_ratio'] >0){

                            //发非直推人收款分成
                            $send_commission = $order['paymoney']*$ylevel['maidan_nzt_payself_ratio']/100;
                            $send_commission = round($send_commission,2);
                            if($send_commission>0){
                                \app\common\Member::addcommission($order['aid'],$order['ymid'],$order['mid'],$send_commission,'买单非直推人收款分成');
                            }

                        }
                    }
                }
            }

        }
    }
}
