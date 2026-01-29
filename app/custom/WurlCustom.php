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
namespace app\custom;
use think\facade\Db;
class WurlCustom
{   
    public static function reward($aid,$mid,$member,$tourl){
        if (getcustom('wurl_reward')) {
            $set = Db::name('wurl_reward_set')->where('aid',$aid)->find();
            if($set['status'] != 1){
                return;
            }
            if(empty($set['rewardurls'])){
                return;
            }
            $rewardurls = json_decode($set['rewardurls'],true);

            //处理外部链接
            $pre = '';
            $url = '';
            $pos = strpos($tourl,'url::');
            if($pos===0 || $pos>0){
                $pre = 'url';
                $url = substr($tourl,($pos+5));

                if(!in_array($url,$rewardurls)){
                    return;
                }
            }else{
                $pos2 = strpos($tourl,'https://');
                if($pos2===0 || $pos2>0){
                    $pre = 'https';
                    $url = substr($tourl,$pos2);

                    if(!in_array($tourl,$rewardurls)){
                        return;
                    }
                }else{
                    $pos3 = strpos($tourl,'http://');
                    if($pos3===0 || $pos3>0){
                        $pre = 'http';
                        $url = substr($tourl,$pos3);

                        if(!in_array($tourl,$rewardurls)){
                            return;
                        }
                    }
                }
            }

            if(!empty($pre) && !empty($url)){

                //点击发放
                $money   = 0;$score  = 0;$commission  = 0;
                //每日上限
                $money2  = 0;$score2 = 0;$commission2 = 0;
                //最大上限
                $money3  = 0;$score3 = 0;$commission3 = 0;
                //查询会员外部链接奖励设置
                if($member['wurl_reward_set'] == 1){
                    $money  = $member['wr_money'] ;$score  = $member['wr_score'] ;$commission  = $member['wr_commission'];
                    $money2 = $member['wr_money2'];$score2 = $member['wr_score2'];$commission2 = $member['wr_commission2'];
                    $money3 = $member['wr_money3'];$score3 = $member['wr_score3'];$commission3 = $member['wr_commission3'];
                }else{
                    
                    if($set['commissiondata']){
                        $commissiondata = json_decode($set['commissiondata'],true);
                        foreach($commissiondata as $ck=>$cv){
                            if($ck==$member['levelid']){
                                $money  = $cv['money'] ;$score  = $cv['score'] ;$commission  = $cv['commission'];
                                $money2 = $cv['money2'];$score2 = $cv['score2'];$commission2 = $cv['commission2'];
                                $money3 = $cv['money3'];$score3 = $cv['score3'];$commission3 = $cv['commission3'];
                            }
                        }
                    }
                }

                if($money>0 || $score>0 || $commission>0){
                    //统计他今日发放
                    $starttime = strtotime(date("Y-m-d",time()));
                    $endtime   = strtotime(' +1 day',$starttime);
                    $todaymoney = 0+Db::name('member_wurl_rewardlog')->where('mid',$mid)->where('createtime','>=',$starttime)->where('createtime','<',$endtime)->where('aid',$aid)->sum('money');
                    $todayscore = 0+Db::name('member_wurl_rewardlog')->where('mid',$mid)->where('createtime','>=',$starttime)->where('createtime','<',$endtime)->where('aid',$aid)->sum('score');
                    $todaycommission = 0+Db::name('member_wurl_rewardlog')->where('mid',$mid)->where('createtime','>=',$starttime)->where('createtime','<',$endtime)->where('aid',$aid)->sum('commission');
                    if($todaymoney>=$money2){
                        $money = 0;
                    }
                    if($todayscore>=$score2){
                        $score = 0;
                    }
                    if($todaycommission>=$commission2){
                        $commission = 0;
                    }

                    //统计他的总发放
                    $allmoney = 0+Db::name('member_wurl_rewardlog')->where('mid',$mid)->where('aid',$aid)->sum('money');
                    $allscore = 0+Db::name('member_wurl_rewardlog')->where('mid',$mid)->where('aid',$aid)->sum('score');
                    $allcommission = 0+Db::name('member_wurl_rewardlog')->where('mid',$mid)->where('aid',$aid)->sum('commission');
                    if($allmoney>=$money3){
                        $money = 0;
                    }
                    if($allscore>=$score3){
                        $score = 0;
                    }
                    if($allcommission>=$commission3){
                        $commission = 0;
                    }
                    if($money>0 || $score>0 || $commission>0){
                        $money = $money>0?$money:0;
                        $score = $score>0?$score:0;
                        $commission = $commission>0?$commission:0;
                        $data = [];
                        $data['aid'] = $aid;
                        $data['mid'] = $mid;
                        $data['tourl'] = $tourl;
                        $data['pre']   = $pre;
                        $data['url']   = $url;
                        $data['money'] = $money;
                        $data['score'] = $score;
                        $data['commission'] = $commission;
                        $data['createtime'] = time();

                        Db::startTrans();
                        try{
                            $addmoney        = false;//增加余额
                            $addscore        = false;//增加积分
                            $addcommission   = false;//增加佣金

                            $insert = Db::name('member_wurl_rewardlog')->insert($data);
                            if($insert){
                                if($money>0){
                                    $addmoney = \app\common\Member::addmoney($aid,$mid,$money,'打开外部链接奖励');
                                    if($addmoney && $addmoney['status'] == 1){
                                        $addmoney = true;
                                    }
                                }else{
                                    $addmoney = true;
                                }

                                if($score>0){
                                    $addscore = \app\common\Member::addscore($aid,$mid,$score,'打开外部链接奖励');
                                    if($addscore && $addscore['status'] == 1){
                                        $addscore = true;
                                    }
                                }else{
                                    $addscore = true;
                                }

                                if($commission>0){
                                    $addcommission = \app\common\Member::addcommission($aid,$mid,0,$commission,'打开外部链接奖励');
                                    if($addcommission && $addcommission['status'] == 1){
                                        $addcommission = true;
                                    }
                                }else{
                                    $addcommission = true;
                                }
                            }
                        }catch(Exception $e){
                            Db::rollback();
                        }
                        if($insert && $addmoney && $addscore && $addcommission){
                            Db::commit();
                        }else{
                            Db::rollback();
                        }
                    }
                }
            }

        }
    }
}