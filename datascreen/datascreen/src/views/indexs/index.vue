<template>
  <div>
  <div style='position:relative;z-index:9999'>
    <dv-border-box-1  dur='30'>
  <div class="contents">
      <div class='content-top-div'>
        <div class='top-left'>
          <ItemWrap class="contetn_left-top contetn_lr-item" title="实时订单" style="height:750px;">
            <SsOrder />
          </ItemWrap>
        </div>
        <div class='top-center'>
          <CenterMap />
          <!-- <RightCenter /> -->
        </div>
        <div class='right-left'>
          <ItemWrap class="contetn_left-top contetn_lr-item" title="实时佣金" style="height:750px;">
            <Ssyongjin />
          </ItemWrap>
        </div>
      </div>
      <div class='content-bottom-div'>
        <ItemWrap class="contetn_left-bottom contetn_lr-item" title="会员曲线" style='width:18%;height:300px;'>
          <RightTop />
        </ItemWrap>
        <ItemWrap class="contetn_left-bottom contetn_lr-item" title="会员数据" style='width:18%;height:300px;'>
          <RightBottom />
        </ItemWrap>
        <ItemWrap class="contetn_left-bottom contetn_lr-item" title="统计数据" style='width:28%;height:300px;'>
          <LeftTop/>  
        </ItemWrap>
        <ItemWrap class="contetn_left-top contetn_lr-item" title="余额提现" style="width:18%;height:300px;"  >
           <Yuetx />
        </ItemWrap>
        <ItemWrap class="contetn_left-top contetn_lr-item" title="佣金提现" style="width:18%;height:300px;"  >
          <YongJintx />
        </ItemWrap>
      </div>
      <dv-decoration-10 style="width:95%;height:1px;position:relative;left:2.5%;top:-6px;" />
  </div>

</dv-border-box-1>
  </div>
  <div class="map">
    <div class="map1"></div>
    <div class="map2"></div>
    <div class="map3"></div>
  </div>
</div>
</template>

<script>
import LeftTop from './left-top.vue'
import CenterMap from "./center-map.vue";
import RightTop from "./right-top.vue";
import RightCenter from "./right-center.vue";
import RightBottom from "./right-bottom.vue";
import YongJintx from "./yongjintx.vue";
import Yuetx from "./yuetx.vue";
import Ssyongjin from "./ssyongjin.vue";
import SsOrder from "./ssorder.vue";

export default {
  components: {
    LeftTop,
    CenterMap,
    RightTop,
    RightCenter,
    RightBottom,
    YongJintx,
    Yuetx,
    Ssyongjin,
    SsOrder
  },
  data() {
    return {
    
    };
  },
  filters: {
    numsFilter(msg) {
      return msg || 0;
    },
  },
  created() {
  },

  mounted() {},
  methods: {
  
  },
};
</script>
<style lang="scss" scoped>
// 内容
.contents {
  display:flex;
  flex-direction:column;
  justify-content:center;
  margin-top:2%;
  .content-top-div{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    width:100%;
    height:750px;
    .top-left{
      width: 500px;
      box-sizing: border-box;
    }
    .top-center{
      // display:flex;
      // align-items:flex-start;
      // flex:1;
      height:750px;
    }
    .right-left{
      width: 500px;
      box-sizing: border-box;
    }
  }
  .content-bottom-div{
    margin-top:90px;
    margin-bottom:20px;
    width:100%;
    display:flex;
    align-items:flex-start;
    justify-content:flex-start;
  }

}


@keyframes rotating {
    0% {
        -webkit-transform: rotate(0) scale(1);
        transform: rotate(0) scale(1);
    }
    50% {
        -webkit-transform: rotate(180deg) scale(1.1);
        transform: rotate(180deg) scale(1.1);
    }
    100% {
        -webkit-transform: rotate(360deg) scale(1);
        transform: rotate(360deg) scale(1);
    }
}
.map {
    width:100px;
    height:100px;
    position:fixed;
    left:50%;
    top:40%;
    transform:translate(-50%,-50%);
    display:none;
  .map1,
  .map2,
  .map3 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50rem;
    height: 50rem;
    background: url(../../assets/img/map.png) no-repeat;
    background-size: 100% 100%;
    opacity: 0.1;
  }
  .map2 {
    width: 45rem;
    height: 45rem;
    background-image: url(../../assets/img/lbx.png);
    opacity: 0.2;
    animation: rotate 25s linear infinite;
    z-index: 2;
  }
  .map3 {
    width: 43rem;
    height: 43rem;
    background-image: url(../../assets/img/jt.png);
    animation: rotate1 20s linear infinite;
  }

  @keyframes rotate {
    from {
      transform: translate(-50%, -50%) rotate(0deg);
    }
    to {
      transform: translate(-50%, -50%) rotate(360deg);
    }
  }
  @keyframes rotate1 {
    from {
      transform: translate(-50%, -50%) rotate(0deg);
    }
    to {
      transform: translate(-50%, -50%) rotate(-360deg);
    }
  }
}
</style>
