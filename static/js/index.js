"use strict";var icpShowState=!1,url=window.location.href,header=[],indexCh=0,list={},finishedCatagory={},firstload={},lastIndex={},scrolltopPosition={},bottomTestList=[],bottomText="",sw=!0,showNoDataIcon=!1,last_id=0,mcShow=!1;function jqExecIcp(){icpShowState?$(".icpWrap").show():$(".icpWrap").hide()}function jqExecNoDataIcon(){showNoDataIcon?($(".index-view_list").hide(),$(".vf-no-news").show()):($(".index-view_list").show(),$(".vf-no-news").hide())}function jqExecHeader(){var e="";header.forEach(function(t){e+='<li onclick="clickHeader('+t.category_id+')">',t.category_id==indexCh?e+='<a class="active" href="javascript:void(0);">'+t.category_name+"</a>":e+='<a  class="" href="javascript:void(0);">'+t.category_name+"</a>",e+="</li >"}),$(".header-list").children("ul").html(e)}function jqExecListData(){var s="";list[indexCh].forEach(function(t,e){if(!t.isAD)if(t.img_list.length<3){var i="";t.img_list&&0<t.img_list.length&&(i='<div class="news-img border">\n                                                <img src="'+t.img_list[0].url+'" alt="">\n                                             </div>');var a="";e==list[indexCh].length-1?a+='<article class="vf-news-list_con vf-news-list_con-LR" >':a+='<article class="vf-news-list_con vf-news-list_con-LR border-bottom">',a+='<a href="./detail.html?articleid='+t.view_id+'">\n                                            <div class="news-info">\n                                                <h3 class="title">'+t.view_title+'</h3>\n                                                <div class="title-tips">\n                                                    <span class="news-scour">'+t.author_name+'</span>\n                                                    <span class="pubtime">阅读 '+t.view_sum+'</span>\n                                                    <span class="pubtime">'+t.publish_time_fmt+"</span>\n                                                </div>\n                                            </div>\n                                            "+i+"\n                                        </a> \n                                  </article>",s+=a}else{var n="";e==list[indexCh].length-1?n+='<article class="vf-news-list_con vf-news-list_con-three" >':n+='<article class="vf-news-list_con vf-news-list_con-three border-bottom">',n+='<a href="./detail.html?articleid='+t.view_id+'">\n                  <h3 class="title">'+t.view_title+'</h3>\n                  <div class="news-info">',e<3&&t.img_list.forEach(function(t){n+='<div class="news-img border">\n                            <img src="'+t.url+'?x-oss-process=image/resize,m_fill,h_144,w_226,limit_0" alt="">\n                        </div>'}),n+='</div>\n                  <div class="title-tips">\n                    <span class="news-scour">'+t.author_name+'</span> \n                    <span class="reply">阅读 '+t.view_sum+"</span>",t.dateShow&&(n+='<span class="pubtime"  >'+t.publish_time_fmt+"</span>"),s+=n+="</div>\n                </a>\n              </article>"}}),$("#articlewrap").html(s)}function jqBottomText(){var t="";mcShow&&0<bottomText.length?t+='<div class="vf-bottom-tps_line" style="display:\'block\'">\n        <span>'+bottomText+"</span>\n      </div>":t+='<div class="vf-bottom-tps_line" style="display:\'none\'">\n        <span>'+bottomText+"</span>\n      </div>",$(".vf-bottom-tps").html(t)}function ajaxHeader(){util.ajaxGet("/api/view/category").then(function(t){header=t.data;for(var e={},i=0==bottomTestList.length,a=0;a<t.data.length;a++)e[t.data[a].category_id]=[],i&&(bottomTestList[t.data[a].category_id]=""),lastIndex[t.data[a].category_id]=0,firstload[t.data[a].category_id]=!0,finishedCatagory[t.data[a].category_id]=!1,scrolltopPosition[t.data[a].category_id]=0;e=e;var n=t.data.find(function(t){return t.category_id==header[0].category_id});clickHeader(header[0].category_id,n)})}function clickHeader(t){document.documentElement.scrollTop=0,mcShow=icpShowState=!1,lastIndex[indexCh=t]=0,showNoDataIcon=!1,finishedCatagory[t]=!1,jqExecIcp(),jqExecNoDataIcon(),jqExecHeader(),ajaxList(t)}function ajaxList(a){return new Promise(function(i,t){if(bottomText=bottomTestList[a]||"",1==finishedCatagory[a])return!1;last_id=lastIndex[a]||0,util.ajaxGet("/api/view/category/list?category_id="+a+"&last_id="+last_id+"&platform=1").then(function(t){if(sw=!0,0==t.data.length&&0==last_id)return showNoDataIcon=!0,void jqExecNoDataIcon();if("1"==t.code&&t.data){if(0<t.data.length){var e=t.data.length-1;lastIndex[a]=t.data[e].view_id||t.data[e-1].view_id||0,t.data.map(function(t){t.publish_time&&(t.publish_time_fmt=util.formatDate(t.publish_time),t.author_name.length<6&&1e3<t.view_sum&&-1!=t.publish_time_fmt.indexOf("201")||6<t.author_name.length&&-1!=t.publish_time_fmt.indexOf("201")?t.dateShow=!1:t.dateShow=!0)}),0==last_id?(list[a]=t.data,icpShowState=!0,jqExecIcp()):list[a]=list[a].concat(t.data),jqExecListData()}t.data.length<10||10==t.data.length&&list[a].length==t.count?(finishedCatagory[a]=!0,bottomTestList[a]=0==last_id?"":(mcShow=!1,"您太勤奋了，没有更多了")):bottomTestList[a]="加载中",mcShow||(mcShow=!0,bottomText=bottomTestList[a]),jqBottomText(),i(t.data)}})})}function onScrollPull(){if(document.querySelector(".vf-news")){var t=document.querySelector(".vf-news").clientHeight,e=document.documentElement.scrollTop||document.body.scrollTop;t<=(scrolltopPosition[indexCh]=e)+document.documentElement.clientHeight+60&&1==sw&&0==finishedCatagory[indexCh]&&(sw=!1,ajaxList(indexCh))}}function routeAD(t,e,i,a){}$(function(){window.addEventListener("scroll",onScrollPull),$(".searchbox").click(function(){window.open(util.vars.domain+"pages/Search","_self")}),ajaxHeader()});