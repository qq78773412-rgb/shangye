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

namespace app\custom;
use think\facade\Db;
class DesignerPageCustom
{   
    public static function deal_icback($aid){
        if(getcustom('yx_invite_cashback')) {
            $time = time();

            $data = [];
            //查询邀请返现设置是否有全部商品设置
            $icback_all = 0+Db::name('invite_cashback')->where('aid',$aid)->where('fwtype',0)->where('starttime','<=',$time)->where('endtime','>=',$time)->where('bid',0)->count();
            $data['icback_all'] = $icback_all?$icback_all:false;
            $data['cids']       = [];
            $data['proids']     = [];
            if(!$icback_all){
                $cids = [];
                //查询分类
                $cblist = Db::name('invite_cashback')->where('aid',$aid)->where('fwtype',1)->where('starttime','<=',$time)->where('endtime','>=',$time)->where('bid',0)->field('id,categoryids')->select()->toArray();
                if($cblist){
                    foreach($cblist as $cv){
                        if($cv['categoryids']){
                            $categoryids = explode(',',$cv['categoryids']);

                            $clist = Db::name('shop_category')->where('pid','in',$categoryids)->select()->toArray();
                            if($clist){
                                    foreach($clist as $vc){
                                    $categoryids[] = $vc['id'];
                                    $cate2 = Db::name('shop_category')->where('pid',$vc['id'])->find();
                                    $categoryids[] = $cate2['id'];
                                }
                            }
                            $cids = array_merge($cids,$categoryids);
                        }
                    }
                    unset($cv);
                }
                $data['cids'] = $cids;

                $proids = [];
                //查询商品
                $prolist = Db::name('invite_cashback')->where('aid',$aid)->where('fwtype',2)->where('starttime','<=',$time)->where('endtime','>=',$time)->where('bid',0)->field('id,productids')->select()->toArray();
                if($prolist){
                    foreach($prolist as $pv){
                        if($pv['productids']){
                            $productids = explode(',',$pv['productids']);
                            $proids = array_merge($proids,$productids);
                        }
                    }
                    unset($pv);
                }
                $data['proids'] = $proids;
            }
            return $data;
        }
    }
}