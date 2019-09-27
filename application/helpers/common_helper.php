<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function random_str($len = 8) {
    return substr(str_shuffle(str_repeat('abcdefghijkmnpqrstuvwxyz23456789',$len)),0,$len);
}
function is_client() {
    return strpos($_SERVER['HTTP_USER_AGENT'], 'Peiyu100') !== false;
}

function aesEncrypt($str, $key) {
    $block = mcrypt_get_block_size('rijndael_128', 'ecb');
    $pad = $block - (strlen($str) % $block);
    $str .= str_repeat(chr($pad), $pad);
    return bin2hex(mcrypt_encrypt(
        MCRYPT_RIJNDAEL_128,
        $key,
        $str,
        MCRYPT_MODE_ECB
    ));
}

function aesDecrypt($str, $key) {
    $str = hex2bin($str);
    $str = mcrypt_decrypt(
        MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB
    );
    $len = strlen($str);
    $pad = ord($str[$len-1]);
    return substr($str, 0, strlen($str) - $pad);
}
function gb_to_utf8($str){
	return iconv("GBK","UTF-8",$str);
}
function test1123(){
    return 123;
}
//读取用户地址
function unicode($str){
	return iconv("GBK","UTF-8",$str);
}

function uncode($str){
	return iconv("UTF-8","GBK",$str);
}

function utf8_to_gb($str){
	return iconv("UTF-8","GBK",$str);
}

/**
 * UTF-8编码 GBK编码相互转换/（支持数组）
 *
 * @param array $str   字符串，支持数组传递
 * @param string $in_charset 原字符串编码
 * @param string $out_charset 输出的字符串编码
 * @return array
 */
function array_iconv($str, $in_charset="gbk", $out_charset="utf-8"){
	if(is_array($str)){
		foreach($str as $k => $v){
			$str[$k] = array_iconv($v);
		}
		return $str;
	}else{
		if(is_string($str)){
		// return iconv('UTF-8', 'GBK//IGNORE', $str);
			return mb_convert_encoding($str, $out_charset, $in_charset);
		}else{
			return $str;
		}
	}
}

function loadAddress($i,$name,$address,$tel,$shour){
	$str = '';
	$str .= '<li>'.PHP_EOL;
	$str .= '	<div class="fl title">'.PHP_EOL;
	$str .= '		<p class="fl num">'.substr(strval($i+100),1,2).'</p>'.PHP_EOL;
	$str .= '		<div class="fl xdczz">'.PHP_EOL;
	$str .= '			<p class="net-name">'.$name.'</p>'.PHP_EOL;
	$str .= '			<p class="cont">'.$address.'</p>'.PHP_EOL;
	$str .= '		</div>'.PHP_EOL;
	$str .= '		<div class="clr"></div>'.PHP_EOL;
	$str .= '	</div>'.PHP_EOL;
	$str .= '	<div class="fl time">'.PHP_EOL;
	$str .= '		<p>营业时间</p>'.PHP_EOL;
	$str .= '		<p>'.$shour.'</p>'.PHP_EOL;
//	$str .= '		<p>8:30-17:30 </p>'.PHP_EOL;
	$str .= '	</div>'.PHP_EOL;
	$str .= '	<div class="fl telphone">'.PHP_EOL;
	$str .= '		<p>电话</p>'.PHP_EOL;
	$str .= '		<p>'.$tel.'</p>'.PHP_EOL;
	$str .= '	</div>'.PHP_EOL;
	$str .= '	<div class="fl leixing">'.PHP_EOL;
//	$str .= '		<div class="fl leixing-l">'.PHP_EOL;
//	$str .= '			<p>支持机型：</p>'.PHP_EOL;
//	$str .= '			<p>打印机、多功能一体机,光墨打印机, 投影机</p>'.PHP_EOL;
//	$str .= '		</div>'.PHP_EOL;
	$str .= '		<p class="fr leixing-r">发送地址到手机</p>'.PHP_EOL;
	$str .= '	</div>'.PHP_EOL;
	$str .= '	<div class="clr"></div>'.PHP_EOL;
	$str .= '</li>'.PHP_EOL;
	return $str;
}

