<?php 
// 开启SESSION
session_start();

// 引入文件
include_once('config.php');
include_once('dbconnect.php');
include_once('function.php');

// POST请求处理
$data = [];
if ( $_POST ) {
	if ( empty( $_POST ) ) {
		$data['msg']   = '参数错误';
		$data['state'] = 0;
	} else {
		// 数据验证
		if ( !$_POST['id'] ) {
			$data['msg']   = '参数错误';
			$data['state'] = 0;
		} else {
			// 删除留言
			$id  = $_POST['id'];
			$sql = "UPDATE mb_comment_info SET state = -1 WHERE id = {$id}";
			mysql_query( $sql );
			mysql_close();
			$data['msg']   = '删除成功';
			$data['state'] = 1;
		}
	}
} else {
	$data['msg']   = '非法操作';
	$data['state'] = 0;
}

// 返回json格式数据
echo json_encode( $data );
?>