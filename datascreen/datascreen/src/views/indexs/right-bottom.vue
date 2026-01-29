<template>
  <div v-if="pageflag" class="right_center_wrap beautify-scroll-def" :class="{ 'overflow-y-auto': !sbtxSwiperFlag }">
    <div class='table-title-div'>
      <div style='width:12%;text-align:center'>头像</div>
      <div style='width:20%;text-align:center'>姓名</div>
      <div style='width:30%;text-align:center'>推荐人</div>
      <div style='width:35%;text-align:center'>注册时间</div>
    </div>
    <div class='table-content'>
      <component :is="components" :data="list" :class-option="defaultOption">
        <ul class="right_center ">
          <li class="right_center_item" v-for="(item, i) in list" :key="i">
            <div class="huiyuan-info-div">
              <div class='touxinag-img'>
                <img :src='item.headimg' />
              </div>
              <div class='nickname'>
                {{item.nickname}}
              </div>
              <div class='shangji-tuijian'>{{item.p_nickname || '暂无'}}</div>
              <div class='time'>{{item.createtime | toTimeconversion}}</div>
            </div>
          </li>
        </ul>
        <!-- <div class='memberCount-class'>
        会员总数：{{memberCount}}
      </div> -->
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
      memberCount:'',
      timer:''

    };
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
    this.getData()
  },

  mounted() { },
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
          this.$nextTick(() => {
            this.switper();
          });
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
      .touxinag-img{
        border-radius:50%;
        width:30px;
        height:30px;
        overflow:hidden;
        border:1px #fff solid;
      }
      .touxinag-img img{
        width:100%;
        height:100%;
      }
      .nickname{color:#fff;font-size:12px;padding:0px 10px;width:20%;text-align:center;white-space: nowrap;
        text-overflow: ellipsis;}
      .shangji-tuijian{color:#fff;font-size:12px;padding:0px 10px;width:20%;text-align:center;white-space: nowrap;
        text-overflow: ellipsis;}
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
  border:1px red solid;
}
.overflow-y-auto {
  overflow-y: auto;
}
</style>