function viewAddress($i,$name,$address,$tel,$shour){
$number = substr(strval($i+100),1,2);
echo <<<Eof
	<li>
	<div class="fl title">
		<p class="fl num">{$number}</p>
		<div class="fl xdczz">
			<p class="net-name">{$name}</p>
			<p class="cont">{$address}</p>
		</div>
		<div class="clr"></div>
	</div>
	<div class="fl time">
		<p>营业时间</p>
		<p>{$shour}</p>
	</div>
	<div class="fl telphone">
		<p>电话</p>
		<p>{$tel}</p>
	</div>
	<div class="fl leixing">
		<p class="fr leixing-r">发送地址到手机</p>
	</div>
	<div class="clr"></div>
	</li>
Eof;
}

function trimAll($str){
	$str = trim(str_replace(' ', '', $str));
	return $str;
}
//function loadAddress($db,$userID){
//	$results = $db->get_results("SELECT * FROM address_list where customerID = ".$userID." order by id desc");
//	if(is_array($results)){
//		foreach($results as $art) {
//			if(($art->city == "市辖区") || ($art->city == "市辖县")){
//				$addr = $art->province.$art->area.$art->detail;
//			}
//			else{
//				$addr = $art->province.$art->city.$art->area.$art->detail;
//			}
//			$str .=  '<li class="uyes-my-detailmain uyes-myinfo-address-li" data-idx="'.$art->id.'" data-province="'.$art->province.'" data-city="'.$art->city.'" data-area="'.$art->area.'" data-detail="'.$art->detail.'">';
//			/*$str .=  '<span class="seleted-tips"></span>';*/
//			$str .=  '<p>';
//			$str .=  '	<span>'.$art->contactor.'</span>';
//			$str .=  '	<span>'.$art->mobile.'</span>';
//			$str .=  '	<br><span>'.$addr.'</span>';
//			$str .=  '</p>';
//			$str .=  '<em class="editor"><img src="/serve/images/icon_my_07.png"></em>';
//			$str .=  '<em class="delete"><img src="/serve/images/icon_my_08.png"></em>';
//			$str .=  '</li>';
//		}
//	}
//	echo $str;
//}
//服务订单拉取
function job_list($tb,$mobile,$db){
    $url = 'http://mzkf.jsmz.com.cn/api/job/wx/'.$tb.'?t=101010';
    //$url = 'http://mzkftest.jsmz.com.cn/api/job/wx/'.$tb.'?t=101010';
	$post_data = '{"net_type":"Wifi","osid":"Android","version":"1.0.0","api_key":"1","api_secret":"1","page_index":"1","page_size":"200","phone_number":"'.$mobile.'"}';  //order_status:不填为全部状态
    $res = request_post($url, $post_data);
    //$record_count = 0;
    $rs = json_decode($res,true);
    //$record_count = $rs['record_count'];
    $record_count = !empty($rs['record_count']) ? $rs['record_count'] : 0;
	if(!empty($record_count)){
	    $datas = get_object_vars(json_decode($res));
	    $jobs = $datas['jobs'];
	    //$db->query("delete from jobdic_list where customer_phone = '$mobiletest'");
	    foreach($jobs as $obj){
	    	//$record_count++;
	    	$order_id = $obj->order_id;
	    	$dis_code = $obj->dis_code;
	    	$order_status = $obj->order_status;
	    	$cus_name = $obj->cus_name;
	    	$cus_tel = $obj->cus_tel;
	    	$install_address = $obj->install_address;
	    	$product_name = $obj->product_name;
	    	$agent_name = $obj->agent_name;
	    	$agent_dot_name = $obj->agent_dot_name;
	    	$install_date = $obj->install_date;
	    	$install_time = $obj->install_time =='' ? 0 : $obj->install_time;
	    	$service_date = $obj->service_date;
	    	$service_time = $obj->service_time =='' ? 0 : $obj->service_time;
	    	$charges = $obj->charges =='' ? 0 : $obj->charges;
	    	$remarks = $obj->remarks;
	    	$remove_address = $obj->remove_address;
	    	$remove_type = $obj->remove_type =='' ? 0 : $obj->remove_type;
	    	$is_guarantee = $obj->is_guarantee =='' ? 0 : $obj->is_guarantee;
	    	$fault_type_name = $obj->fault_type_name;
	    	$is_deliver = $obj->is_deliver =='' ? 0 : $obj->is_deliver;
	    	$worker_name = '';
	    	$worker_tel = '';
	    	foreach($obj->workerList as $obw){
		    	$worker_name = $obw->worker_name<>'' ? $obw->worker_name : '';
		    	$worker_tel = $obw->worker_tel<>'' ? $obw->worker_tel : '';
		    }
			$records = $db->get_var("SELECT count(*) FROM $tb where order_id = '$order_id'");
			if($records > 0){
				$db->query("update $tb set dis_code='$dis_code', order_status=$order_status, cus_name='$cus_name',
			    	cus_tel='$cus_tel', install_address='$install_address', product_name='$product_name', agent_name='$agent_name', agent_dot_name='$agent_dot_name', 
			    	install_date='$install_date', install_time=$install_time, service_date='$service_date', service_time=$service_time, charges=$charges,
			    	remarks='$remarks', remove_address='$remove_address', remove_type=$remove_type, is_guarantee=$is_guarantee, fault_type_name='$fault_type_name',
			    	is_deliver=$is_deliver, worker_name='$worker_name', worker_tel='$worker_tel' where order_id = '$order_id'");
			}
			else{
			   	$sign = substr($order_id,0,2);
			   	$db->query("insert into $tb set order_id='$order_id', order_sign='$sign', dis_code='$dis_code', order_status=$order_status, cus_name='$cus_name',
			    	cus_tel='$cus_tel', install_address='$install_address', product_name='$product_name', agent_name='$agent_name', agent_dot_name='$agent_dot_name', 
			    	install_date='$install_date', install_time=$install_time, service_date='$service_date', service_time=$service_time, charges=$charges,
			    	remarks='$remarks', remove_address='$remove_address', remove_type=$remove_type, is_guarantee=$is_guarantee, fault_type_name='$fault_type_name',
			    	is_deliver=$is_deliver, worker_name='$worker_name', worker_tel='$worker_tel'");
			}
	    }
	}
    //return $record_count;
}

////配送单拉取
//function dic_list($mobile,$db){
//    $mobiletest = '13771737571';
//    $url = 'http://mzkf.jsmz.com.cn/api/job/wx/jobdic_list?t=101010';
//    //$url = 'http://mzkftest.jsmz.com.cn/api/job/wx/jobdic_list?t=101010';
//	$post_data = '{"net_type":"Wifi","osid":"Android","version":"1.0.0","api_key":"1","api_secret":"1","page_index":"1","page_size":"200","phone_number":"'.$mobiletest.'"}';
//	//$post_data = '{"net_type":"Wifi","osid":"Android","version":"1.0.0","api_key":"1","api_secret":"1","page_index":"1","page_size":"200","phone_number":"'.$mobile.'"}';
//	//$post_data = '{"net_type":"Wifi","osid":"Android","version":"1.0.0","api_key":"1","api_secret":"1","page_index":"1","page_size":"200"}';
//    $res = request_post($url, $post_data);
//    $datas = get_object_vars(json_decode($res));
//    $jobs = $datas['jobs'];
//    //$db->query("truncate table jobdic_list");
//    $db->query("delete from jobdic_list where customer_phone = '$mobiletest'");
//   foreach($jobs as $obj){
//    	$dis_id = $obj->dis_id;
//    	$dic_state = $obj->dic_state;
//    	$dis_address = $obj->dis_address;
//    	$customer_name = $obj->customer_name;
//    	$customer_phone = $obj->customer_phone;
//    	$goods_name = $obj->goods_name;
//    	$visit_time = $obj->visit_time;
//    	$visit_time_type = $obj->visit_time_type;
//    	$worker_name = '';
//    	$worker_tel = '';
//    	foreach($obj->workerList as $obw){
//	    	$worker_name = $obw->worker_name<>'' ? $obw->worker_name : '';
//	    	$worker_tel = $obw->worker_tel<>'' ? $obw->worker_tel : '';
//	    }
//    	$db->query("insert into jobdic_list set dis_id='$dis_id', dic_state=$dic_state,	dis_address='$dis_address', customer_name='$customer_name', customer_phone='$customer_phone', 
//    	goods_name='$goods_name', visit_time='$visit_time', visit_time_type='$visit_time_type', worker_name='$worker_name', worker_tel='$worker_tel'");
//    }
//}

//多媒体下载专用
function getCurl($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);    
	curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$package = curl_exec($ch);
	$httpinfo = curl_getinfo($ch);
	curl_close($ch);
	$media = array_merge(array('mediaBody' => $package), $httpinfo);
	return $media;
}

//下载微信服务器多媒体到主机
//function wxDownImg($access_Token,$media_id) {
//	$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_Token."&media_id=".$media_id;
//	$info = getCurl($url);
//	$types = array('image/bmp'=>'.bmp', 'image/gif'=>'.gif', 'image/jpeg'=>'.jpg', 'image/png'=>'.png');
//	if (isset($types[$info['content_type']])) {
//		$filename = time().rand(100,999).$types[$info['content_type']];  //取得文件格式，重新命名文件
//		$filedir = './uploads/'.date('Y').date('m').'/';
//		$filepath = $filedir.$filename;
//		
//		if(!file_exists($filedir)){
//            mkdir($filedir,0777,true);  //验证上传目录
//        }
//        file_put_contents($filepath,$info['mediaBody']);  //上传文件
//        $uploadfile = substr($filepath,1);
//	} 
//	else {
//		//return false;
//		$uploadfile = "";
//	}
//	return $uploadfile;
//}
	
function randm(){
	return time().substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 11), 1))), 0, 3);
}
	
