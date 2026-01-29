<template>
  <div v-if="pageflag" class="left_boottom_wrap beautify-scroll-def" :class="{ 'overflow-y-auto': !sbtxSwiperFlag }" ref='charts'>
    <div class='table-title-div'>
    <!-- <div style='width:10%;text-align:center'>ID</div> -->
    <div style='width:22%;text-align:center'>姓名</div>
    <div style='width:25%;text-align:center'>会员等级</div>
    <div style='width:30%;text-align:center'>商品名称</div>
    <div style='width:20%;text-align:center'>金额</div>
  </div>
  <div class='table-content'>
    <component :is="components" :data="list" :class-option="defaultOption">
      <ul class="left_boottom">
        <li class="left_boottom_item flex" v-for="(item, i) in list" :key="i">
          <!-- <span class="orderNum">{{ item.mid }}</span> -->
          <span class='nickname'>{{item.nickname || '--'}}</span>
          <span class='levelname-text'>{{item.level_name || '--'}}</span>
          <span class='shop-title'>{{item.title}}</span>
          <span class='shop-price'>{{item.totalprice}}</span>
        </li>
      </ul>
    </component>
  </div>
  </div>

  <Reacquire v-else @onclick="getData" style="line-height: 200px" />
</template>

<script>
import { currentGET } from "api";
import vueSeamlessScroll from "vue-seamless-scroll";
import Kong from "../../components/kong.vue";
export default {
  components: { vueSeamlessScroll, Kong },
  data() {
    return {
      list: [],
      pageflag: true,
      components: vueSeamlessScroll,
      defaultOption: {
        ...this.$store.state.setting.defaultOption,
        singleHeight: 240,
        limitMoveNum: 5, 
        step: 0,
      },
      timer:''
    };
  },
  computed: {
    sbtxSwiperFlag() {
      let sbtxSwiper = this.$store.state.setting.sbtxSwiper;
      if (sbtxSwiper) {
        this.components = vueSeamlessScroll;
      } else {
        this.components = Kong;
      }
      return sbtxSwiper;
    },
  },
  created() {
    
  },
  
  mounted() {
    this.getData();
  },
  beforeDestroy() {
    this.clearData();
  },
  methods: {
    clearData() {
      if (this.timer) {
        clearInterval(this.timer);
        this.timer = null;
      }
    },
    //轮询
    switper() {
      if (this.timer) {
        return;
      }
      let looper = (a) => {
        this.getData();
      };
      this.timer = setInterval(
        looper,
        this.$store.state.setting.echartsAutoTime
      );
    },
    addressHandle(item) {
      let name = item.provinceName;
      if (item.cityName) {
        name += "/" + item.cityName;
        if (item.countyName) {
          name += "/" + item.countyName;
        }
      }
      return name;
    },
    getData() {
      this.pageflag = true;
      currentGET("getShopOrder").then((res) => {
        if (res.status) {
          this.countUserNumData = res.data;
          this.list = res.data.orderlist;
          let timer = setTimeout(() => {
            clearTimeout(timer);
            this.defaultOption.step =
              this.$store.state.setting.defaultOption.step;
          }, this.$store.state.setting.defaultOption.waitTime);
          this.$nextTick(() => {
            this.switper();
          });
        } else {
          this.pageflag = false;
          this.$Message({
            text: res.msg,
            type: "warning",
          });
        }
      });
    },
  },
};
</script>
<style lang='scss' scoped>
.left_boottom_wrap {
  overflow: hidden;
  width: 100%;
  height: 95%;
  position:relative;
  .table-title-div{
    width:100%;
    display:flex;
    align-items:center;
    background:#03050C;
    padding:15px 0px;
    position:sticky;    
    left:0;
    top:10px;
    z-index:2;
    font-size:14px;
  }
  .table-content{
    position:absolute;
    top:46px;
    left:0px;
    width:100%;
    height:100%;
    overflow:hidden;
  }
}

.doudong {
  //  vertical-align:middle;
  overflow: hidden;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
}

.overflow-y-auto {
  overflow-y: auto;
}

.left_boottom {
  width: 100%;
  height: 100%;
  .left_boottom_item {
    width:100%;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding:10px 0px;
    .orderNum {
      width:14%;
      text-align:center;
      // color: $primary-color2;
    }
    .nickname{
      min-width:23%;
      text-align:center;
    }
    .levelname-text{
      text-align:center;
      width:25%;
    }
    .shop-title{
      text-align:center;
      width:30%;
      overflow:hidden;
      white-space:nowrap;
      text-overflow:ellipsis;
    }
    .shop-price{
      text-align:center;
      width:20%;
    }
    .createtime-text{
      width:15%;
      text-align:center;
    }
  }
}
</style>