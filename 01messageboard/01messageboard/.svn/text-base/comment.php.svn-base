<?php 
// 页面基本信息
$site_title 	  = '给我留言';
$site_keywords 	  = '给我留言';
$site_description = '给我留言';
$site 			  = 'comment';

// 引入头文件
include_once('head.php');

// 用户登陆信息判断
$username = [];
$url	  = isset( $_SESSION['url'] ) ? $_SESSION['url'] : '';
if ( isset( $_SESSION['username'] ) ) {
	$username['state'] = 1;
	$username['name']  = $_SESSION['username'];
} elseif ( isset( $_SESSION['guestname'] ) ) {
	$username['state'] = 2;
	$username['name']  = $_SESSION['guestname'];
} else {
	$username['state'] = 0;
	$username['name']  = '';
}

// POST请求处理
if ( $_POST ) {
	if ( empty( $_POST ) ) {
		jsNotice( '非法操作' );
	} else {
		// 数据验证
		if ( !$_POST['name'] ) {
			jsNotice( '请输入姓名' );
		} elseif ( strlen( $_POST['name'] ) < 2 or strlen( $_POST['name'] ) > 60 ) {
			jsNotice( '姓名应为2-20位任意字符' );
		} elseif ( !$_POST['content'] ) {
			jsNotice( '请输入留言内容' );
		} elseif ( strlen( $_POST['content'] ) > 600 ) {
			jsNotice( '留言内容不能超过200个字符' );
		} else {
			$fileFlag = true;
			// 文件上传
			if ( !empty( $_FILES['portrait'] ) ) {
				if ( $_FILES['portrait']['error'] == 0 ) {
					$dir    = 'upload/' . date( 'Ymd' );
					$suffix = getSuffix( $_FILES['portrait']['name'] );
					if ( $suffix != '.jpg' && $suffix != '.gif' && $suffix != '.png' ) {
						$fileFlag = false;
						jsNotice( '仅支持jpg、png、gif图片上传' );
					} else {
						if ( !is_dir( $dir ) ) {
							mkdir( $dir, 0755, true );
						}
						$fileName = $dir . '/' . md5( time() ) . $suffix;
						move_uploaded_file( $_FILES['portrait']['tmp_name'], $fileName );
						$_SESSION['url'] = $fileName;
					}
				} else {
					switch ( $_FILES['portrait']['error'] ) {
						case 1:
						jsNotice( '文件大小超出了服务器的空间大小' );
						break;
						case 2:
						jsNotice( '上传的文件大小超出浏览器限制' );
						break;
						case 3:
						jsNotice( '文件仅部分被上传' );
						break;
						case 4:
						jsNotice( '没有找到要上传的文件' );
						break;
						case 5:
						jsNotice( '服务器临时文件夹丢失' );
						break;
						case 6:
						jsNotice( '文件写入到临时文件夹出错' );
						break;
						default:
						jsNotice( '上传过程中出现未知错误' );
						break;
					}
				}
			}
			if ( $fileFlag ) {
				$sqlAdmin 	 = "SELECT username FROM mb_admin_user WHERE username = '{$_POST['name']}'";
				$resultAdmin = mysql_query( $sqlAdmin );
				if ( mysql_num_rows( $resultAdmin ) == 0 or $username['state'] == 1 ) {
					$ip  	  = getOnlineIp();
					$name 	  = $_POST['name'];
					$content  = $_POST['content'];
					$portrait = isset( $_SESSION['url'] ) ? $_SESSION['url'] : '';
					$ctime 	  = time();
					$state	  = 1;
					$sql 	  = "INSERT INTO mb_comment_info (author,content,ip,portrait,ctime,state) VALUES ('{$name}','{$content}','{$ip}','{$portrait}',{$ctime},{$state})";
					mysql_query( $sql );
					unset( $_SESSION['url'] );
					if ( $username['state'] == 0 ) {
						$_SESSION['guestname'] = $name;
					}
					jsNotice( '留言成功', 'view.php' );
				} else {
					jsNotice( '此姓名已被版主征用' );
				}
				mysql_free_result( $resultAdmin );
				mysql_close();
			}
		}
	}
}
?>
<script type="text/javascript" src="js/comment.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 留言 开始 -->
		<div class="wrapper">
			<form class="chkform" action="comment.php" method="post" enctype="multipart/form-data">
				<!-- 姓名 开始 -->
				<div class="row">
					<p class="row_name">姓名：</p>
					<?php 
					if ( $username['state'] ) {
						echo '<input id="ban" type="text" name="name" value="' . $username['name'] . '" readonly="readonly" />';
					} else {
						echo '<input type="text" name="name" value="" placeholder="请输入姓名" datatype="name" nullmsg="请输入姓名" errormsg="姓名应为2-20位任意字符" />';
					}
					?>
					<p class="row_desc">成功留言后不可修改</p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入姓名</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 姓名 结束 -->
				<!-- 留言内容 开始 -->
				<div class="row">
					<p class="row_name">留言内容：</p>
					<textarea class="content" name="content" placeholder="请输入留言内容..." datatype="comment" nullmsg="请输入留言内容" errormsg="留言内容不能超过200个字符"></textarea>
					<p class="row_desc content_desc">还能输入200个字</p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入留言内容</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 留言内容 结束 -->
				<!-- 留言内容 开始 -->
				<div class="row">
					<p class="row_name">上传头像：</p>
					<input class="upload" type="file" name="portrait" value="" />
					<input class="url" type="hidden" name="url" value="<?php echo $url; ?>" />
					<p class="row_desc">仅支持jpg、png、gif</p>
				</div>
				<!-- 留言内容 结束 -->
				<!-- 操作按钮 开始 -->
				<div class="row">
					<p class="row_name"></p>
					<input class="opt" type="submit" value="提 交" />
					<input class="opt" type="reset" value="重 置" />
				</div>
				<!-- 操作按钮 结束 -->
			</form>
		</div>
		<!-- 留言 结束 -->
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
</body>
</html>