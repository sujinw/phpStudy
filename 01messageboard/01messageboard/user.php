<?php 
// 页面基本信息
$site_title 	  = '管理员管理';
$site_keywords 	  = '管理员管理';
$site_description = '管理员管理';
$site 			  = 'user';

// 引入头文件
include_once('head.php');

// 判断登陆状态
if ( !isset( $_SESSION['username'] ) ) {
	header( 'Location:login.php' );
	exit;
} else {
	$sql 	= 'SELECT username,email,lastip,state FROM mb_admin_user WHERE username = "' . $_SESSION['username'] . '" AND state > 0';
	$result = mysql_query( $sql );
	$row 	= mysql_fetch_array( $result );
	mysql_free_result( $result );
	mysql_close();
}
?>
<link rel="stylesheet" type="text/css" href="css/user.css" />
<script type="text/javascript" src="js/user.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 管理员界面 开始 -->
		<div class="wrapper">
			<!-- 帐号 开始 -->
			<div class="row">
				<p class="user_name">管理员帐号：<span id="user_name"><?php echo $_SESSION['username']; ?></span></p>
			</div>
			<!-- 帐号 结束 -->
			<!-- 邮箱 开始 -->
			<div class="row">
				<p class="user_name">管理员邮箱：<?php echo $row['email'] ? $row['email'] : '暂无邮箱' ; ?></p>
			</div>
			<!-- 邮箱 结束 -->
			<!-- 上次登陆IP 开始 -->
			<div class="row">
				<p class="user_name">上次登陆IP：[<?php echo $row['lastip'] ? $row['lastip'] : '您是第一次登陆哦'; ?>]</p>
			</div>
			<!-- 上次登陆IP 结束 -->
			<!-- 本次登陆IP 开始 -->
			<div class="row">
				<p class="user_name">本次登陆IP：[<?php echo getOnlineIp() ? getOnlineIp() : '服务器动荡¯﹃¯，获取IP失败' ; ?>]</p>
			</div>
			<!-- 本次登陆IP 结束 -->
			<!-- 操作按钮 开始 -->
			<div class="row">
				<p class="row_name"></p>
				<a class="opt" href="repwd.php">修改密码</a>
				<a class="opt" href="reemail.php"><?php echo $row['email'] ? '修改' : '设置' ; ?>邮箱</a>
				<a id="exit" class="opt" href="javascript:void(0);">安全退出</a>
			</div>
			<!-- 操作按钮 结束 -->
		</div>
		<!-- 管理员界面 结束 -->
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
</body>
</html>