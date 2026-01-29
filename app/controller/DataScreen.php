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

//custom_file(data_screen)
// +----------------------------------------------------------------------
// | 大屏数据展示
// +----------------------------------------------------------------------
namespace app\controller;
use think\facade\View;
use think\facade\Db;

//class DataScreen extends Base
class DataScreen extends Common
{	
	public $aid = 1;
    public function initialize(){
		parent::initialize();
		if(bid > 0) showmsg('无访问权限');
		$this->aid = aid;
	}
	//
	public function index(){
		$aid  = $this->aid;
		$domain = PRE_URL;
		$url = $domain . '/datascreen/index.html#/index';
		$binfo = Db::name('admin_set')->where('aid',$aid)->field('id,data_screen_title')->find();
		View::assign('datascreen_url', $url);		
		View::assign('info', $binfo);		
		return View::fetch();
	}

	public function save(){
		$aid  = $this->aid;
        $info = input('post.info/a');
        $info['data_screen_title'] = $info['data_screen_title'];
        if($info['id']){
            Db::name('admin_set')->where('aid',$aid)->where('id',$info['id'])->update($info);
            \app\common\System::plog('编辑数据展示标题'.$info['id']);
        }      
       
        return json(['status'=>1,'msg'=>'操作成功','url'=>(string)url('index')]);
    }
	
	//数据
	public function getData(){
		set_time_limit(0);
		ini_set('memory_limit', -1);
		$yearstart = strtotime(date('Y-01-01', strtotime("-1 year")));
		$yearend = strtotime(date('Y-12-31 23:59:59'));
		$aid  = $this->aid;
		//增加代发货、已发货、已完成、数量显示
		$count1 = 0 + Db::name('shop_order')->where('aid',$aid)->where('bid',0)->where('status',1)->count();
		$count2 = 0 + Db::name('shop_order')->where('aid',$aid)->where('bid',0)->where('status',2)->count();
		$count3 = 0 + Db::name('shop_order')->where('aid',$aid)->where('bid',0)->where('status',3)->count();
		$rdata['ordernum'] = [
			'daifahuo'=>$count1,
			'yifahuo'=>$count2,
			'yiwancheng'=>$count3,
		];
		//要求有中国动态地图鼠标到那个位置显示那个区域的销售业绩
		//实时显示销售总金额
		// $order_area = Db::name('shop_order')->field("id,SUBSTRING_INDEX(area2,',',1) AS province,CAST(sum(totalprice) AS DECIMAL(10,2)) AS provincePrice")->where('createtime','<',$yearend)->where('createtime','>',$yearstart)->where('aid',$aid)->order('id desc')->group('province')->where('status','in','1,2,3')->select()->toArray();
		// $order_totalprice = Db::name('shop_order')->where('aid',aid)->where('status','in','1,2,3')->where('aid',$aid)->sum('totalprice');
		// $order_totalprice = round($order_totalprice,2);
		// $rdata['orderarea'] = [
		// 	'order_area'=>$order_area,
		// 	'order_totalprice'=>$order_totalprice,
		// ];

		//已经代理区域
		$member_level = Db::name('member_level')->where('aid',$aid)->where('areafenhong','>','0')->column('id');
		
		$where='areafenhong > 0 ';
		if(count($member_level)>0){
			$level_id = implode(',',$member_level);
			$where .= ' or levelid in('.$level_id.')';
		}
		$dalinum = 0 + Db::name('member')->where('aid',$aid)->where('aid',$aid)->where($where)->where('areafenhong_province','<>','')->group('areafenhong_province')->count();
		$dialiarea = Db::name('member')->field('areafenhong_province,count(*) as areafenhong_num')->where('aid',$aid)->where($where)->where('areafenhong_province','<>','')->group('areafenhong_province')->order('areafenhong_num desc')->select()->toArray();
		$rdata['quyudaili'] = [
			'dalinum'=>$dalinum,
			'dialiarea'=>$dialiarea,
		];
		
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}
	//数据
	public function getSet(){
		$aid  = $this->aid;
		$info = Db::name('admin_set')->where('aid',$aid)->field('id,data_screen_title')->find();
		$rdata['title'] = $info['data_screen_title'];		
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}
	/**
	 * 会员信息
	 */

