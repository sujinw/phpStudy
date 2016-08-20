<?php 
// 页面基本信息
$site_title 	  = '管理员登陆';
$site_keywords 	  = '管理员登陆';
$site_description = '管理员登陆';
$site 			  = 'user';

// 引入头文件
include_once('head.php');

// 判断用户登陆
if ( isset( $_SESSION['username'] ) ) {
	header( 'Location:user.php' );
	exit;
}

// 表单提交
if ( $_POST ) {
	if ( !empty( $_POST ) ) {
		// 数据验证
		if ( !$_POST['username'] ) {
			jsNotice( '请输入帐号' );
		} elseif ( strlen( $_POST['username'] ) < 2 or strlen( $_POST['username'] ) > 20 ) {
			jsNotice( '帐号应为2-20位' );
		} elseif ( !$_POST['password'] ) {
			jsNotice( '请输入密码' );
		} elseif ( strlen( $_POST['password'] ) < 2 or strlen( $_POST['password'] ) > 20 ) {
			jsNotice( '密码应为6-20位任意字符' );
		} else {
			// 对比帐号密码
			$sql 	= 'SELECT username,password,state FROM mb_admin_user WHERE username = "' . $_POST['username'] . '" AND password = "' . md5( $_POST['password'] ) . '" AND state > 0';
			$result = mysql_query( $sql );
			if ( mysql_num_rows( $result ) == 0 ) {
				$sqlUser 	= 'SELECT username,password,state FROM mb_admin_user WHERE username = "' . $_POST['username'] . '"';
				$resultUser = mysql_query( $sqlUser );
				$rowUser 	= mysql_fetch_array( $resultUser );
				if ( mysql_num_rows( $resultUser ) == 0 ) {
					jsNotice( '用户名不存在' );
				} else {
					if ( $rowUser['state'] == 0 ) {
						jsNotice( '帐号已被禁用' );
					} elseif ( $rowUser['state'] == -1 ) {
						jsNotice( '帐号已被删除' );
					} else {
						jsNotice( '密码错误' );
					}
				}
				mysql_free_result( $resultUser );
			} else {
				$_SESSION['username'] = $_POST['username'];
				jsNotice( '登陆成功', 'login.php' );
			}
			mysql_free_result( $result );
			mysql_close();
		}
	} else {
		jsNotice( '非法操作' );
	}
}
?>
<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 登陆 开始 -->
		<div class="wrapper">
			<form class="chkform" action="login.php" method="post">
				<!-- 帐号 开始 -->
				<div class="row">
					<p class="row_name">帐号：</p>
					<input type="text" name="username" value="" placeholder="请输入帐号" datatype="account" nullmsg="请输入帐号" errormsg="帐号应为2-20位的数字、字母、下划线" />
					<p class="row_desc">测试帐号：pack</p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入帐号</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 帐号 结束 -->
				<!-- 密码 开始 -->
				<div class="row">
					<p class="row_name">密码：</p>
					<input type="password" name="password" value="" placeholder="请输入密码" datatype="pwd" nullmsg="请输入密码" errormsg="密码应为6-20位任意字符" />
					<p class="row_desc">测试密码：123123</p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入密码</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 密码 结束 -->
				<!-- 操作按钮 开始 -->
				<div class="row">
					<p class="row_name"></p>
					<input class="opt" type="submit" value="登 陆" />
					<input class="opt" type="reset" value="重 置" />
				</div>
				<!-- 操作按钮 结束 -->
			</form>
		</div>
		<!-- 登陆 结束 -->
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
</body>
</html>