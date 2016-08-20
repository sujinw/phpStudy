<?php
// 开启SESSION
session_start();

// 引入文件
include_once('config.php');
include_once('dbconnect.php');
include_once('function.php');

// 退出
$data = [];
if ( isset( $_POST['username'] ) && isset( $_SESSION['username'] ) ) {
	if ( $_POST['username'] == $_SESSION['username'] ) {
		$sql = 'UPDATE mb_admin_user SET lastip = "' . getOnlineIp() . '" WHERE username = "' . $_POST['username'] . '"';
		unset( $_SESSION['username'] );
		mysql_query( $sql );
		mysql_close();
		$data['msg']   = '成功退出';
		$data['state'] = 1;
	} else {
		$data['msg']   = '参数错误';
		$data['state'] = 0;
	}
} else {
	$data['msg']   = '非法操作';
	$data['state'] = 0;
}

// 返回json格式数据
echo json_encode( $data );
?>