function jump($url){
	echo '<script>window.location.href="'.$url.'"</script>';
}

function get_referer($url){
	return $url;
}

function regment($openid,$db,$url){
	$records = $db->get_var("SELECT count(*) FROM members where openid <> '' and openid = '".$openid."'");
	if($records<1){
		jump("login.php");
		exit;
	}
}

function getuser($openid,$db){
	$result = $db->get_row("SELECT * FROM members where openid = '".$openid."'");
	if($result){
		$info['userid'] = $result->id;
		$info['mobile'] = $result->tel;
	}
	return $info;
}

function getuserid($openid,$db){
//	if($_COOKIE['userid']<>""){
//		$userid = $_COOKIE['userid'];
//	}
//	else{
		$result = $db->get_row("SELECT * FROM members where openid = '".$openid."'");
		if($result){
			$userid = $result->id;
			$mobile = $result->tel;
			setcookie("userid",$userid, time()+3600,'/');
			setcookie("mobile",$mobile, time()+3600,'/');
		}
//	}
	return $userid;
}

//商品代码换算为单价
function codetoprice($type,$rtype,$code){
	$price = 0;
	if($type=='BY'){
		switch ($code)
		{
		case '1001':
			$price = 68 ;
		case '1002':
			$price = 128;
		default:
			$code=(int)substr($code,0,4);
			$price = $code == '1001' ? 68 : 128;
		}
	}
	if($type=='YC'){
		switch ($code)
		{
		case '0015':
			$price = $rtype == 'remove' ? 60 : 150;
			break;
		case '2030':
			$price = $rtype == 'remove' ? 110 : 280;
			break;
		case '3000':
			$price = $rtype == 'remove' ? 180 : 450;
			break;
		default:
			$code=(int)substr($code,0,8);
			if($code <= 10010106){
				$price = $rtype == 'remove' ? 60 : 150;
			}
			elseif($code <= 10020104){
				$price = $rtype == 'remove' ? 110 : 280;
			}
			else{
				$price = $rtype == 'remove' ? 180 : 450;
			}
		}
	}
	return $price;
}

