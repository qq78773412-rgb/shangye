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

namespace app\model;
use think\facade\Db;
use think\facade\Log;
class ShopOrder
{
    //从自定义字段中 同步订单的备注
	static function checkOrderMessage($orderid,$orderinfo=[]){
	    if($orderinfo){
	        $orderid = $orderinfo['id'];
        }else if($orderid){
	        $orderinfo = Db::name('shop_order')->where('aid',aid)->where('id',$orderid)->find();
        }else{
	        return '';
        }
	    $message = $orderinfo['message'];
        if(empty($orderinfo['message'])){
            $formdata = Db::name('freight_formdata')->where('aid',aid)->where('orderid',$orderinfo['id'])->order('id desc')->where('type','shop_order')->find();
            if($formdata){
                for ($i=0;$i<=30;$i++){
                    $field = $formdata['form'.$i];
                    if(!$field){
                        continue;
                    }
                    $fieldArr = explode('^_^',$field);
                    if(!$fieldArr || $fieldArr[2]=='upload'){
                        continue;
                    }
                    if(strpos($fieldArr[0],'备注')!==false){
                        $message = $orderinfo['message'] = $fieldArr[1]??'';
                        break;
                    }
                }
                //更新到订单，下次不再查询
                if($message){
                    Db::name('shop_order')->where('aid',aid)->where('id',$orderid)->update(['message'=>$message]);
                }
            }
        }
        return empty($message)?'':$message;
    }

    //视力档案
    static function getGlassRecordRow($ordergoods = []){
	    return '';
    }

    static function checkReturnComponent($aid,$bid=0){
        $status = false;
        return $status;
    }

    //订单创建完成进入回调逻辑处理
    static function after_create($aid,$orderid){
        //订单创建完成，触发订单完成事件
        \app\common\Order::order_create_done($aid,$orderid,'shop');
        return true;
    }


}