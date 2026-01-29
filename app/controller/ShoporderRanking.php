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

//custom_file(shoporder_ranking)
// +----------------------------------------------------------------------
// | 消费排行榜管理
// +----------------------------------------------------------------------
namespace app\controller;
use think\facade\View;
use think\facade\Db;

class ShoporderRanking extends Common
{
    public function initialize(){
        parent::initialize();
        if(bid > 0) showmsg('无访问权限');
    }

    public function index(){
        \app\custom\AgentCustom::allshoporderranking(aid);//记录当前月份数据
        if(request()->isAjax()){
            $page = input('param.page');
            $limit = input('param.limit');
            if(input('param.field') && input('param.order')){
                $order = input('param.field').' '.input('param.order');
            }else{
                $order = 'month desc,id desc';
            }
            $where = array();
            $where[] = ['aid','=',aid];
            if(input('param.month') ){
                $month = explode(' ~ ',input('param.month'));
                $starttime = strtotime($month[0].'-01');
                $endtime   = strtotime($month[1].'-01');
                $where[] = ['month','>=',$starttime];
                $where[] = ['month','<=',$endtime];
            }
            if(input('?param.sendstatus') && input('param.sendstatus')!==''){
                $where[] = ['sendstatus','=',input('param.sendstatus')];
            }
            if(input('?param.issend') && input('param.issend')!==''){
                $where[] = ['issend','=',input('param.issend')];
            }
            $count = 0 + Db::name('shoporder_ranking_log')->where($where)->count();
            $data = Db::name('shoporder_ranking_log')->where($where)->page($page,$limit)->order($order)->select()->toArray();
            if($data){
                foreach($data as &$dv){
                    $dv['canchange'] = false;
                    $nowmonth = strtotime(date("Y-m"));
                    if($dv['month'] == $nowmonth){
                        $dv['canchange'] = true;
                    }
                    $dv['totalmoney'] = $dv['poolmoney']+$dv['changemoney'];
                }
                unset($dv);
            }
            return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$data]);
        }
        return View::fetch();
    }
    //导出
    public function excel(){
        if(input('param.field') && input('param.order')){
            $order = ''.input('param.field').' '.input('param.order');
        }else{
            $order = 'month desc,id desc';
        }
        $page = input('param.page')?:1;
        $limit = input('param.limit')?:10;
        $where = array();
        $where[] = ['aid','=',aid];
        if(input('param.month') ){
            $month = explode(' ~ ',input('param.month'));
            $starttime = strtotime($month[0].'-01');
            $endtime   = strtotime($month[1].'-01');
            $where[] = ['month','>=',$starttime];
            $where[] = ['month','<=',$endtime];
        }
        if(input('?param.sendstatus') && input('param.sendstatus')!==''){
            $where[] = ['sendstatus','=',input('param.sendstatus')];
        }
        if(input('?param.issend') && input('param.issend')!==''){
            $where[] = ['issend','=',input('param.issend')];
        }
        $list = Db::name('shoporder_ranking_log')->where($where)->order($order)->page($page,$limit)->select()->toArray();
        $count = Db::name('shoporder_ranking_log')->where($where)->count();
        $title = array();
        $title[] = '月份时间';
        $title[] = '分红池总金额';
        $title[] = '充值变动金额';
        $title[] = '实际分红池总金额';
        $title[] = '发放奖金状态';
        $title[] = '子分红池名称';
        $title[] = '参与该分红池差距消费金额';
        $title[] = t('会员').'ID:';
        $title[] = t('会员').'昵称';
        $title[] = t('会员').'手机号';
        $title[] = '消费金额';
        $title[] = '预估奖金';
        $title[] = '是否发放奖金';
        $data = [];
        if($list){
            foreach($list as $k=>$v){
                //查询详情
                $details = Db::name('shoporder_ranking_log_detail')->where('logid',$v['id'])->select()->toArray();
                if($details){
                    foreach($details as $dk=>$dv){
                        //查询中奖用
                        $mlist = $dv['mlist']?json_decode($dv['mlist'],true):'';
                        if($mlist){
                            foreach($mlist as $mk=>$mv){
                                $data3 = [];
                                if($dk == 0 && $mk == 0){
                                    $data3[] = date('Y-m',$v['month']);
                                    $data3[] = $v['poolmoney'];
                                    $data3[] = $v['changemoney'];
                                    $data3[] = $v['poolmoney']+$v['changemoney'];
                                    if($v['sendstatus'] == 1){
                                        $data3[] = '开启';
                                    }else{
                                        $data3[] = '关闭';
                                    }
                                    $data3[] = $dv['name'];
                                    $data3[] = $dv['money'];
                                }else{
                                    $data3[] = '';
                                    $data3[] = '';
                                    $data3[] = '';
                                    $data3[] = '';
                                    $data3[] = '';
                                    if($mk == 0){
                                        $data3[] = $dv['name'];
                                        $data3[] = $dv['money'];
                                    }else{
                                        $data3[] = '';
                                        $data3[] = '';
                                    }
                                }
                                $data3[] = $mv['mid'];
                                $data3[] = $mv['nickname'];
                                $data3[] = $mv['tel'];
                                $data3[] = $mv['summoney'];
                                $data3[] = $mv['avgmoney'];
                                $data3[] = $mv['issend'] && $mv['issend']>0?'已发放':'未发放';
                                $data[]  = $data3;
                            }
                        }else{
                            $data2 = [];
                            if($dk == 0){
                                $data2[] = date('Y-m-d',$v['month']);
                                $data2[] = $v['poolmoney'];
                                $data2[] = $v['changemoney'];
                                $data2[] = $v['poolmoney']+$v['changemoney'];
                                if($v['sendstatus'] == 1){
                                    $data2[] = '开启';
                                }else{
                                    $data2[] = '关闭';
                                }
                            }else{
                                $data2[] = '';
                                $data2[] = '';
                                $data2[] = '';
                                $data2[] = '';
                                $data2[] = '';
                            }
                            $data2[] = $dv['name'];
                            $data[]  = $data2;
                        }
                    }
                }else{
                    if($k == 0){
                        $data[] = date('Y-m-d',$v['month']);
                        $data[] = $v['poolmoney'];
                        $data[] = $v['changemoney'];
                        $data[] = $v['poolmoney']+$v['changemoney'];
                        if($v['sendstatus'] == 1){
                            $data[] = '开启';
                        }else{
                            $data[] = '关闭';
                        }
                    }else{
                        $data[] = '';
                        $data[] = '';
                        $data[] = '';
                        $data[] = '';
                        $data[] = '';
                    }
                }
            }
        }
        return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$data,'title'=>$title]);
        $this->export_excel($title,$data);
    }
    //编辑
    public function edit(){
        $id  = input('param.id/d');
        $key = input('param.key')?input('param.key/d'):0;

        $where = [];
        $where[] = ['id','=',$id];
        $where[] = ['aid','=',aid];
        $log = Db::name('shoporder_ranking_log')->where($where)->find();
        if($log && $log['givedata']){
            $log['givedata'] = json_decode($log['givedata'],true);
        }
        $log['totalmoney'] = $log['poolmoney']+$log['changemoney'];
        View::assign('log',$log);

        $detail = '';
        if($log){
            $where = [];
            $where[] = ['logid','=',$log['id']];
            $where[] = ['key','=',$key];
            $where[] = ['aid','=',aid];
            $detail = Db::name('shoporder_ranking_log_detail')->where($where)->find();
            if($detail && $detail['mlist']){
                $detail['mlist'] = json_decode($detail['mlist'],true);
            }
        }
        View::assign('detail',$detail);

        View::assign('id',$id);
        View::assign('key',$key);
        return View::fetch();
    }
    public function set(){
        if(request()->isAjax()){
            $info = input('post.info/a');
            $info['join_ordertype']  = $info['join_ordertype']?implode(',',$info['join_ordertype']):'';
            $info['join_ordertype2'] = $info['join_ordertype2']?implode(',',$info['join_ordertype2']):'';
            $postname    = input('post.name/a');
            $postratio   = input('post.ratio/a');
            if(empty($postratio)){
                return json(['status'=>0,'msg'=>'子分红池不能为空']);
            }
            $postmoney   = input('post.money/a');
            $postnum     = input('post.num/a');
            $postdisplay = input('post.display/a');
            $moreaves    = input('?param.moreave')?input('post.moreave/a'):[];

            $givedata  = array();
            foreach($postratio as $k=>$ratio){
                if(empty($postname[$k])){
                    return json(['status'=>0,'msg'=>'子分红池名称不能为空']);
                }
                if(empty($ratio) && $ratio !== '0'){
                    return json(['status'=>0,'msg'=>'子分红池不能为空']);
                }
                if(empty($postnum[$k]) || $postnum[$k]<=0){
                    return json(['status'=>0,'msg'=>'平分人数必须大于0']);
                }

                $moreave = [];//多段平分
                if($moreaves){
                    $thismoreave = $moreaves[$k]?$moreaves[$k]:[];
                    if($thismoreave){
                        $mins = $thismoreave['min'];
                        $maxs = $thismoreave['max'];
                        $ratios = $thismoreave['ratio'];
                        foreach($mins as $k2=>$v2){
                            if($v2<=0){
                                 return json(['status'=>0,'msg'=>'多段平分名次必须大于0']);
                            }
                            if($maxs[$k2]<$v2){
                                return json(['status'=>0,'msg'=>'多段平分最大名次必须大于等于最小名次']);
                            }
                            $moreave[] = [
                                'min'=>$v2,
                                'max'=>$maxs[$k2],
                                'ratio'=>$ratios[$k2],
                            ];
                        }
                    }
                }

                $givedata[] = array(
                    'name' =>$postname[$k],
                    'ratio'=>$ratio,
                    'money'=>$postmoney[$k],
                    'num'  =>$postnum[$k],
                    'display'=>$postdisplay[$k],
                    'moreave'=>$moreave,
                );
            }

            $info['givedata'] = json_encode($givedata,JSON_UNESCAPED_UNICODE);
            $count = Db::name('shoporder_ranking_set')->where('aid',aid)->value('id');
            if($count){
                $info['updatetime'] = time();
                $sql = Db::name('shoporder_ranking_set')->where('aid',aid)->update($info);
            }else{
                $info['aid'] = aid;
                $info['createtime'] = time();
                $sql = Db::name('shoporder_ranking_set')->insert($info);
            }
            if(!$sql){
                return json(['status'=>0,'msg'=>'操作失败']);
            }
            \app\common\System::plog('编辑消费排行榜');
            return json(['status'=>1,'msg'=>'操作成功','url'=>(string)url('index')]);
        }else{
            $info = Db::name('shoporder_ranking_set')->where('aid',aid)->find();
            if($info){
                $info['join_ordertype']  = $info['join_ordertype']?explode(',',$info['join_ordertype']):[];
                $info['join_ordertype2'] = $info['join_ordertype2']?explode(',',$info['join_ordertype2']):[];
            }
            View::assign('info',$info);

            $givedata = json_decode($info['givedata'],true);
            View::assign('givedata',$givedata);
            return View::fetch();
        }
    }

    //金额变动
    public static function changemoney(){
        $id = input('changeid/d');
        $log = Db::name('shoporder_ranking_log')->where('id',$id)->field('month')->find();
        if(!$log){
            return json(['status'=>0,'msg'=>'记录不存在']);
        }

        $nowmonth = strtotime(date("Y-m"));
        if($log['month'] != $nowmonth){
            return json(['status'=>0,'msg'=>'该月份分红总金额不能变动']);
        }

        $money = input('?param.changemoney')?input('changemoney'):0;
        if($money == 0){
            return json(['status'=>0,'msg'=>'请输入变动金额']);
        }
        $up = Db::name('shoporder_ranking_log')->where('id',$id)->inc('changemoney',$money)->update();
        if(!$up){
            return json(['status'=>1,'msg'=>'操作失败']);
        }
        \app\common\System::plog('消费排行榜金额变动'.$id.' '.$money);
        return json(['status'=>1,'msg'=>'操作成功']);
    }
}