//****订单显示工人信息******
function worker_info($name,$tel){
	echo '<div class="linear_bg"></div>';
	echo '<details open>';
	echo '	<summary id="more_worker" dataview="1">点击收起工人信息</summary>';
	echo '	<div>';
	echo '		<dl class="clrfix"><dt>姓名：</dt><dd>'.$name.'</dd></dl>';
	echo '		<dl class="clrfix" style="padding:3px 0 6px 0"><dt>电话：</dt><dd><a class="tel" href="tel:'.$tel.'">'.$tel.'</a></dd></dl>';
	echo '	</div>';
	echo '</details>';
}

//****订单显示已评价及打赏******
function eval_info($evaluate,$tip){
	$starr = explode("|",$evaluate);
	$star1 = $starr[0]*20;
	$star2 = $starr[1]*20;
	$star3 = $starr[2]*20;
	echo '<div class="divtxt" id="divtxt" style="display:">';
	echo '	<p>服务态度：<span class="vote-star"><i id="vstar_1" style="width:'.$star1.'%"></i></span></p>';
	echo '	<p>服务水平：<span class="vote-star"><i id="vstar_2" style="width:'.$star2.'%"></i></span></p>';
	echo '	<p>服务速度：<span class="vote-star"><i id="vstar_3" style="width:'.$star3.'%"></i></span></p>';
	echo '	<p>打赏金额：<span id="vtip">'.$tip.'</span>元</p>';
	echo '</div>';
	echo '<div class="linear_bg"></div>';
}

