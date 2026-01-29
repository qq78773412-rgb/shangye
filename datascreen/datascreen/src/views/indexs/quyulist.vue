<template>
  <div v-if="pageflag" class="right_center_wrap beautify-scroll-def" :class="{ 'overflow-y-auto': !sbtxSwiperFlag }">
    <div class='table-title-div'>
      <div style='width:50%;text-align:center'>代理区域</div>
      <div style='width:50%;text-align:center'>人数</div>
    </div>
    <div class='table-content'>
      <component :is="components" :data="dataList" :class-option="defaultOption">
        <ul class="right_center ">
          <li class="right_center_item" v-for="(item, i) in dataList" :key="i">
            <div class="huiyuan-info-div">
              <span class='address-div'>{{item.areafenhong_province}}</span>
              <span class='renshu'>{{item.areafenhong_num}}</span>
            </div>
          </li>
        </ul>
      </component>
    </div>
  </div>
  <Reacquire v-else @onclick="getData" style="line-height:200px" />

</template>

<script>
import { currentGET } from 'api/modules'
import vueSeamlessScroll from 'vue-seamless-scroll'  // vue2引入方式
import Kong from '../../components/kong.vue'
export default {
  components: { vueSeamlessScroll, Kong },
  data() {
    return {
      list: [],
      pageflag: true,
      defaultOption: {
        ...this.$store.state.setting.defaultOption,
        limitMoveNum: 3, 
        singleHeight: 250, 
        step:0,
      },
      memberCount:''

    };
  },
  props: {
    dataList: {
      default: [],
    },
  },
  computed: {
    sbtxSwiperFlag() {
      let ssyjSwiper = this.$store.state.setting.ssyjSwiper
      if (ssyjSwiper) {
        this.components = vueSeamlessScroll
      } else {
        this.components = Kong
      }
      return ssyjSwiper
    }
  },
  created() {
    // this.getData()
    let timer = setTimeout(() => {
              clearTimeout(timer)
              this.defaultOption.step=this.$store.state.setting.defaultOption.step
          }, this.$store.state.setting.defaultOption.waitTime);
  },

  mounted() { },
  methods: {
    getData() {
      this.pageflag = true
      // this.pageflag =false
      currentGET('getMember').then(res => {
        if (res.status) {
          this.memberCount = res.data.memberCount;
          this.list = res.data.memberlist
          let timer = setTimeout(() => {
              clearTimeout(timer)
              this.defaultOption.step=this.$store.state.setting.defaultOption.step
          }, this.$store.state.setting.defaultOption.waitTime);
        } else {
          this.pageflag = false
          this.$Message.warning(res.msg)
        }
      })
    },

  },
};
</script>
<style lang='scss' scoped>
  .table-title-div{
    width:100%;
    display:flex;
    align-items:center;
    background:#03050C;
    padding:10px 0px;
    position:sticky;    
    left:0;
    top:0px;
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
.right_center {
  width: 100%;
  height: 100%;
  .right_center_item {
    height: auto;
    padding:8px 10px;
    .huiyuan-info-div{
      display: flex;
      align-items: center;
      justify-content: flex-start;
      color:#fff;font-size:12px;padding:0px 10px;
      .address-div{
        width:50%;
        text-align:center;
      }
      .renshu{
        width:50%;
        text-align:center;
      }
    }
  }
}

.right_center_wrap {
  overflow: hidden;
  width: 100%;
  height: 240px;
  position:relative;
}
.memberCount-class{
  position:fixed;
  font-size:18px;
  color:#09a5de;
  left:0;
  top:0px;
}
.overflow-y-auto {
  overflow-y: auto;
}
</style>