<?php 
// 页面基本信息
$site_title 	  = '修改密码';
$site_keywords 	  = '修改密码';
$site_description = '修改密码';
$site 			  = 'user';

// 引入头文件
include_once('head.php');

// 判断登陆状态
if ( !isset( $_SESSION['username'] ) ) {
	header( 'Location:login.php' );
	exit;
} else {
	if ( $_POST ) {
		if ( empty( $_POST ) ) {
			jsNotice( '非法操作' );
		} else {
			// 数据验证
			if ( !$_POST['opwd'] ) {
				jsNotice( '原密码不能空' );
			} elseif ( strlen( $_POST['opwd'] ) < 6 or strlen( $_POST['opwd'] ) > 20 ) {
				jsNotice( '原密码应为6-20位字符' );
			} elseif ( !$_POST['pwd'] ) {
				jsNotice( '新密码不能空' );
			} elseif ( strlen( $_POST['pwd'] ) < 6 or strlen( $_POST['pwd'] ) > 20 ) {
				jsNotice( '新密码应为6-20位字符' );
			} elseif ( !$_POST['pwd2'] ) {
				jsNotice( '确认密码不能空' );
			} elseif ( strlen( $_POST['pwd2'] ) < 6 or strlen( $_POST['pwd2'] ) > 20 ) {
				jsNotice( '确认密码应为6-20位字符' );
			} elseif ( $_POST['pwd'] != $_POST['pwd2'] ) {
				jsNotice( '两次输入的密码不一致' );
			} elseif ( $_POST['pwd'] == $_POST['opwd'] ) {
				jsNotice( '原密码与新密码不能相同' );
			} else {
				$opwd 	= md5( $_POST['opwd'] );
				$sql 	= "SELECT username,password FROM mb_admin_user WHERE username = '{$_SESSION['username']}' AND password = '{$opwd}'";
				$result = mysql_query( $sql );
				if ( mysql_num_rows( $result ) == 0 ) {
					jsNotice( '原密码错误' );
				} else {
					$pwd 	   = md5( $_POST['pwd'] );
					$sqlUpdate = "UPDATE mb_admin_user SET password = '{$pwd}' WHERE username = '{$_SESSION['username']}' AND password = '{$opwd}'";
					mysql_query( $sqlUpdate );
					$sqlIp = 'UPDATE mb_admin_user SET lastip = "' . getOnlineIp() . '" WHERE username = "' . $_SESSION['username'] . '"';
					unset( $_SESSION['username'] );
					mysql_query( $sqlIp );
					jsNotice( '密码修改成功，请重新登陆', 'login.php' );
				}
				mysql_free_result( $result );
				mysql_close();
			}
		}
	}
}
?>
<link rel="stylesheet" type="text/css" href="css/repwd.css" />
<script type="text/javascript" src="js/repwd.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 修改密码 开始 -->
		<div class="wrapper">
			<form class="chkform" action="repwd.php" method="post">
				<!-- 原密码 开始 -->
				<div class="row">
					<p class="row_name">原密码：</p>
					<input type="password" name="opwd" value="" placeholder="请输入原密码" datatype="pwd" nullmsg="请输入原密码" errormsg="原密码应为6-20位字符" />
					<p class="row_desc"></p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入原密码</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 原密码 结束 -->
				<!-- 新密码 开始 -->
				<div class="row">
					<p class="row_name">新密码：</p>
					<input type="password" name="pwd" value="" placeholder="请输入新密码" datatype="pwd" nullmsg="请输入新密码" errormsg="新密码应为6-20位字符" />
					<p class="row_desc"></p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入新密码</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 新密码 结束 -->
				<!-- 确认密码 开始 -->
				<div class="row">
					<p class="row_name">确认密码：</p>
					<input type="password" name="pwd2" value="" placeholder="请输入确认密码" datatype="*" recheck="pwd" nullmsg="请输入确认密码" errormsg="二次输入的密码不一致" />
					<p class="row_desc"></p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">二次输入的密码不一致</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 确认密码 结束 -->
				<!-- 操作按钮 开始 -->
				<div class="row">
					<p class="row_name"></p>
					<input class="opt" type="submit" value="提 交" />
					<input class="opt" type="reset" value="重 置" />
					<a class="opt" href="user.php">返 回</a>
				</div>
				<!-- 操作按钮 结束 -->
			</form>
		</div>
		<!-- 修改密码 结束 -->
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
</body>
</html>