//****订单显示评价及打赏菜单******
function eval_menu($prise){
	echo '<div class="gradecon" id="gradecon" style="display:">';
	echo '	<ul class="rev_pro clearfix">';
	echo '		<div id="Star_1" class="star" stardata="0">服务态度： <span></span></div>';
	echo '		<div id="Star_2" class="star" stardata="0">服务水平： <span></span></div>';
	echo '		<div id="Star_3" class="star" stardata="0">服务速度： <span></span></div>';
	echo '	</ul>';
	echo '</div>';
//	echo '<div id="tipFrame" style="display:">';
//	echo '	<span id="t_tip">小费</span>';
//	echo '	<div id="prise">';
//	$pary = explode("|",$prise);
//	$pcount = count($pary);
//	for($i=0;$i<=$pcount-1;$i++)
//	{
//	echo '		<div class="point">';
//	echo '			<span>'.$pary[$i].'元</span>';
//	echo '			<div class="circle">';
//	echo '				<a class="circle_a2" href="javascript:void(0)" data-tip="'.$pary[$i].'"></a>';
//	echo '			</div>';
//	echo '		</div>';
//	}
//	echo '	</div>';
//	echo '</div>';
	echo '<div class="d_description" id="d_description" style="display:">您来打赏，明珠买单</div>';
}

//****订单显示配送信息******
function jobdic_info($code,$statu,$tel,$dtime){
	echo '<div class="linear_bg"></div>';
	echo '<details>';
	echo '	<summary id="more_dis" dataview="0">点击查看配送信息</summary>';
	echo '	<div>';
	echo '		<dl class="clrfix"><dt>单号：</dt><dd>'.$code.'</dd></dl>';
	echo '		<dl class="clrfix"><dt>状态：</dt><dd>'.$statu.'</dd></dl>';
	echo '		<dl class="clrfix" style="padding:3px 0 6px 0"><dt>电话：</dt><dd><a class="tel" href="tel:'.$tel.'"><span> </span>'.$tel.'</a></dd></dl>';
	echo '		<dl class="clrfix"><dt>上门：</dt><dd>'.$dtime.'</dd></dl>';
	echo '	</div>';
	echo '</details>';
}

