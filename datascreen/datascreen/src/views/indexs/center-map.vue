<template>
  <div class="centermap">
    <div class="maptitle">
      <span class="titletext">销售总额：{{order_totalprice}}</span>
    </div>
    <div class="mapwrap">
        <!-- <div class="quanguo" @click="getData('china')" v-if="code !== 'china'">中国</div> -->
        <Echart id="CenterMap" :options="options" ref="CenterMap" />
    </div>
    <div class="right_bottom">
      <dv-capsule-chart :config="config" style="width:100%;height:auto" />
    </div>
  </div>
</template>

<script>
import xzqCode from "../../utils/map/xzqCode";
import { currentGET } from "api/modules";
import * as echarts from "echarts";
import { GETNOBASE } from "api";
export default {
  data() {
    return {
      gatewayno: '',
      config: {
        showValue: true,
        unit: "",
        data: [],
        colors:['#3487eb', '#3487eb', '#3487eb', '#3487eb', '#3487eb', '#3487eb', '#3487eb']
      },
      maptitle: "设备分布图",
      options: {},
      code: "china", //china 代表中国 其他地市是行政编码
      echartBindClick: false,
      isSouthChinaSea: false, //是否要展示南海群岛  修改此值请刷新页面
      order_totalprice:'',
      timer:''
    };
  },
  created() {},

  mounted() {
    this.getData("china");
    this.getOrderArea();
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
    // 销售总额
    getOrderArea(){
      currentGET("getOrderArea").then(res => {
        if(res.status){
          this.order_totalprice = res.data.order_totalprice;
        }else{
          this.$Message.warning(res.msg);
        }
      })
    },
    getData(code) {
      currentGET("getOrderArea", { regionCode: code }).then((res) => {
        if (res.status) {
          this.config = {
            ...this.config,
            data: res.data.order_area_list
          }
          this.getGeojson('china', res.data.order_area_list,res.data.qujian_arr);
          // this.mapclick(); //切换到下级地图暂不需要 隐藏
          this.$nextTick(() => {
            this.switper();
          });
        } else {
          this.$Message.warning(res.msg);
        }
      });
    },
    /**
     * @description: 获取geojson
     * @param {*} name china 表示中国 其他省份行政区编码
     * @param {*} mydata 接口返回列表数据
     * @return {*}
     */
    async getGeojson(name, mydata,qujuanlist) {
      this.code = name;
      //如果要展示南海群岛并且展示的是中国的话
      let geoname=name
      if (this.isSouthChinaSea && name == "china") {
        geoname = "chinaNanhai";
      }
      //如果有注册地图的话就不用再注册 了
      let mapjson = echarts.getMap(name);
      if (mapjson) {
        mapjson = mapjson.geoJSON;
      } else {
        mapjson = await GETNOBASE(`./map-geojson/${geoname}.json`).then((res) => {
          return res;
        });
        echarts.registerMap(name, mapjson);
      }
      let cityCenter = {};
      let arr = mapjson.features;
      //根据geojson获取省份中心点
      arr.map((item) => {
        cityCenter[item.properties.name] = item.properties.centroid || item.properties.center;
      });
      let newData = [];
      mydata.map((item) => {
        if (cityCenter[item.name]) {
          newData.push({ 
            name: item.name,
            value: cityCenter[item.name].concat(item.value),
          });
        }
      });
      this.init(name, mydata, newData,qujuanlist);
    },
    init(name, data, data2,qujuanlist) {
      let top = 80;
      let zoom = 1.2;
      let option = {
        backgroundColor: "rgba(0,0,0,0)",
        tooltip: {
          show: false,
        },
        legend: {
          show: false,
        },
        visualMap: {
          left: 50,
          bottom: 70,
          pieces:qujuanlist,
          // pieces: [
          //   { gte: 1000, label: "1000个以上" }, // 不指定 max，表示 max 为无限大（Infinity）。
          //   { gte: 600, lte: 999, label: "600-999" },
          //   { gte: 200, lte: 599, label: "200-599" },
          //   { gte: 50, lte: 199, label: "49-199" },
          //   { gte: 10, lte: 49, label: "10-49" },
          //   { lte: 9, label: "1-9" }, // 不指定 min，表示 min 为无限大（-Infinity）。
          // ],
          inRange: {
            // 渐变颜色，从小到大
            color: [
              "#f3ff02",
              "#ffb701",
              "#ff8c00",
              "#ff6b02",
              "#ff4000",
              "#ff2600",
            ],
            // symbolSize: [5,15,25,35,45,50]
          },
          textStyle: {
            color: "#fff",
          },
        },
        geo: {
          map: name,
          roam: false,
          selectedMode: false, //是否允许选中多个区域
          zoom: zoom,
          top: top,
          // aspectScale: 0.78,
          show: false,
        },
        series: [
          {
            name: "MAP",
            type: "map",
            map: name,
            // aspectScale: 0.78,
            data: data,
            // data: [1,100],
            selectedMode: false, //是否允许选中多个区域
            zoom: zoom,
            geoIndex: 1,
            top: top,
            tooltip: {
              show: true,
              formatter: function (params) {
                if (params.data) {
                  return params.name + "：" + params.data["value"];
                } else {
                  return params.name;
                }
              },
              backgroundColor: "rgba(0,0,0,.6)",
              borderColor: "rgba(147, 235, 248, .8)",
              textStyle: {
                color: "#FFF",
              },
            },
            label: {
              show: true,
              color: "#fff",
              fontSize: 11,
              textBorderColor: "#fff",
              textShadowColor: "#000",
              textShadowBlur: 10,
              textBorderWidth: 0,
              formatter: function (val) {
                if (val.data !== undefined) {
                  return val.name.slice(0, 2);
                } else {
                  return "";
                }
              }
            },
            emphasis: { //高亮状态
              label: {
                show: true,
                color:'#fff'
              },
              itemStyle: {
                areaColor: "#389BB7",
                borderWidth: 1,
              },
            },
            itemStyle: {
              borderColor: "rgba(147, 235, 248, .8)",
              borderWidth: 1,
              areaColor: {
                type: "radial",
                x: 0.5,
                y: 0.5,
                r: 0.8,
                colorStops: [
                  {
                    offset: 0,
                    color: "rgba(147, 235, 248, 0)", // 0% 处的颜色
                  },
                  {
                    offset: 1,
                    color: "rgba(147, 235, 248, .2)", // 100% 处的颜色
                  },
                ],
                globalCoord: false, // 缺为 false
              },
              shadowColor: "rgba(128, 217, 248, .3)",
              shadowOffsetX: -2,
              shadowOffsetY: 2,
              shadowBlur: 10,
            },
          },
          {
            data: data2,
            type: "effectScatter",
            coordinateSystem: "geo",
            symbolSize: function (val) {
              return 4;
              // return val[2] / 50;
            },
            legendHoverLink: true,
            showEffectOn: "render",
            rippleEffect: {
              // period: 4,
              scale: 6,
              // color: "red",
              brushType: "fill",
            },
            tooltip: {
              show: true,
              formatter: function (params) {
                if (params.data) {
                  return params.name + "：" + params.data["value"][2];
                } else {
                  return params.name;
                }
              },
              backgroundColor: "rgba(0,0,0,.6)",
              borderColor: "rgba(147, 235, 248, .8)",
              textStyle: {
                color: "#FFF",
              },
            },
            label: {
              formatter: (param) => {
                return param.name.slice(0, 2);
              },

              fontSize: 11,
              offset: [0, 2],
              position: "bottom",
              textBorderColor: "#fff",
              textShadowColor: "#000",
              textShadowBlur: 10,
              textBorderWidth: 0,
              color: "#FFF",
              show: false,
            },
            // colorBy: "data",
            itemStyle: {
              color: "rgba(255,255,255,1)",
              borderColor: "rgba(2255,255,255,2)",
              borderWidth: 4,
              shadowColor: "#000",
              shadowBlur: 10,
            },
          },
        ],
         //动画效果
            // animationDuration: 1000,
            // animationEasing: 'linear',
            // animationDurationUpdate: 1000
      };
      this.options = option;
    },
    message(text) {
      this.$Message({
        text: text,
        type: "warning",
      });
    },
    mapclick() {
      if (this.echartBindClick) return;
      //单击切换到级地图，当mapCode有值,说明可以切换到下级地图
      this.$refs.CenterMap.chart.on("click", (params) => {
        let xzqData = xzqCode[params.name];
        if (xzqData) {
          this.getData(xzqData.adcode);
        } else {
          this.message("暂无下级地市!");
        }
      });
      this.echartBindClick = true;
    },
  },
};
</script>
<style lang="scss" scoped>
.centermap {
  display:flex;
  align-items:center;
  justify-content:center;
  position:relative;
  .maptitle {
    position:absolute;
    left:50%;
    margin-left:-170px;
    top:3%;
    width:340px;
    text-align:center;
    color:#ffac50;
    .titletext {
      font-size: 24px;
      font-weight:bold;
    }
  }

  .mapwrap {
    height: 750px;
    width: 930px;
    margin-top:50px;
    box-sizing: border-box;
    position: relative;
    .quanguo {
      position: absolute;
      right: 20px;
      top: -46px;
      width: 80px;
      height: 28px;
      border: 1px solid #00eded;
      border-radius: 10px;
      color: #00f7f6;
      text-align: center;
      line-height: 26px;
      letter-spacing: 6px;
      cursor: pointer;
      box-shadow: 0 2px 4px rgba(0, 237, 237, 0.5),
        0 0 6px rgba(0, 237, 237, 0.4);
    }
  }
}
.right_bottom {
  width:380px;
  height:700px;
  box-sizing: border-box;
  margin-top:60px;
}
</style>
