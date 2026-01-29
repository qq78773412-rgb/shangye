<template>
  <!-- <div id="index" ref="appRef" class="index_home" :class="{ pageisScale: isScale }"> -->
  <ScaleScreen
    :width="2520"
    :height="1300"
    class="scale-wrap"
    :selfAdaption="$store.state.setting.isScale" 
  >
    <div class="bg">
      <dv-loading v-if="loading">Loading...</dv-loading>
      <div v-else class="host-body">
        <!-- 头部 s -->
        <div class="d-flex jc-center title_wrap">
          <div class="zuojuxing"></div>
          <div class="youjuxing"></div>
          <div class="guang"></div>
          <div class="d-flex jc-center">
            <div class="title">
              <span class="title-text">{{pageTitle || '智能数据大屏'}}</span>
              <dv-decoration-5 dur='5' class='decoration-class' :color="['#276fe9', '#01cffe']" />
            </div>
          </div>
          <div class="timers">
           <div>{{ dateYear}}{{ dateWeek }} {{ dateDay }}</div>
           <div @click='fullScreen' style='margin-left:10px;cursor:pointer'><i class="el-icon-full-screen" style="color:#007aff"></i></div>
           <!-- <div @click="showSetting">设置</div> -->
          </div>
        </div>
        <router-view></router-view>
      </div>
    </div>
    <Setting ref="setting" />
  </ScaleScreen>
  <!-- </div> -->
</template>

<script>
import { formatTime } from "../utils/index.js";
import Setting from "./setting.vue";
import ScaleScreen from "@/components/scale-screen/scale-screen.vue";
import { currentGET } from "api";
export default {
  components: { Setting, ScaleScreen },
  data() {
    return {
      timing: null,
      loading: true,
      dateDay: null,
      dateYear: null,
      dateWeek: null,
      weekday: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
      pageTitle:''
    };
  },
  filters: {
    numsFilter(msg) {
      return msg || 0;
    },
  },
  computed: {},
  created() {
    this.getSetTitle();
  },
  mounted() {
    this.timeFn();
    this.cancelLoading();
  },
  beforeDestroy() {
    clearInterval(this.timing);
  },
  methods: {
    fullScreen(){
      let full = document.fullscreenElement;
      if (!full) {
        document.documentElement.requestFullscreen();
      } else {
        document.exitFullscreen();
      }
    },
    getSetTitle(){
      currentGET("getSet").then(res => {
        this.pageTitle = res.data.title;
        document.title = res.data.title;
      })
    },
    showSetting() {
      this.$refs.setting.init();
    },
    timeFn() {
      this.timing = setInterval(() => {
        this.dateDay = formatTime(new Date(), "HH: mm: ss");
        this.dateYear = formatTime(new Date(), "yyyy年MM月dd日");
        this.dateWeek = this.weekday[new Date().getDay()];
      }, 1000);
    },
    cancelLoading() {
      let timer = setTimeout(() => {
        this.loading = false;
        clearTimeout(timer);
      }, 500);
    },
  },
};
</script>

<style lang="scss">
@import "./home.scss";
</style>
