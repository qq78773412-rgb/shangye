<template>
  <div v-if="pageflag" class="left_boottom_wrap beautify-scroll-def" :class="{ 'overflow-y-auto': !sbtxSwiperFlag }">
  <div class='table-title-div'>
    <div style='width:20%;text-align:center'>会员</div>
    <div style='width:45%;text-align:left'>商品</div>
    <div>金额</div>
  </div>
  <div class='table-content'>
    <component :is="components" :data="list" :class-option="defaultOption">
      <ul class="left_boottom">
        <li class="left_boottom_item flex" v-for="(item, i) in list" :key="i">
          <span class="orderNum doudong">{{ item.vipName }}</span>
          <div class="inner_right">
              <div class="zhuyao title-item doudong">{{ item.shopName }}</div> 
              <div class="price-text">{{ item.shopprice }}</div>
          </div>
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
  methods: {
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
      // this.pageflag =false
      currentGET("big3", { limitNum: 20 }).then((res) => {
        if (res.success) {
          this.countUserNumData = res.data;
          this.list = res.data.list;
          let timer = setTimeout(() => {
            clearTimeout(timer);
            this.defaultOption.step =
              this.$store.state.setting.defaultOption.step;
          }, this.$store.state.setting.defaultOption.waitTime);
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
    position:absolute;    
    left:0;
    top:0;
    z-index:2;
    font-size:14px;
  }
  .table-content{
    position:absolute;
    top:46px;
    left:0px;
    width:100%;
    height:100%;
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
      width:20%;
      text-align:center;
      // color: $primary-color2;
      font-size:14px;
    }
    .inner_right {
      width:80%;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      
      .zhuyao {
        // color: $primary-color2;
        font-size: 15px;
        width:57%;
      }
      .price-text{
        
      }
    }
  }
}
</style>