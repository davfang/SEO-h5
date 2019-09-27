<!DOCTYPE html>
<html>

<head>
  <!-- <script src="https://cdn.bootcss.com/babel-polyfill/7.0.0-rc.4/polyfill.js"></script>  -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>V房，买房指导专家，房产大V_一对一买房建议，房产知识平台</title>
  <meta name="description" content="饭总，京房字，北京拆哪等知名房产大V联合推荐！全国值得信赖的买房指导平台，为买新房、二手房及投资房产的用户提供一对一买房建议或购房咨询" />
  <meta name="keywords" content="V房，V房网，房产大V，饭总选房，北京买房，购房买房，房产资讯，北京房产" />
  <link rel="stylesheet" href="./static/css/style.css">
  <!-- <link rel="stylesheet" href="./static/css/bootstrap.min.css"> -->
  <script src="./static/assets/jquery.min.js"></script>
  <script src="./static/assets/flexible.debug.js"></script>
  <script src="./static/assets/iconfont/iconfont.js"></script>
  <script src="./static/assets/util.js"></script>
</head>

<body>
  <header class="top-header">
    <a href="">
      <article class="header-middle-143">
        <img src="./static/images/nav-logo.png" />
        <a href="<?= site_url('/search')?>">
        <div class="searchbox">
          <img src="./static/images/enlarge.png" alt="" class="searchicon2">
          <label>请输入关键字</label>
        </div>
        </a>
      </article>
    </a>
  </header>
  <div class="header border-bottom">
    <div class="header-list">
      <ul id="activeList">
      <?php if (!empty($menuList)): ?>
		<?php foreach ($menuList as $key => $val): ?>
		  	<li>
				<a class="" data-id="<?= $val['category_id']?>" href="<?= site_url($val['category_id']!=9999?'?category_id='.$val['category_id']:'')?>"><?= $val['category_name']?></a>
			</li>
    <?php endforeach; ?>
    <?php endif; ?>
      </ul>
    </div>
  </div>
  <!-- 文章列表 -->
  <div class="vf-news index-view_list" style="padding-bottom:0;">
	<!--列表项开始-->
    <div class="vf-news-list">
      <ul class="vf-news-list_con vf-news-list_con-LR">
      <?php if (!empty($contentList)): ?>
      <?php foreach ($contentList as $key => $val): ?>
        <li>
          <a href="<?= site_url('/detail?id='.$val['view_id'])?>" target="_blank" name='<?=$val['view_id'] ?>'>
            <div class="news-info">
              <h3 class="title"><?=$val['view_title'] ?></h3>
              <div class="title-tips">
                <span class="news-scour"><?=$val['author_name'] ?></span>
                <span class="pubtime">阅读 <?=$val['view_sum'] ?></span>
              </div>
            </div>
            <div class="news-img border">
              <img alt="<?=$val['author_name'] ?>" src="<?= $val['img_list']['0']['url']?>">
            </div>
          </a>
        </li>
      <?php endforeach; ?>
      <?php endif; ?>
      </ul>
    </div>
    <!--列表项结束-->

    <div style="width: 100%;text-align: center;padding-bottom: 20px;">
      <?= $page;?>
    </div>
    <style>
      .pagination{
        width: 100%;
        font-size: 16px;
      }
      .pagination li{
        display: inline;
      }
      .pagination li.active a{
        color: #23527c;
        background-color:#eee;
        border-color:#ddd;
      }
      .pagination li a{
        display: inline-block;
        padding: 10px;
        border: 1px solid #ddd;
        margin-left: -1px;
        line-height: 1.42857143;
        padding: 6px 12px;
        color:#337ab7;
      }
    </style>
    <footer>
      <div class="icpWrap">
        <div class="icopInner">
          <p>
            CopyRight © 2018 Vfang.All Rights Reserved
          </p>
          <p>
            冀ICP备18017960号-1
          </p>
        </div>
      </div>
    </footer>
    <script>
      function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg); //匹配目标参数
        if (r != null) return unescape(r[2]);
        return null; //返回参数值
      }
      $(function () {
        var activeId = getUrlParam('category_id')?getUrlParam('category_id'):9999;
        $('#activeList li').each(function(){
          if($(this).find('a').attr('data-id') != activeId){
            $(this).find('a').removeClass('active')
          }else{
            $(this).find('a').addClass('active')
          }
        })

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
      })
    </script>
</body>

</html>