//****订单显示服务时间******
function jobtime_info($install,$service){
	if(($install=='') and ($service=='')){
		$sdate = '待定';
	}
	elseif($install<>''){
		$d = substr($install,0,10);
		$t = $install == '1' ? ' 上午' : ' 下午';
		$sdate = $d.$t;
	}
	elseif($service<>''){
		$d = substr($service,0,10);
		$t = $service == '1' ? ' 上午' : ' 下午';
		$sdate = $d.$t;
	}
	return $sdate;
}

//****查询配送单信息******
function getJobdicInfo($code,$db){
	$art = $db->get_row("SELECT * FROM jobdic_list where dis_id = '$code'");
	if($art){
		$jobdic['statu'] = $jobdic_status[$art->dic_state];
		if($art->visit_time<>''){
			$d = substr($art->visit_time,0,10);
			$t = $art->visit_time_type == '1' ? ' 上午' : ' 下午';
			$jobdic['time'] = $d.$t;
		}
	}
	return $jobdic;
}

//****格式化地址******
function linkaddr($province,$city,$area,$detail){
	if(($city == "市辖区") || ($city == "市辖县")){
		$city = '';
	}
	return $province.$city.$area.$detail;
}

function orderstatus($status) {
	switch($status){
		case 0:  $txt = "待付款";  break; 
		case 1:  $txt = "已付款";  break;
		case 2:  $txt = "已完成";  break;
		case -1:  $txt = "已取消";  break;
		default:
	}
	return $txt;
}


//********以下无效***************

function wx_session($openid,$db){
//	if((!$_SESSION['userid'])||(!$_SESSION['mobile'])){
		$member = $db->get_row("SELECT * FROM customer_t where openid = '".$openid."'");
		if($member){
			$_SESSION["userid"] = $member->id;
			$_SESSION["mobile"] = $member->tel;
			//echo "1";
		}
		//else{ echo "2"; }
//	}
	//else{ echo $_SESSION['mobile']; }
}



function ordermold($mold) {
	switch($mold){
		case "delivery":  $moldtxt = "配送";  break; 
		case "install":  $moldtxt = "安装";  break;
		case "repair":  $moldtxt = "维修";  break;
		case "mainten":  $moldtxt = "保养";  break;
		case "move":  $moldtxt = "移拆";  break;
		default:
	}
	return $moldtxt;
}

//function orderstatus($status) {
//	switch($status){
//		case 0:  $txt = "待处理";  break; 
//		case 1:  $txt = "派单中";  break;
//		case 2:  $txt = "已签到";  break;
//		case 3:  $txt = "已完成";  break;
//		case -1:  $txt = "未完成";  break;
//		//case 5:  $txt = "已评价";  break;
//		//case 6:  $txt = "维权中";  break;
//		default:
//	}
//	return $txt;
//}

function wxOrderStatus($status) {
	switch($status){
		case 0:  $txt = "预约中";  break; 
		case 1:  $txt = "上门中";  break;
		case 2:  $txt = "已签到";  break;
		case 3:  $txt = "已完成";  break;
		//case -1:  $txt = "未完成";  break;
		//case 5:  $txt = "已评价";  break;
		//case 6:  $txt = "维权中";  break;
		default:
	}
	return $txt;
}

function protectStatus($status) {
	switch($status){
		case 0:  $txt = "待处理";  break; 
		case 1:  $txt = "已答复";  break;
		default:
	}
	return $txt;
}

function orderstat($mold,$status) {

}

function pcate($pc) {
	switch ($pc){
		case 1:  $pctxt = "服务类标准";  break; 
		case 2:  $pctxt = "配件类标准";  break;
		case 3:  $pctxt = "材料类标准";  break;
		default:
	}
	return $pctxt;
}

function pcate2($pc) {
	switch ($pc){
		case 1:  $pctxt = "安装服务";  break; 
		case 2:  $pctxt = "维修服务";  break;
		case 3:  $pctxt = "保养服务";  break;
		default:
	}
	return $pctxt;
}

