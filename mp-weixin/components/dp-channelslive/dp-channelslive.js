(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/dp-channelslive/dp-channelslive"],{"54fe":function(n,e,t){"use strict";var a;t.d(e,"b",(function(){return f})),t.d(e,"c",(function(){return r})),t.d(e,"a",(function(){return a}));var f=function(){var n=this,e=n.$createElement;n._self._c},r=[]},"8b812":function(n,e,t){"use strict";t.r(e);var a=t("c573"),f=t.n(a);for(var r in a)"default"!==r&&function(n){t.d(e,n,(function(){return a[n]}))}(r);e["default"]=f.a},bf04:function(n,e,t){"use strict";var a=t("fb2f"),f=t.n(a);f.a},c29d:function(n,e,t){"use strict";t.r(e);var a=t("54fe"),f=t("8b812");for(var r in f)"default"!==r&&function(n){t.d(e,n,(function(){return f[n]}))}(r);t("bf04");var u,c=t("f0c5"),o=Object(c["a"])(f["default"],a["b"],a["c"],!1,null,null,null,!1,a["a"],u);e["default"]=o.exports},c573:function(n,e,t){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;getApp();var a={props:{params:{},data:{}},data:function(){return{Height:"",hastabbar:!1,liveInfo:[]}},mounted:function(){var n=this;wx.getChannelsLiveInfo({finderUserName:n.params.channelsLive,success:function(e){"getChannelsLiveInfo:ok"==e.errMsg&&(n.liveInfo=e)},fail:function(n){console.log(n)}})}};e.default=a},fb2f:function(n,e,t){}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/dp-channelslive/dp-channelslive-create-component',
    {
        'components/dp-channelslive/dp-channelslive-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('543d')['createComponent'](__webpack_require__("c29d"))
        })
    },
    [['components/dp-channelslive/dp-channelslive-create-component']]
]);