	public function getMember(){
		$pagenum = input('post.pagenum');
		if(!$pagenum) $pagenum = 1;
		$pageSize = input('post.pageSize');
		if(!$pageSize) $pernum = 30;
		$aid = $this->aid;
		$memberCount = 0 + Db::name('member')->where('aid',$aid)->count();
		$memberlist = Db::name('member')->alias('o')->field('o.id,o.nickname,o.headimg,o.pid,o.createtime,m.nickname as p_nickname')->leftjoin('member m','o.pid=m.id')->where('o.aid',$aid)->order('o.id desc')->page($pagenum,$pernum)->select()->toArray();
		$member_quxian = Db::name('member')->field("id,FROM_UNIXTIME(createtime,'%Y-%m') as day,COUNT(*) AS userCount")->where('aid',$aid)->group('day')->select();
		$rdata = [
			'memberCount'=>$memberCount,
			'memberlist'=>$memberlist,
			'member_quxian'=>$member_quxian,
		];
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}
	/**
	 * 
	 * 要求有中国动态地图鼠标到那个位置显示那个区域的销售业绩
	 * 实时显示销售总金额
	 */
	public function getOrderArea(){	
		$aid = $this->aid;
		$order_area = Db::name('shop_order')->field("id,SUBSTRING_INDEX(area2,',',1) AS province,CAST(sum(totalprice) AS DECIMAL(10,2)) AS provincePrice")->where('aid',$aid)->order('id desc')->group('province')->where('status','in','1,2,3')->where('bid',0)->select()->toArray();
		$order_totalprice = Db::name('shop_order')->where('aid',$aid)->where('bid',0)->where('status','in','1,2,3')->sum('totalprice');
		$order_totalprice = round($order_totalprice,2);
		$order_area = array_column($order_area, 'provincePrice','province');
		$provinceList = [
			['name'=>'北京市','value'=>0],
			['name'=>'天津市','value'=>0],
			['name'=>'河北省','value'=>0],
			['name'=>'山西省','value'=>0],
			['name'=>'内蒙古自治区','value'=>0],
			['name'=>'辽宁省','value'=>0],
			['name'=>'吉林省','value'=>0],
			['name'=>'黑龙江省','value'=>0],
			['name'=>'上海市','value'=>0],
			['name'=>'江苏省','value'=>0],
			['name'=>'浙江省','value'=>0],
			['name'=>'安徽省','value'=>0],
			['name'=>'福建省','value'=>0],
			['name'=>'江西省','value'=>0],
			['name'=>'山东省','value'=>0],
			['name'=>'河南省','value'=>0],
			['name'=>'湖北省','value'=>0],
			['name'=>'湖南省','value'=>0],
			['name'=>'广东省','value'=>0],
			['name'=>'广西壮族自治区','value'=>0],
			['name'=>'海南省','value'=>0],
			['name'=>'重庆市','value'=>0],
			['name'=>'四川省','value'=>0],
			['name'=>'贵州省','value'=>0],
			['name'=>'云南省','value'=>0],
			['name'=>'西藏自治区','value'=>0],
			['name'=>'陕西省','value'=>0],
			['name'=>'甘肃省','value'=>0],
			['name'=>'青海省','value'=>0],
			['name'=>'宁夏回族自治区','value'=>0],
			['name'=>'新疆维吾尔自治区','value'=>0],
			['name'=>'台湾省','value'=>0],
			['name'=>'香港特别行政区','value'=>0],
			['name'=>'澳门特别行政区','value'=>0],
		];
		foreach($provinceList as $k=>$v){
			$provinceList[$k]['value'] = $order_area[$v['name']]??0;
		}
		$last_value = array_column($provinceList,'value');
		array_multisort($last_value,SORT_DESC,$provinceList);
		$province= $provinceList;
		
		$qujian = floor($provinceList[0]['value']/6);
		for($i=0;$i<6;$i++){
			$start = $i*$qujian;
			$end = ($i+1)*$qujian;
			if($i == 0){
				$start = 1;
			}
			if($i==5){
				$qujian_arr[]=[
					'gte'=>$start,
					'label'=>$start.'以上'
				];
			}else{
				$qujian_arr[]=[
					'gte'=>$start,
					'lte'=>$end,
					'label'=>$start.'-'.$end,
				];
			}
			
		}
		$province_arr=[];
		foreach($province as $k=>$v){
			if($v['value']!=0){
				$province_arr[]=$v;
			}			
		}
		$rdata = [
			'order_area'=>$province_arr,
			'order_area_list'=>$provinceList,
			'order_totalprice'=>$order_totalprice,
			'qujian_arr'=>$qujian_arr,
		];
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}
	/**
	 * 
	 * 订单
	 */
	public function getShopOrder(){
		$pagenum = input('post.pagenum');
		if(!$pagenum) $pagenum = 1;
		$pageSize = input('post.pageSize');
		if(!$pageSize) $pernum = 30;
		$aid = $this->aid;
		$orderlist = Db::name('shop_order')->alias('o')->field('o.id,o.title,o.mid,CAST(o.totalprice AS DECIMAL(10,2)) AS totalprice,o.createtime,m.nickname,m.headimg,ml.name as level_name')->leftjoin('member m','o.mid=m.id')->leftjoin('member_level ml','ml.id=m.levelid')->where('o.aid',$aid)->order('o.id desc')->where('status','in','1,2,3')->where('o.bid',0)->page($pagenum,$pernum)->select()->toArray();
		$rdata = [
			'orderlist'=>$orderlist,
		];
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}
	/**
	 * 
	 * 佣金
	 */
	public function getCommissionlog(){
		$pagenum = input('post.pagenum');
		if(!$pagenum) $pagenum = 1;
		$pageSize = input('post.pageSize');
		if(!$pageSize) $pernum = 30;	
		$aid = $this->aid;
		$list = Db::name('member_commissionlog')->alias('o')->field('o.mid,CAST(o.commission AS DECIMAL(10,2)) AS commission,o.createtime,m.nickname,m.headimg,ml.name as level_name')->leftjoin('member m','o.mid=m.id')->leftjoin('member_level ml','ml.id=m.levelid')->where('o.aid',$aid)->order('o.id desc')->page($pagenum,$pernum)->select()->toArray();
		$rdata = [
			'list'=>$list,
		];
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}

