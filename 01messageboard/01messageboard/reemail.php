<?php 
// 页面基本信息
$site_title 	  = '修改邮箱';
$site_keywords 	  = '修改邮箱';
$site_description = '修改邮箱';
$site 			  = 'user';

// 引入头文件
include_once('head.php');

// 判断是否登陆
if ( !isset( $_SESSION['username'] ) ) {
	header( 'Location:login.php' );
	exit;
} else {
	if ( $_POST ) {
		if ( empty( $_POST ) ) {
			jsNotice( '非法操作' );
		} else {
			// 数据验证
			if ( !$_POST['email'] ) {
				jsNotice( '请输入新邮箱' );
			} elseif ( !preg_match("/^\w+(<-+.>\w+)*@\w+(<-.>\w+)*\.\w+(<-.>\w+)*$/", $_POST['email']) ) {
				jsNotice( '请输入正确的邮箱地址' );
			} else {
				$sql = "UPDATE mb_admin_user SET email = '{$_POST['email']}' WHERE username = '{$_SESSION['username']}'";
				mysql_query( $sql );
				jsNotice( '邮箱修改成功', 'user.php' );
				mysql_close();
			}
		}
	}
}
?>
<link rel="stylesheet" type="text/css" href="css/reemail.css" />
<script type="text/javascript" src="js/reemail.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 修改邮箱 开始 -->
		<div class="wrapper">
			<form class="chkform" action="reemail.php" method="post">
				<!-- 新邮箱 开始 -->
				<div class="row">
					<p class="row_name">新邮箱：</p>
					<input type="text" name="email" value="" placeholder="请输入新邮箱" datatype="email" nullmsg="请输入新邮箱" errormsg="请输入正确的邮箱地址" />
					<p class="row_desc"></p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入新邮箱</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 新邮箱 结束 -->
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
		<!-- 修改邮箱 结束 -->
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
</body>
</html>