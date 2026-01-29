<?php

namespace app\controller;

class Base extends \app\BaseController
{
	public $aid;
	public $bid;
	public $uid;
	public $user;
	public $mdid = 0;
	public $auth_data = "all";
	public $platform = "mp";
	public $xcxaid = 0;
	public function initialize()
	{
		$request = request();
		if (!in_array($request->controller(), ["login"]) && !session("?ADMIN_LOGIN")) {
			header("Location:" . \strval(url("login/index")));
			exit;
		}
		$this->aid = session("ADMIN_AID");
		if (MN == "business") {
			$this->uid = session("ADMIN_AUTH_UID");
			$this->bid = session("ADMIN_AUTH_BID");
		} else {
			$this->uid = session("ADMIN_UID");
			$this->bid = session("ADMIN_BID");
		}
		define("aid", $this->aid);
		define("bid", $this->bid);
		define("uid", $this->uid);
		$user = \think\facade\Db::name("admin_user")->where("id", $this->uid)->find();
		if ($user["groupid"]) {
			$group = \think\facade\Db::name("admin_user_group")->where("id", $user["groupid"])->find();
			$user["auth_data"] = $group["auth_data"];
			$user["wxauth_data"] = $group["wxauth_data"];
			$user["notice_auth_data"] = $group["notice_auth_data"];
			$user["hexiao_auth_data"] = $group["hexiao_auth_data"];
			$user["mdid"] = $group["mdid"];
			$user["showtj"] = $group["showtj"];
		}
		$this->user = $user;
		$this->mdid = $user["mdid"];
		if ($user["auth_type"] == 0 && !session("BST_ID")) {
			$auth_data = json_decode($user["auth_data"], true);
			$auth_path = \app\common\Menu::blacklist();
			foreach ($auth_data as $v) {
				$auth_path = array_merge($auth_path, explode(",", $v));
			}
			$thispath = $request->controller() . "/" . $request->action();
			if (!in_array($request->controller() . "/*", $auth_path) && !in_array($thispath, $auth_path)) {
				exit("无访问权限");
			}
			$this->auth_data = $auth_path;
		} else {
			$this->auth_data = "all";
		}
		\think\facade\View::assign("aid", $this->aid);
		\think\facade\View::assign("bid", $this->bid);
		\think\facade\View::assign("auth_data", $this->auth_data);
		$platform = \app\common\Common::getplatform(aid);
		$this->platform = $platform;
		\think\facade\View::assign("platform", $platform);
		$admin = \think\facade\Db::name("admin")->where("id", aid)->find();
		if ($admin["domain"]) {
			define("PRE_URL2", "https://" . $admin["domain"]);
		} else {
			define("PRE_URL2", PRE_URL);
		}
	}
	
	function export_excel(array $titleArr,array $dataArr,array $typeArr=[]){
		$phpexcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();//实例化
		$phpsheet = $phpexcel->getActiveSheet();
		//填充表头信息
		$widthArr = [];
		for($i = 0;$i < count($titleArr);$i++) {
			$phpsheet->setCellValue(IntToChr($i)."1","$titleArr[$i]");
			$widthArr[] = strlen($titleArr[$i]);
		}
		//填充表格信息
		for ($i = 2;$i <= count($dataArr) + 1;$i++) {
			$j = 0;
			foreach ($dataArr[$i-2] as $key=>$value) {
			    if($typeArr && $typeArr[$j] == 1)//数字
                    $phpsheet->setCellValue(IntToChr($j)."$i","$value");
			    else
				    $phpsheet->setCellValueExplicit(IntToChr($j)."$i","$value",\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				if(strlen($value) > $widthArr[$j]){
					$widthArr[$j] = strlen($value);
					if($widthArr[$j] > 25) $widthArr[$j] = 25;
				}
				$j++;
			}
		}
		//设置列宽
		foreach($widthArr as $k=>$v){
			$phpsheet->getColumnDimension(IntToChr($k))->setWidth($v+2);
		}
		$phpwriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($phpexcel,"Xlsx");
		header('Content-Disposition: attachment;filename="'.date('YmdHis').'.xlsx"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$phpwriter->save("php://output");
	}
	function import_excel($file='', $startrow=2){
		if(strpos(PRE_URL,$file)==0){
			$file = ROOT_PATH.ltrim(str_replace(PRE_URL,'',$file),'/');
		}
		$file = iconv("utf-8", "gb2312", $file);   //转码
		if(empty($file) OR !file_exists($file)) {
			echojson(['status'=>0,'msg'=>'file not exists!']);
		}
		$objRead = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');   //建立reader对象
		if(!$objRead->canRead($file)){
			$objRead = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
			if(!$objRead->canRead($file)){
				echojson(['status'=>0,'msg'=>'No Excel!']);
			}
		}
		$PHPExcel = $objRead->load($file);
		$currentSheet = $PHPExcel->getSheet(0);  //读取excel文件中的第一个工作表
		$allColumn = $currentSheet->getHighestColumn(); //取得最大的列号
		$allRow = $currentSheet->getHighestRow(); //取得一共有多少行
		$exceldata = array();
		/**从第二行开始输出，因为excel表中第一行为列名*/
		for($currentRow = $startrow;$currentRow <= $allRow;$currentRow++){
			/**从第A列开始输出*/
			$erp_orders_id = array();  //声明数组
			for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				$val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 64,$currentRow)->getValue();/**ord()将字符转为十进制数*/
				$erp_orders_id[] = $val;
			}
			$exceldata[] = $erp_orders_id;
		}
		return $exceldata;
	}
	
}