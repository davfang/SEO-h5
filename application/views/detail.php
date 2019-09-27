<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <title><?= $detail['view_title']?></title>
    <meta name="description" content="<?= $detail['view_title']?>" />
    <meta name="keywords" content="<?= $detail['view_title']?>" />
    <link rel="stylesheet" href="./static/css/style.css">
    <script src="./static/assets/jquery.min.js"></script>
    <script src="./static/assets/flexible.debug.js"></script>
    <script src="./static/assets/iconfont/iconfont.js"></script>
    <script src="./static/assets/util.js"></script>
    <!-- <script src="https://cdn.staticfile.org/vue/2.2.2/vue.min.js"></script>  -->
</head>

<body>
    <div class="body-layout" style="width: 100%" id="app">
        <div>
            <header class="top-header">
                <a href="<?= site_url()?>" onclick="" class="header-left"></a>
                <article class="header-middle">观点详情</article>
            </header>
        </div>
        <!-- 详情 -->
        <div class="vf-detail" style="margin-top:66px;">
            <div class="vf-detail_container">
                <!-- 头部内容 -->
                <div class="vf-detail_container__header">
                    <h1 class="title" style="-webkit-box-orient:vertical;" id="view_title"><?= $detail['view_title']?></h1>
                    <div class="header-info">
                        <div class="dvhead">
                            <img src='<?= $detail['author_avatar']?>'/>
                        </div>
                        <div class="header-info_text">
                            <span id="author_name">
                                <?= $detail['author_name']?>
                            </span>
                            <span id="publish_time"><?= $detail['publish_time']; ?></span>
                        </div>
                        
                    </div>
                </div>
                <!-- 文章内容 -->
                <div class="vf-detail_container__main" ref="viewContent" id="viewContent">
                    <?= $detail['view_content']?>
                </div>
            </div>
        </div>
        <!-- 新增浮动按钮 -->
        <a href="<?=site_url() ?>" onclick="" class="floatBtnToHome">
            <img src="./static/images/icon_tohome_btn.png">
        </a>

        <!-- 正在努力加载中 -->
        <!-- <div class="loadingContainer">
            <div class="loader">
                <img src="./images/c-loading.svg">
                <div class="msgText">正在努力加载中</div>
            </div>
        </div> -->

        <!--登录弹窗-->
        <!-- <div class="loginboxWrap" v-show="loginWrapState">
            <div class="loginbox">
                请先登录
            </div>
        </div> -->
    </div>
    <script>
        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https') {
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else {
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    </script>
</body>

</html>