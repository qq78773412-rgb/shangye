<template>
    <div class='content-div'>
        <ul class="user_Overview flex" v-if="pageflag">
            <li class="user_Overview-item" style="color: #00fdfa">
                <div class="user_Overview_nums allnum ">
                    <dv-digital-flop :config="config" style="width:100%;height:100%;" />
                </div>
                <p>待发货</p>
            </li>
            <li class="user_Overview-item" style="color: #07f7a8">
                <div class="user_Overview_nums online">
                    <dv-digital-flop :config="onlineconfig" style="width:100%;height:100%;" />
                </div>
                <p>已发货</p>
            </li>
            <li class="user_Overview-item" style="color: #e3b337">
                <div class="user_Overview_nums offline">
                    <dv-digital-flop :config="offlineconfig" style="width:100%;height:100%;" />
                </div>
                <p>已完成</p>
            </li>
            <li class="user_Overview-item" style="color: #f5023d">
                <div class="user_Overview_nums laramnum">
                    <dv-digital-flop :config="laramnumconfig" style="width:100%;height:100%;" />
                </div>
                <p>区域代理</p>
            </li>
        </ul>
        <Reacquire v-else @onclick="getData" line-height="200px">
            重新获取
        </Reacquire>
        <div class='list-div'>
            <QuyuList :dataList='quyudataList' />
        </div>
    </div>
</template>

<script>
import { currentGET } from 'api/modules'
import QuyuList from './quyulist.vue'
let style = {
    fontSize: 24
}
export default {
    components:{
        QuyuList
    },
    data() {
        return {
            options: {},
            userOverview: {
                alarmNum: 0,
                offlineNum: 0,
                onlineNum: 0,
                totalNum: 0,
            },
            pageflag: true,
            timer: null,
            config: {
                number: [100],
                content: '{nt}',
                style: {
                    ...style,
                    // stroke: "#00fdfa",
                    fill: "#00fdfa",
                },
            },
            onlineconfig: {
                number: [0],
                content: '{nt}',
                style: {
                    ...style,
                    // stroke: "#07f7a8",
                    fill: "#07f7a8",
                },
            },
            offlineconfig: {
                number: [0],
                content: '{nt}',
                style: {
                    ...style,
                    // stroke: "#e3b337",
                    fill: "#e3b337",
                },
            },
            laramnumconfig: {
                number: [0],
                content: '{nt}',
                style: {
                    ...style,
                    // stroke: "#f5023d",
                    fill: "#f5023d",
                },
            },
            quyudataList:""
        };
    },
    filters: {
        numsFilter(msg) {
            return msg || 0;
        },
    },
    created() {
        this.getData()
    },
    mounted() {
    },
    beforeDestroy() {
        this.clearData()

    },
    methods: {
        clearData() {
            if (this.timer) {
                clearInterval(this.timer)
                this.timer = null
            }
        },
        getData() {
            this.pageflag = true;
            currentGET("getData").then((res) => {
                if (!this.timer) {
                    
                }
                if (res.status) { 
                    this.quyudataList = res.data.quyudaili.dialiarea;
                    this.userOverview = res.data;
                    this.onlineconfig = {
                        ...this.onlineconfig,
                        number: [res.data.ordernum.yifahuo]
                    }
                    this.config = {
                        ...this.config,
                        number: [res.data.ordernum.daifahuo]
                    }
                    this.offlineconfig = {
                        ...this.offlineconfig,
                        number: [res.data.ordernum.yiwancheng]
                    }
                    this.laramnumconfig = {
                        ...this.laramnumconfig,
                        number: [res.data.quyudaili.dalinum]
                    }
                    this.switper()
                } else {
                    this.pageflag = false;
                    this.$Message.warning(res.msg);
                }
            });
        },
        //轮询
        switper() {
            if (this.timer) {
                return
            }
            let looper = (a) => {
                this.getData()
            };
            this.timer = setInterval(looper, this.$store.state.setting.echartsAutoTime);
        },
    },
};
</script>
<style lang='scss' scoped>
.content-div{
    width:100%;
    display:flex;
    justify-content:space-between;
    .list-div{
        width:35%;
        height:220px;
        margin-top:15px;
        overflow:hidden;
    }
}
.user_Overview {
    li {
        flex: 1;

        p {
            text-align: center;
            height: 16px;
            font-size: 16px;
        }

        .user_Overview_nums {
            width: 110px;
            height: 110px;
            text-align: center;
            line-height: 110px;
            font-size: 30px;
            margin: 50px auto 30px;
            background-size: cover;
            background-position: center center;
            position: relative;
            &::before {
                content: '';
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
            }

            &.bgdonghua::before {
                animation: rotating 14s linear infinite;
            }
        }

        .allnum {

            // background-image: url("../../assets/img/left_top_lan.png");
            &::before {
                background-image: url("../../assets/img/left_top_lan.png");
                background-position:center center;
                background-size:cover;
            }
        }

        .online {
            &::before {
                background-image: url("../../assets/img/left_top_lv.png");
                background-position:center center;
                background-size:cover;
            }
        }

        .offline {
            &::before {
                background-image: url("../../assets/img/left_top_huang.png");
                background-position:center center;
                background-size:cover;
            }
        }

        .laramnum {
            &::before {
                background-image: url("../../assets/img/left_top_hong.png");
                background-position:center center;
                background-size:cover;
            }
        }
    }
}
</style>