	/**
	 * 
	 * 余额提现
	 */
	public function getMoneyWithdraw(){
		$pagenum = input('post.pagenum');
		if(!$pagenum) $pagenum = 1;
		$pageSize = input('post.pageSize');
		if(!$pageSize) $pernum = 30;	
		$aid = $this->aid;
		$list = Db::name('member_withdrawlog')->alias('o')->field('o.mid,o.money,o.paytype,o.createtime,m.nickname,m.headimg')->leftjoin('member m','o.mid=m.id')->where('o.aid',$aid)->order('o.id desc')->page($pagenum,$pernum)->select()->toArray();
		$rdata = [
			'list'=>$list,
		];
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}

	/**
	 * 
	 * 佣金提现
	 */
	public function getCommissionWithdraw(){
		$pagenum = input('post.pagenum');
		if(!$pagenum) $pagenum = 1;
		$pageSize = input('post.pageSize');
		if(!$pageSize) $pernum = 30;
		$aid = $this->aid;
		$list = Db::name('member_commission_withdrawlog')->alias('o')->field('o.mid,o.money,o.paytype,o.createtime,m.nickname,m.headimg')->leftjoin('member m','o.mid=m.id')->where('o.aid',$aid)->order('o.id desc')->page($pagenum,$pernum)->select()->toArray();
		$rdata = [
			'list'=>$list,
		];
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}

	//数据
	public function getOtherData(){
		$aid  = $this->aid;
		//增加代发货、已发货、已完成、数量显示
		$count1 = 0 + Db::name('shop_order')->where('aid',$aid)->where('status',1)->count();
		$count2 = 0 + Db::name('shop_order')->where('aid',$aid)->where('status',2)->count();
		$count3 = 0 + Db::name('shop_order')->where('aid',$aid)->where('status',3)->count();
		$rdata['ordernum'] = [
			'daifahuo'=>$count1,
			'yifahuo'=>$count2,
			'yiwancheng'=>$count3,
		];
		//已经代理区域
		$dalinum = 0 + Db::name('member')->where('aid',$aid)->where('areafenhong','>','0')->count();
		$dialiarea = Db::name('member')->field('areafenhong_province,count(*) as areafenhong_num')->where('aid',$aid)->where('areafenhong','>','0')->group('areafenhong_province')->select()->toArray();
		$rdata['quyudaili'] = [
			'dalinum '=>$dalinum,
			'dialiarea'=>$dialiarea,
		];
		return json(['status'=>1,'msg'=>'操作成功','data'=>$rdata]);
	}

	
}