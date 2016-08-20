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
		if ( !$_POST['pid'] ) {
			$data['msg']   = '参数错误';
			$data['state'] = 0;
		} elseif ( !$_POST['title'] ) {
			$data['msg']   = '参数错误';
			$data['state'] = 0;
		} elseif ( $_POST['title'] != '追加' && $_POST['title'] != '回复' ) {
			$data['msg']   = '参数错误';
			$data['state'] = 0;
		} elseif ( !$_POST['who'] ) {
			$data['msg']   = '参数错误';
			$data['state'] = 0;
		} elseif ( !$_POST['name'] ) {
			$data['msg']   = '姓名不能为空';
			$data['state'] = 0;
		} elseif ( strlen( $_POST['name'] ) < 2 or strlen( $_POST['name'] ) > 60 ) {
			$data['msg']   = '姓名应为2-20个字符';
			$data['state'] = 0;
		} elseif ( !$_POST['content'] ) {
			$data['msg']   = $_POST['title'] . '内容不能为空';
			$data['state'] = 0;
		} elseif ( strlen( $_POST['content'] ) > 600 ) {
			$data['msg']   = $_POST['title'] . '内容不能超过200个字';
			$data['state'] = 0;
		} else {
			// 检测游客姓名是否为管理员姓名
			$sqlAdmin 	 = "SELECT username FROM mb_admin_user WHERE username = '{$_POST['name']}'";
			$resultAdmin = mysql_query( $sqlAdmin );
			$rowAdmin	 = mysql_fetch_assoc( $resultAdmin );
			$flagAdmin 	 = false;
			if ( isset( $_SESSION['username'] ) && $_SESSION['username'] == $rowAdmin['username'] ) {
				$flagAdmin = true;
			}

			// 检测id为pid的记录是否正常
			$sqlPid 	 = "SELECT id,state FROM mb_comment_info WHERE id = {$_POST['pid']} AND state > 0";
			$resultPid 	 = mysql_query( $sqlPid );
			$flagPid 	 = false;
			if ( mysql_num_rows( $resultPid ) > 0 ) {
				$flagPid = true;
			}

			// 游客姓名不能与管理员同名
			if ( mysql_num_rows( $resultAdmin ) == 0 or $flagAdmin ) {
				if ( $flagPid ) {
					$pid 	 = $_POST['pid'];
					$author  = $_POST['name'];
					$content = $_POST['content'];
					$ip 	 = getOnlineIp();
					$ctime   = time();
					$state   = 1;
					$who 	 = $_POST['who'];
					$sql 	 = "INSERT INTO mb_reply_info (pid,author,content,ip,ctime,state,who) VALUES ('{$pid}','{$author}','{$content}','{$ip}',{$ctime},{$state},'{$who}')";
					mysql_query( $sql );

					// 记录游客姓名
					if ( !isset( $_SESSION['username'] ) && !isset( $_SESSION['guestname'] ) ) {
						$_SESSION['guestname'] = $author;
					}

					$data['msg']   = $_POST['title'] . '成功';
					$data['state'] = 1;
				} else {
					$data['msg']   = '留言已被删除或禁用';
					$data['state'] = 0;
				}
			} else {
				$data['msg']   = '此姓名已被版主征用';
				$data['state'] = 0;
			}

			// 结束mysql操作
			mysql_free_result( $resultAdmin );
			mysql_free_result( $resultPid );
			mysql_close();
		}
	}
} else {
	$data['msg']   = '非法操作';
	$data['state'] = 0;
}

// 返回json格式数据
echo json_encode( $data );
?>