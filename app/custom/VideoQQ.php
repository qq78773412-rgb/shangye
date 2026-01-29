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

//custom_file(video_qq_url)
namespace app\custom;

class VideoQQ
{
    public static function getMp4Url($url)
    {
        $urlArr = parse_url($url);
        if($urlArr['host'] != 'v.qq.com' || strpos($urlArr['path'],'/x/page/') === false)
            return $url;

        $videoID = str_ireplace('/x/page/','',$urlArr['path']);
        $videoID = str_ireplace('.html','',$videoID);

        $formatUrl = "http://vv.video.qq.com/getinfo?vids=".$videoID."&platform=101001&charge=0&otype=json";
        $content = curl_get($formatUrl);
        $tencent_video_json = substr(explode('QZOutputJson=',$content)[1],0,-1);
        $tencent_video_array = json_decode($tencent_video_json,true);
//        dd($tencent_video_array);
        if(empty($tencent_video_array['vl']['vi'][0]['fvkey'])){
            return $url;
        }
        $fvkey = $tencent_video_array['vl']['vi'][0]['fvkey'];  // 视频的fvkey,类似于微信的access_token,会变动
        $fn = $tencent_video_array['vl']['vi'][0]['fn'];
        $url = $tencent_video_array['vl']['vi'][0]['ul']['ui'][0]['url'];

        $video_url = $url.$fn.'?vkey='.$fvkey;
        return $video_url;
    }
}