function icate($c) {
	switch ($c){
		case 1:  $pctxt = "维修";  break; 
		case 2:  $pctxt = "保养";  break;
		default:
	}
	return $pctxt;
}

function get_array($arr,$k) {
	switch ($c){
		case 1:  $pctxt = "维修";  break; 
		case 2:  $pctxt = "保养";  break;
		default:
	}
	return $pctxt;
}

function selectcheck($s1,$s2) {	
	if(!isset($s1)){ $s1 = 0; }
	$check = ($s1===$s2)||($s1==$s2) ? " selected " : "";
	return $check;
}

function compare($v1,$v2) {	
	if(!isset($v1)) return false;
	return (($v1===$v2)||($v1==$v2) ? true : false);
}

function radiocheck($s1,$s2) {	
	if(!isset($s1)){ $s1 = 0; }
	$check = ($s1===$s2)||($s1==$s2) ? " checked " : "";
	return $check;
}

/*分页样式*/
function get_pages($page,$pages,$par1) { 
	$lastpage=$page-1;
	$nextpage=$page+1;
	if(!$pages) { $pages = 1; }
	if($pages==1){
	   //echo "<span class=\"disabled\">1</span>";
	}
	if($pages>1){
		for($i=1;$i<=$pages;$i++) {
		   if($page==$i){ echo "<span class=\"current\">".$i."</span>"; }
		   else{ echo "<a href=\"?page=".$i.$par1."\">".$i."</a>"; }
		}
	}
}

/*门店登陆检测*/
function userlogin() { 
  if(!$_SESSION['user']){
    $url = "/mc/login.php";
    echo "<script>window.location.href='$url'</script>";
    exit;
  }
}

/*中心登陆检测*/
function adminlogin() { 
  if(!$_SESSION['adminid']){
    $url = "/admin/login.php";
    echo "<script>window.location.href='$url'</script>";
    exit;
  }
}

/*取得随机数*/
function random($length = 6 , $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}

/*新样式*/
//function job_status($t) {
//	switch($t){
//		case "5":  $v = "待审核";  break; 
//		case "1":  $v = "初始";  break;
//		case "2":  $v = "调度";  break;
//		case "3":  $v = "派工";  break;
//		case "4":  $v = "完工";  break;
//		default:
//	}
//	return $v;
//}

//function dic_status($t) {
//	switch($t){
//		case "-1":  $v = "待审核";  break; 
//		case "0":  $v = "初始";  break;
//		case "1":  $v = "调度";  break;
//		case "2":  $v = "派工";  break;
//		case "3":  $v = "完工";  break;
//		default:
//	}
//	return $v;
//}

//function job_type($t) {
//	switch($t){
//		case "jobins_list":  $v = "安装单";  break; 
//		case "jobrem_list":  $v = "移拆单";  break;
//		case "jobrep_list":  $v = "维修单";  break;
//		case "jobmai_list":  $v = "保养单";  break;
//		case "jobdic_list":  $v = "配送单";  break;
//		case "purchase_list":  $v = "购买记录";  break;
//		default:
//	}
//	return $v;
//}

//function job_type_view($t) {
//	switch($t){
//		case "ins":  $v = "安装单";  break; 
//		case "rem":  $v = "移拆单";  break;
//		case "rep":  $v = "维修单";  break;
//		case "mai":  $v = "保养单";  break;
//		case "dic":  $v = "配送单";  break;
//		case "purchase":  $v = "购买记录";  break;
//		default:
//	}
//	return $v;
//}

//function job_sign($sign) {
//	switch($sign){
//		case "AZ":  $v = "安装服务";  break; 
//		case "YC":  $v = "移拆服务";  break;
//		case "WX":  $v = "维修服务";  break;
//		case "BY":  $v = "保养服务";  break;
//	}
//	return $v;
//}

function order_state($t) {
	switch($t){
		case "-1":  $v = "已取消";  break; 
		case "0":  $v = "未完成";  break;
		case "1":  $v = "已完成";  break;
		default:
	}
	return $v;
}

