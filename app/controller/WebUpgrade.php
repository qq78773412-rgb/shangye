<?php

namespace app\controller;

class WebUpgrade extends Common
{
	public function initialize()
	{
		parent::initialize();
		$this->uid = session("BST_ID");
		$this->user = db("admin_user")->where(["id" => $this->uid])->find();
		if (!session("BST_ID") || !$this->user || $this->user["isadmin"] != 2) {
			showmsg("无访问权限");
		}
	}
	public function getfilllist()
	{
	    return json(["status" => 1, "newfileArr" => [],"modifyfileArr"=>[],"allfile"=>[]]);
	}
	public function index()
	{
		$myversion = file_get_contents(ROOT_PATH . "version.php");
		$newversion = $myversion;
		\think\facade\View::assign("newversion", $newversion);
		\think\facade\View::assign("myversion", $myversion);
		\think\facade\View::assign("remark", $rsdata["remark"]);
		if ($newversion != $myversion) {
			\think\facade\View::assign("needupgrade", 1);
		} else {
			\think\facade\View::assign("needupgrade", 0);
		}
		return \think\facade\View::fetch();
	}
	public function douph5test()
	{
		$h5indexhtml = file_get_contents(ROOT_PATH . "/h5/index.html");
		$h5indexhtml = str_replace("商城", "", $h5indexhtml);
		$h5indexhtml = str_replace("</title><script>", "</title><script>var uniacid=1;var siteroot = \"https://\"+window.location.host;", $h5indexhtml);
		file_put_contents(ROOT_PATH . "/h5/index.html", $h5indexhtml);
		preg_match("/static\\/js\\/index\\.[a-z0-9]+\\.js/", $h5indexhtml, $matches);
		$indexjs = $matches[0];
		$indexjscontent = file_get_contents(ROOT_PATH . "/h5/" . $indexjs);
		$indexjscontent = preg_replace_callback("/uniacid\\:\\\"[0-9]*\\\",siteroot\\:\\\"[^\"]*\\\"/", function ($matches) {
			return "uniacid:uniacid,siteroot:siteroot";
		}, $indexjscontent);
		file_put_contents(ROOT_PATH . "/h5/" . $indexjs, $indexjscontent);
		return $this->douph5();
	}
}