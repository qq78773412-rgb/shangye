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
// +----------------------------------------------------------------------
// | 买单业务员收款码
// +----------------------------------------------------------------------
namespace app\controller;
use think\facade\View;
use think\facade\Db;

class MaidanQrcode extends Common
{

    //分组列表
    public function index(){
        if(request()->isAjax()){
            $page = input('param.page');
            $limit = input('param.limit');
            if(input('param.field') && input('param.order')){
                $order = input('param.field').' '.input('param.order');
            }else{
                $order = 'id desc';
            }
            $where = array();
            $where[] = ['aid','=',aid];
            $where[] = ['bid','=',bid];
            if(input('param.mid')) $where[] = ['mid','=',input('param.mid')];
            if(input('?param.status') && input('param.status')!=='') $where[] = ['status','=',input('param.status')];
            $count = 0 + Db::name('maidan_qrcode')->where($where)->count();
            $data = Db::name('maidan_qrcode')->where($where)->page($page,$limit)->order($order)->select()->toArray();
            if($data){
                foreach($data as &$v){
                    $v['member_infor'] = 'ID:'.$v['mid'];
                    //查询会员信息
                    $member = Db::name('member')->where('id',$v['mid'])->field('nickname,headimg')->find();
                    if($member){
                        $v['member_infor'] .= "<br>昵称:".$member['nickname'];
                        $v['member_infor'] .= "<br><img src='".$member['headimg']."' style='width:50px;height:50px' />";
                    }
                }
                unset($v);
            }
            return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$data]);
        }
        View::assign('bid',bid);
        return View::fetch();
    }
    //编辑
    public function edit(){
        if(input('param.id')){
            $info = Db::name('maidan_qrcode')->where('aid',aid)->where('id',input('param.id/d'))->find();
        }else{
            $info = ['id'=>'','bid'=>bid];
        }
        View::assign('info',$info);
        return View::fetch();
    }
    //保存
    public function save(){
        $info = input('post.info/a');

        if(!$info['mid']){
            return json(['status'=>0,'msg'=>'请填写'.t('会员').'ID']);
        }
        //查询会员
        $count_member = Db::name('member')->where('id',$info['mid'])->where('aid',aid)->count();
        if(!$count_member){
            return json(['status'=>0,'msg'=>'该'.t('会员').'不存在']);
        }

        //查询此会员是否已添加二维码
        $maidan_qrcode = Db::name('maidan_qrcode')->where('mid',$info['mid'])->where('bid',bid)->where('aid',aid)->field('id')->find();
        if($maidan_qrcode){
            if($info['id']){
                if($info['id'] != $maidan_qrcode['id']){
                    return json(['status'=>0,'msg'=>'该'.t('会员').'已添加过']);
                }
            }else{
                return json(['status'=>0,'msg'=>'该'.t('会员').'已添加过']);
            }
        }

        if($info['id']){
            $info['updatetime'] = time();
            Db::name('maidan_qrcode')->where('id',$info['id'])->where('aid',aid)->update($info);
            \app\common\System::plog('编辑买单收款码'.$info['id']);
        }else{
            $info['aid'] = aid;
            $info['bid'] = bid;
            $info['createtime'] = time();
            $id = Db::name('maidan_qrcode')->insertGetId($info);
            \app\common\System::plog('添加买单收款码'.$id);
        }
        return json(['status'=>1,'msg'=>'操作成功','url'=>(string)url('index')]);
    }
    //删除
    public function del(){
        $ids = input('post.ids/a');
        Db::name('maidan_qrcode')->where('bid',bid)->where('aid',aid)->where('id','in',$ids)->delete();
        \app\common\System::plog('买单收款码删除'.implode(',',$ids));
        return json(['status'=>1,'msg'=>'删除成功']);
    }
    //创建h5二维码
    public function createqrcode(){
        if(request()->isPost()){
            $mid = input('param.mid');
            //查询会员
            $count_member = Db::name('member')->where('id',$mid)->where('aid',aid)->count();
            if(!$count_member){
                return json(['status'=>0,'msg'=>'该'.t('会员').'不存在']);
            }

            $code_url = input('param.code_url');
            if(!$code_url){
                return json(['status'=>0,'msg'=>'二维码地址不能为空']);
            }
            //查询logo
            $logo = '';
            if(bid == 0){
                $admin_set = Db::name('admin_set')->where('aid',aid)->field('logo')->find();
                if($admin_set && $admin_set['logo']){
                    $logo = $admin_set['logo'];
                }
            }else{
                $business = Db::name('business')->where('id',bid)->where('aid',aid)->field('logo')->find();
                if($business && $business['logo']){
                    $logo = $business['logo'];
                }
            }
            if($logo){
                //查询logo是否是本地储藏,实则取本地地址
                $bd_http = $_SERVER['HTTP_HOST'];
                $pos = strpos($logo,$bd_http);
                if($pos >0 || $pos ===0){
                    //查询upload的位置
                    $upload_pos = strpos($logo,'upload');
                    if($upload_pos >0 || $upload_pos ===0){
                        //截取后方路径
                        $sub_logo = substr($logo,$upload_pos);
                        $logo = ROOT_PATH.$sub_logo;

                    }else{
                        $logo = '';
                    }
                }else{
                    $logo = '';
                }
            }

            //生成二维码
            $qrcode = createqrcode($code_url,$logo,aid,'',50);
            return json(['status'=>1,'msg'=>'生成成功','qrcode'=>$qrcode]);
        }
    }
}