function job_time($t) {
	switch($t){
		case "1":  $v = "上午";  break; 
		case "2":  $v = "下午";  break;
		default:
	}
	return $v;
}

function request_post($url = '', $post_data = '') {
    if (empty($url) || empty($post_data)) {
        return false;
    }
    $postUrl = $url;
    $curlPost = $post_data;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    return $data;
}

function https_post($url, $data = null){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}

function https_request($url, $data = null){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$output = curl_exec($curl);
	curl_close($curl);
	$jsoninfo = json_decode($output,true);
	return $jsoninfo;
}


function json_request($url, $data = NULL, $json = false)

{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	if (!empty($data)) {
		if($json && is_array($data)){
			$data = json_encode( $data );
		}
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		if($json){ //发送JSON数据
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				'Content-Type: application/json; charset=utf-8',
				'Content-Length:' . strlen($data))
			);
		}
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$res = curl_exec($curl);
	$errorno = curl_errno($curl);
 
	if ($errorno){
		return array('errorno' => false, 'errmsg' => $errorno);
	}
	curl_close($curl);
	return json_decode($res, true);
 }

/**
 * 将含有GBK的中文数组转为utf-8
 *
 * @param array  $arr          数组
 * @param string $in_charset   原字符串编码
 * @param string $out_charset  输出的字符串编码
 * @return array
 */
//function array_iconv($arr, $in_charset="utf-8", $out_charset="gbk")
//{
//  $ret = eval('return '.iconv($in_charset,$out_charset,var_export($arr,true).';'));
//  return $ret;
//  // 这里转码之后可以输出json
//  //  return json_encode($ret);
//}
/*
 * 将对象转为数组
 */
function obj_to_arr($data){
    if(empty($data)){
        return array();
    }
    if(!is_object($data) && !is_array($data)) {  
        return $data;  
    }  
    return array_map('obj_to_arr', (array) $data);
}
/*
 *判断url是否是站内链接
 */
function is_onsite($url){
    if(empty($url)){
        return false;
    }
    if(preg_match('#^http://([a-z0-9])+\.lenovoimage\.com#i',$url)){
        return true;
    }
    return false;
    
}
function getCondInfo($info,$arr){
    $data = array();
    foreach($arr as $val){
        foreach($val['child'] as $k=>$v){
            if($v['Value'] == $info){
                $data['RecID'] = $val['RecID'];
                $data['SRecID'] = $v['RecID'];
                $data['Value'] = $v['Value'];
            }
        }
    }
    return $data;
}
function getimagewidthheight($filename){
    $fileinfo = getimagesize($filename);
    if($fileinfo){
        return $fileinfo[0];
    }
    return 0;
}
function msubstr($str,$start = 0,$length,$charset = 'utf-8',$suffix = true){
    $str = '';
    if (function_exists("mb_substr")) {
        $string = mb_substr($str, $start, $length, $charset);
    } else if (function_exists("iconv_substr")) {
        $string = iconv_substr($str, $start, $length, $charset);
    } else {
        $re["utf-8"] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re["gb2312"] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re["gbk"] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re["big5"] = "/[x01-x7f]|[x81-xfe]（[x40-x7e]|xa1-xfe]）/";

        preg_match_all($re[$charset], $str, $match);
        $string = join("", array_slice($match[0], $start, $length));
    }
	
    if ($suffix) {
        preg_match_all("/./us", $str, $matchs);
		$match_length = count($matchs[0]);
		if ($match_length > $length) {
            $string .= '...';
        }
    }

    return $string;
}
function mergeProductSpec($par_list,$par_val_list){
    $data = array();
    foreach($par_list as $key=>$val){
        $val['child'] = array();
        foreach($par_val_list as $vk=>$vv){
            if($vv['SpecGroupID'] == $val['SpecGroupID']){
                $val['child'][] = $vv;
            }
        }
        $data[] = $val;
    }
    return $data;
    
}
/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */