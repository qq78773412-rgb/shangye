(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/parse/components/wxParseVideo"],{"2cc8":function(t,n,e){"use strict";var o;e.d(n,"b",(function(){return a})),e.d(n,"c",(function(){return u})),e.d(n,"a",(function(){return o}));var a=function(){var t=this,n=t.$createElement;t._self._c},u=[]},"40cd":function(t,n,e){"use strict";e.r(n);var o=e("8bf0"),a=e.n(o);for(var u in o)"default"!==u&&function(t){e.d(n,t,(function(){return o[t]}))}(u);n["default"]=a.a},"6fb2":function(t,n,e){"use strict";var o=e("b5dd"),a=e.n(o);a.a},"8bf0":function(t,n,e){"use strict";(function(t){Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var e={name:"wxParseVideo",props:{node:{}},data:function(){return{playState:!0,videoStyle:"width: 100%;"}},methods:{play:function(){console.log("点击了video 播放"),this.playState=!this.playState}},mounted:function(){var n=this;t.$on("slideMenuShow",(function(t){console.log("捕获事件："+t),"show"==t&&n.playState&&(n.playState=!1)}))}};n.default=e}).call(this,e("a821")["default"])},b5dd:function(t,n,e){},b928:function(t,n,e){"use strict";e.r(n);var o=e("2cc8"),a=e("40cd");for(var u in a)"default"!==u&&function(t){e.d(n,t,(function(){return a[t]}))}(u);e("6fb2");var c,r=e("f0c5"),i=Object(r["a"])(a["default"],o["b"],o["c"],!1,null,null,null,!1,o["a"],c);n["default"]=i.exports}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/parse/components/wxParseVideo-create-component',
    {
        'components/parse/components/wxParseVideo-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('a821')['createComponent'](__webpack_require__("b928"))
        })
    },
    [['components/parse/components/wxParseVideo-create-component']]
]);
