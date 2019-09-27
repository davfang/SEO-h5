<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <title>V房_买房专业指导_一对一买房建议_房产知识平台_房源分析(北京V房网)</title>
    <meta name="description"
        content="北京V房是提供北京二手房买卖、北京新房、北京房价查询等业务的专业房产网站，可为您买卖北京二手房提供房价走势分析、买房策略分析、片区咨询、学区咨询、小区及新盘推荐，房源硬伤分析及预警、免费看房团、砍价指导等专业服务。饭总选房，京房字等知名房产大V联合推荐！" />
    <meta name="keywords" content="二手房,二手房网,北京二手房网,北京房地产,北京房产信息" />
    <link rel="stylesheet" href="./static/css/search.css">
    <script src="https://cdn.staticfile.org/vue/2.2.2/vue.min.js"></script>
    <script src="./static/assets/jquery.min.js"></script>
    <script src="./static/assets/flexible.debug.js"></script>
    <script src="./static/assets/iconfont/iconfont.js"></script>
    <script src="./static/assets/util.js"></script>
    <style type="text/css">
        [v-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <div id="app" v-cloak>
        <div class="body-layout searchPage">
            <!-- <div class="searchHeader">
                            V房
                        </div> -->
            <div class="searchWrap">

                <a class="header-left arrownlefticon" href="<?= site_url()?>" onclick=""></a>
                <div class="searchbox clearfix" @click="searchInputFocus">

                    <!-- <svg class="icon searchicon" aria-hidden="true" >
                          <use xlink:href="#icon-search"></use>
                        </svg> -->
                    <img src="./static/assets/images/enlarge.png" alt="" class="searchicon2">
                    <form action="#" onsubmit="return false;"><input type="search" ref="searchinput" class="searchinput"
                            v-model.trim="inputVal" placeholder="" @search="searchArticle()" autofocus></form>

                    <em class="clearicon" v-if="inputClearIconState" @click="clearInputVal"><img
                            src="./static/assets/images/searchkey-clear.png" alt=""></em>
                </div>
                <div class="searchbtn" @click="searchArticle()">
                    搜索
                </div>
            </div>
            <div class="searchConditionWrap" v-if="showType=='conditionPage'">
                <div class="searchHistoryWrap" v-if="historyWordArr.length>0">
                    <div class="title">
                        <div class="left">搜索历史</div>
                        <!-- <van-icon name="delete" class="right deleteicon" @click="removeHistoryword()" /> -->
                        <svg class="icon right clearhistoryicon" aria-hidden="true" @click="removeHistoryword()">
                            <use xlink:href="#icon-trash-2"></use>
                        </svg>
                    </div>
                    <div class="historyList clearfix">
                        <div class="historyItem" v-for="(item,index) in historyWordArr" :key="index"
                            @click="hotSearch(item)">{{item}}</div>
                    </div>
                </div>
                <div class="searchHotWrap" v-if="hotWordArr.length>0">
                    <div class="title">热搜</div>
                    <div class="hotWrap">
                        <div class="hotItem " v-for="(item,index) in hotWordArr" :key="index" @click="hotSearch(item)">
                            {{item}}
                            <i class="hoticon" v-if="index<3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="searchResultWrap" v-if="showType=='articlePage'">
                <div class="articleWrap" v-if="articleTitleList.length>0||articleContentList.length>0">
                    <div class="articletitle">
                        <!-- 包含"{{inputVal}}"的观点 -->
                        {{articlelistTitle}}
                    </div>
                    <div class="vf-news clearMinHeight" ref="colList" v-if="articleTitleList.length!=0">
                        <div class="vf-news-list">
                            <article class="vf-news-list_con border-bottom"
                                :class="[item.avater&&item.avater.length >= 3 ? 'vf-news-list_con-three' : 'vf-news-list_con-LR']"
                                v-for="(item,index) in articleTitleList" :key="index">
                                <a v-if="item.avater&&item.avater.length >= 3" :href="`/detail?id=${item.id}`" target="_blank" >
                                    <h3 class="title" v-html="item.title" style="-webkit-box-orient: vertical;"></h3>
                                    <!-- <div class="news-info">
                                  <div class="news-img border" v-for="(img,index) in item.avater" :key="index" v-if="index<3">
                                    <img :src="img+'?x-oss-process=image/resize,m_fill,h_200,w_200,limit_0'" alt="">
                                  </div>
                                </div> -->
                                    <div class="title-tips">
                                        <span class="small news-scour" @click.stop="goLvd(item.authorId)"><img
                                                src="./static/assets/images/icon-v.png"
                                                v-if="false" />{{item.authorName}}</span>
                                        <!-- <span class="reply">评论{{item.number}}</span> -->
                                        <span class="small pubtime" v-if="item.publishTime">{{item.publishTime}}</span>
                                    </div>
                                </a>

                                <a v-else :href="`/detail?id=${item.id}`">
                                    <div class="news-info news-search-info">
                                        <h3 class="title" v-html="item.title" style="-webkit-box-orient: vertical;">
                                        </h3>
                                        <div class="title-tips">
                                            <span class="small news-scour" @click.stop="goLvd(item.authorId)"><img
                                                    src="./static/assets/images/icon-v.png"
                                                    v-if="false" />{{item.authorName}}</span>
                                            <!-- <span class="reply">评论{{item.number}}</span> -->
                                            <span class="small pubtime"
                                                v-if="item.publishTime">{{item.publishTime}}</span>
                                        </div>
                                    </div>

                                    <!-- <div class="news-img border" v-if="item.avater.length>0">
                                  <img v-for="(img,index) in item.avater" :src="img+'?x-oss-process=image/resize,m_fill,h_200,w_200,limit_0'" alt="" v-show="index<1" :key="index">
                                </div> -->
                                </a>
                            </article>
                        </div>

                    </div>
                    <div class="vf-news clearMinHeight" ref="colList" v-if="articleContentList.length!=0">
                        <div class="vf-news-list">
                            <article class="vf-news-list_con border-bottom vf-news-list_con-LR"
                                v-for="(item,index) in articleContentList" :key="index">
                                <a  :href="`/detail?id=${item.id}`" target="_blank">
                                    <div class="news-info">
                                        <h3 class="title" v-html="item.title" style="-webkit-box-orient: vertical;">
                                        </h3>
                                        <div class="title-content" v-html="item.content">
                                        </div>
                                        <div class="title-tips">
                                            <span class="small news-scour" @click.stop="goLvd(item.authorId)"><img
                                                    src="./static/assets/images/icon-v.png"
                                                    v-if="false" />{{item.authorName}}</span>
                                            <!-- <span class="reply">评论{{item.number}}</span> -->
                                            <span class="small pubtime"
                                                v-if="item.publishTime">{{item.publishTime}}</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>

                    </div>
                </div>


            </div>
            <div class="vf-no-news" v-show="noDataState">
                <img src="./static/assets/images/search-none.png">
                <p>当前搜索,暂无内容</p>
            </div>
            <div class="v-loading" v-show="loadingState">
                <img src="./static/assets/images/c-loading.svg">
                <p>正在努力搜索中</p>
            </div>

        </div>
    </div>
    <script>
        "use strict";
        window.onload = function () {
            new Vue({
                el: '#app',
                data: {
                    url: window.location.href,
                    showType: "conditionPage", //显示类型 articlePage:文章页面; conditionPage 条件页面
                    inputClearIconState: false,
                    inputVal: "",
                    davlistTitle: '', //大v列表标题
                    articlelistTitle: '', //文章列表标题
                    hotWordArr: [],
                    historyWordArr: [],
                    articleTitleList: [], //按文章标题查询出来的列表
                    articleContentList: [], //按文章内容查询出来的列表
                    starTitleList: [], //按大V昵称查询出来的列表
                    starDescList: [], //按大V简介查询出来的列表
                    loadingState: false, //是否显示加载层
                    noDataState: false, //是否显示无数据层
                    isIndexToSearch: false //是否是从首页跳转过来的  
                },
                methods: {
                    hotSearch(key) {
                        this.inputVal = key;
                        this.searchArticle();
                    },
                    //点击搜索框外层 输入框获得焦点
                    searchInputFocus() {
                        this.$refs.searchinput.focus();
                    },
                    removeHistoryword() {
                        localStorage.removeItem("historyWordArr");
                        this.historyWordArr = [];
                    },
                    clearInputVal() {
                        this.inputVal = "";
                        this.inputClearIconState = false;
                        this.showType = "conditionPage";
                        this.articleTitleList = [];
                        this.articleContentList = []
                        this.starTitleList = [];
                        this.starDescList = []
                        this.noDataState = false;
                        this.loadingState = false;
                    },
                    loadSearchHistoryList() {
                        if (
                            localStorage.getItem("historyWordArr") &&
                            localStorage.getItem("historyWordArr").length > 0
                        ) {
                            this.historyWordArr = localStorage.getItem("historyWordArr").split(",");
                        }
                    },
                    searchArticle() {
                        if (this.inputVal == "") {
                            this.$toast("搜索内容不能为空", {
                                duration: "1000"
                            });
                            return;
                        }
                        this.showType = "articlePage";

                        //搜索关键字存在 则删除原来的关键字 把新的关键字加到最前面
                        if (this.historyWordArr.indexOf(this.inputVal) > -1) {
                            this.historyWordArr.splice(
                                this.historyWordArr.indexOf(this.inputVal),
                                1
                            );
                        }
                        this.historyWordArr.unshift(this.inputVal);
                        if (this.historyWordArr.length > 10) {
                            this.historyWordArr.splice(10);
                        }
                        localStorage.setItem("historyWordArr", this.historyWordArr.join(","));
                        // this.inputVal=''
                        //过滤特殊字符  
                        let pattern = new RegExp(
                            "[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？+-]")
                        let rs = "";
                        for (var i = 0; i < this.inputVal.length; i++) {
                            rs = rs + this.inputVal.substr(i, 1).replace(pattern, '');
                        }
                        if (rs.trim() == '') {
                            this.noDataState = true;
                            return false;
                        }
                        // this.inputVal=rs.trim(); 

                        this.loadingState = true;
                        this.noDataState = false;
                        //调用搜索接口
                        util.ajaxPost("/search/articlesearch", {
                                key: this.inputVal
                            })
                            .then(res => {
                                console.log(res.code);
                                
                                if (res.code == 1) {
                                    this.loadingState = false;
                                    this.articleTitleList = res.data.articleTitleList;
                                    this.articleContentList = res.data.articleContentList;
                                    this.starTitleList = res.data.starTitleList;
                                    this.starDescList = res.data.starDescList;

                                    this.davlistTitle = `包含"${this.inputVal}"的大V`;
                                    this.articlelistTitle = `包含"${this.inputVal}"的观点`

                                    let totalNum =
                                        this.starTitleList.length +
                                        this.starDescList.length +
                                        this.articleTitleList.length +
                                        this.articleContentList.length;
                                    if (parseInt(totalNum) > 0) {
                                        this.noDataState = false;

                                        //搜索内容大于0条的话 配置微信分享
                                        let weixinShareTitle =
                                            "我在V房搜到" +
                                            totalNum +
                                            "条包含" +
                                            this.inputVal +
                                            "的信息，快来看看吧";
                                        let weixinShareDesc = "";
                                        if (this.articleTitleList.length > 0) {
                                            weixinShareDesc = this.articleTitleList[0].title.replace(
                                                /<[^>]+>/g, "");
                                        } else {
                                            if (this.articleContentList.length > 0) {
                                                weixinShareDesc = this.articleContentList[0].title
                                                    .replace(/<[^>]+>/g, "");
                                            }
                                        }
                                    } else {
                                        this.noDataState = true;
                                    }
                                } else {
                                    this.noDataState = true;
                                    this.loadingState = false;
                                    console.log(res.msg);
                                }
                            });
                    },
                },
                created: function () {
                    //加载本地存储的搜索历史
                    this.loadSearchHistoryList();
                },
                watch: {
                    inputVal: function (newVal) {
                        if (newVal.length > 0) {
                            this.inputClearIconState = true;
                            if (newVal.length > 10) {
                                this.inputVal = this.inputVal.substr(0, 10);
                            }
                        } else {
                            this.inputClearIconState = false;
                            this.showType = "conditionPage";
                            this.articleTitleList = [];
                            this.articleContentList = []
                            this.starTitleList = [];
                            this.starDescList = []
                        }
                    }
                },
            })
        }
    </script>
</body>

</html>