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
// +----------------------------------------------------------------------
// | 空码
// +----------------------------------------------------------------------
namespace app\controller;
use think\facade\View;
use think\facade\Db;

class Qrcode extends Common
{
    public function initialize(){
        parent::initialize();
        if(!getcustom('extend_qrcode')  || bid>0) showmsg('无访问权限');
        if(bid > 0) showmsg('无操作权限');
    }

    //列表
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
            if(input('param.name')) $where[] = ['name','like','%'.input('param.name').'%'];
            if(input('?param.status') && input('param.status')!==''){
                $where[] = ['status','=',input('param.status')];
            }
            $count = 0 + Db::name('qrcode')->where($where)->count();
            $data = Db::name('qrcode')->where($where)->page($page,$limit)->order($order)->select()->toArray();
            foreach($data as $k=>$v){
                $data[$k]['totalcount'] = Db::name('qrcode_list')->where('aid',aid)->where('qid',$v['id'])->count();
                $data[$k]['bindcount']  = Db::name('qrcode_list')->where('aid',aid)->where('qid','>',0)->count();
            }
            return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$data]);
        }

        if($this->auth_data == 'all' || in_array('Qrcode/makecode',$this->auth_data)){
            $auth['makecode'] = true;
        }
        if($this->auth_data == 'all' || in_array('Qrcode/importexcel',$this->auth_data)){
            $auth['importexcel'] = true;
        }
        View::assign('auth',$auth);
        return View::fetch();
    }
    //编辑
    public function edit(){
        if(input('param.id')){
            $info = Db::name('qrcode')->where('aid',aid)->where('id',input('param.id/d'))->find();
        }else{
            $info = ['id'=>''];
        }
        View::assign('info',$info);
        return View::fetch();
    }
    //保存
    public function save(){
        $info = input('post.info/a');
        if(!$info['formurl']){
            return json(['status'=>0,'msg'=>'请选择链接']);
        }
        if($info['id']){
            Db::name('qrcode')->where('aid',aid)->where('id',$info['id'])->update($info);
            \app\common\System::plog('编辑空码'.$info['id']);
        }else{
            $info['aid'] = aid;
            $info['createtime'] = time();
            $id = Db::name('qrcode')->insertGetId($info);
            \app\common\System::plog('添加空码'.$id);
        }
        return json(['status'=>1,'msg'=>'操作成功','url'=>(string)url('index')]);
    }
    //删除
    public function del(){
        $ids = input('post.ids/a');
        Db::name('qrcode')->where('aid',aid)->where('id','in',$ids)->delete();
        Db::name('qrcode_list')->where('aid',aid)->where('qid','in',$ids)->delete();
        \app\common\System::plog('删除空码'.implode(',',$ids));
        return json(['status'=>1,'msg'=>'删除成功']);
    }
    //生成码
    public function makecode(){
        $qid = input('post.qid');
        //查询二维码
        $qrcode = Db::name('qrcode')->where('id',$qid)->where('aid',aid)->find();
        if(!$qrcode){
            return json(['status'=>0,'msg'=>'空码不存在']);
        }

        $makecount  = input('post.makecount/d');//数量
        $codelength = input('post.codelength')?input('post.codelength/d'):10;//位数
        $codetype   = input('post.codetype')?input('codetype/d'):5;//位数类型 5 数字加小写字母组成
        $qrtype     = input('post.qrtype')?input('qrtype/d'):3;//类型
        $pid        = input('post.pid')?input('pid/d'):0;//绑定分销商id
        $bindstatus = input('post.bindstatus')?input('bindstatus/d'):0;//绑定分销商id
        if($pid){
            //查询分销商id
            $count_member = Db::name('member')
                ->alias('m')
                ->join('member_level ml','ml.id=m.levelid')
                ->where('m.id',$pid)
                ->where('ml.can_agent','>',0)
                ->count('m.id');
            if(!$count_member){
                return json(['status'=>0,'msg'=>'绑定ID无分销权限']);
            }
        }
        if($makecount < 1 || $makecount > 5000){
            return json(['status'=>0,'msg'=>'每次生成数量须在5000以内']);
        }
        if($codelength < 1 || $codelength > 10){
            return json(['status'=>0,'msg'=>'二维码长度须小于10']);
        }

        $data = [];
        $data['aid'] = aid;
        $successnum = 0;

        for($i=0;$i<$makecount;$i++){
            $randstr = make_rand_code($codetype, $codelength);
            $data['code']   = $randstr;
            $data['qrtype'] = $qrtype;
            if($qrtype == 1){ //二维码
                $data['qrcode'] = createqrcode($randstr);
            }elseif($qrtype == 2){ //条形码
                $data['qrcode'] = createbarcode($randstr);
            }elseif($qrtype == 3){ //链接二维码
                $path = 'pagesA/qrcode/index?code='.$randstr;
                $data['pid'] = $pid;
                $data['qrcode'] = createqrcode(m_url($path));
            }elseif($qrtype == 4){ //小程序码
                $path = 'pagesA/qrcode/index?code='.$randstr;
                $data['pid'] = $pid;
                $rs = \app\common\Wechat::getQRCode(aid,'wx',$path);
                if($rs['status'] == 0){
                    return json($rs);
                }
                $data['qrcode'] = $rs['url'];
            }
            if($pid){
                $data['bindtime'] = time();
            }
            $data['bindstatus'] = $bindstatus;
            $hasinfo = Db::name('qrcode_list')->where($data)->find();
            if(!$hasinfo){
                $data['qid'] = $qid;
                $data['createtime'] = time();
                Db::name('qrcode_list')->insert($data);
                $successnum++;
            }
        }
        \app\common\System::plog('空码生成二维码'.$qid);
        return json(['status'=>1,'msg'=>'成功生成'.$successnum.'个码']);
    }
    //二维码
    public function list(){
        if(request()->isAjax()){
            $page = input('param.page');
            $limit = input('param.limit');
            if(input('param.field') && input('param.order')){
                $order = input('param.field').' '.input('param.order');
            }else{
                $order = 'id desc';
            }
            $where = [];
            $where[] = ['aid','=',aid];
            if(input('param.qid')){
                $where[] = ['qid','=',input('param.qid/d')];
            }

            if(input('param.code')) $where[] = ['code','=',input('param.code')];
            if(input('param.pid')) $where[] = ['pid','=',input('param.pid')];

            if(input('?param.bindstatus') && input('param.bindstatus')!=='') $where[] = ['bindstatus','=',input('param.bindstatus')];

            $count = 0 + Db::name('qrcode_list')->where($where)->count();
            $data = Db::name('qrcode_list')->where($where)->page($page,$limit)->order($order)->select()->toArray();
            foreach($data as $k=>$v){
                $data[$k]['qset'] = Db::name('qrcode')->where('id',$v['qid'])->field('id,name')->find();
                if($v['pid']){
                    $data[$k]['parent'] = Db::name('member')->field('id,aid,nickname,headimg')->where('aid',aid)->where('id',$v['pid'])->find();
                }
            }
            return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$data]);
        }
        if($this->auth_data == 'all' || in_array('Qrcode/listexcel',$this->auth_data)){
            $auth['listexcel'] = true;
        }
        if($this->auth_data == 'all' || in_array('Qrcode/listdel',$this->auth_data)){
            $auth['listdel'] = true;
        }
        if($this->auth_data == 'all' || in_array('Qrcode/listdownload',$this->auth_data)){
            $auth['listdownload'] = true;
        }
        View::assign('auth',$auth);
        return View::fetch();
    }
    //码导出
    public function listexcel(){
        if(input('param.field') && input('param.order')){
            $order = input('param.field').' '.input('param.order');
        }else{
            $order = 'id desc';
        }
        $page = input('param.page');
        $limit = input('param.limit');
        $where = [];
        $where[] = ['aid','=',aid];
        if(input('param.qid')){
            $where[] = ['qid','=',input('param.qid/d')];
        }

        if(input('param.code')) $where[] = ['code','=',input('param.code')];
        if(input('param.pid')) $where[] = ['pid','=',input('param.pid')];

        if(input('?param.bindstatus') && input('param.bindstatus')!=='') $where[] = ['bindstatus','=',input('param.bindstatus')];
        $list = Db::name('qrcode_list')->where($where)->order($order)->page($page,$limit)->select()->toArray();
        $count = Db::name('qrcode_list')->where($where)->count();
        
        $title = array();
        $title[] = 'ID';
        $title[] = '二维码';
        $title[] = '图片';
        $title[] = '活动信息';
        $title[] = '分销商';
        $title[] = '绑定时间';
        $title[] = '是否扫码绑定';
        $data = array();
        foreach($list as $v){

            $qset = Db::name('qrcode')->where('id',$v['qid'])->field('id,name')->find();
            if($v['pid']){
                $parent = Db::name('member')->field('id,aid,nickname,headimg')->where('aid',aid)->where('id',$v['pid'])->find();
            }

            $tdata = array();
            $tdata[] = $v['id'];
            $tdata[] = $v['code'];
            $tdata[] = $v['qrcode'];
            $name = $qset?$qset['name']:'';
            $tdata[] = '活动ID：'.$v['qid']." \r\n活动名称:".$name;
            $tdata[] = $v['pid'] && $parent?"ID:".$v['pid']." \r\n昵称:".$parent['nickname']:"ID:".$v['pid'];
            $tdata[] = $v['bindtime']?date('Y-m-d H:i:s',$v['bindtime']):'';

            $bindstatus = '';
            if($v['bindstatus']==1){
                $bindstatus = '是';
            }elseif($v['bindstatus']==0){
                $bindstatus = '否';
            }
            $tdata[] = $bindstatus;
            $data[] = $tdata;
        }
        return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$data,'title'=>$title]);
        $this->export_excel($title,$data);
    }
    //删除
    public function listdel(){
        $ids = input('post.ids/a');
        Db::name('qrcode_list')->where('aid',aid)->where('id','in',$ids)->delete();
        \app\common\System::plog('二维码删除'.implode(',',$ids));
        return json(['status'=>1,'msg'=>'删除成功']);
    }

    public function listdownload()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        if(input('param.field') && input('param.order')){
            $order = input('param.field').' '.input('param.order');
        }else{
            $order = 'id desc';
        }
        $where = [];
        $where[] = ['aid','=',aid];
        if(input('param.ids')){
            $ids = input('param.ids');
            $where[] = ['id','in',$ids];
        }

        if(input('param.qid')){
            $where[] = ['qid','=',input('param.qid/d')];
        }
        if(input('param.code')) $where[] = ['code','=',input('param.code')];
        if(input('param.pid')) $where[] = ['pid','=',input('param.pid')];
        if(input('?param.bindstatus') && input('param.bindstatus')!=='') $where[] = ['bindstatus','=',input('param.bindstatus')];
        $data = Db::name('qrcode_list')->where($where)->order($order)->select()->toArray();
        if($data){
            $dir = 'upload/temp/'.date('Ymd').'/'.date('His').rand(1000,9999);
            $dirall = ROOT_PATH.$dir;
            if(!is_dir($dirall)) mk_dir($dirall);
            $zippath = $dirall.'.zip';
            foreach($data as $k=>$v){
                $qrcode = \app\common\Pic::tolocal($v['qrcode']);
                $pathinfo  = pathinfo($qrcode);
                $parse_url = parse_url($qrcode);
                $parse_url['path'] = substr($parse_url['path'],1);
                \app\common\File::all_copy(ROOT_PATH.$parse_url['path'],$dirall.'/'.$v['id'].'.'.$pathinfo['extension']);
            }
            $myfile = fopen($zippath, "w");
            fclose($myfile);
            \app\common\File::add_file_to_zip($dirall,$zippath,uniqid());
            \app\common\File::remove_dir($dirall);
            $url = PRE_URL.'/'.$dir.'.zip';
            return json(['status'=>1,'msg'=>'打包成功','url'=>$url]);
        }else{
            return json(['status'=>0,'msg'=>'数据不存在']);
        }
    }

}