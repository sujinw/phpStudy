<?php
/**
 * 留言本基础文件
 **/

/**
 * [getOnlineIp 获取用户公网IP地址]
 * @return [String] [用户公网IP地址]
 */
function getOnlineIp() {
	$ch = curl_init('http://city.ip138.com/ip2city.asp');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$a = curl_exec($ch);
	preg_match('/\[(.*)\]/', $a, $ip);
	return @$ip[1];
}
function getIP(){ 
	global $ip; 

	if (getenv("HTTP_CLIENT_IP")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if(getenv("HTTP_X_FORWARDED_FOR")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if(getenv("REMOTE_ADDR")) 
		$ip = getenv("REMOTE_ADDR"); 
	else 
		$ip = "Unknow"; 

return $ip; 
} 

/**
 * [jsNotice 输出js代码提示信息]
 * @param  [String] $msg [提示信息]
 * @param  [String] $url [跳转链接]
 * @return [String] [js代码]
 */
function jsNotice( $msg, $url = 'no' ) {
	if ( $url == 'no' ) {
		echo '<script type="text/javascript"> $(function() { layer.msg("' . $msg . '", {time : 1000}); }); </script>';
	} else {
		echo '<script type="text/javascript"> $(function() { layer.msg("' . $msg . '", {time : 1000}, function() { window.location.href = "' . $url . '"; }); }); </script>';
	}
}
