<?php 
//echo phpinfo();
// 页面基本信息
$site_title 					= '留言板系统';
$site_keywords 			= '留言板系统';
$site_description		= '留言板系统';
$site 							= 'home';
// 引入头文件
include_once('head.php');
// 查询版主信息
$sql 	= 'SELECT username,email,state FROM mb_admin_user WHERE state = 2';
$result = mysql_query( $sql );
$row 	= mysql_fetch_array( $result );
mysql_free_result( $result );
mysql_close();
?>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 介绍 开始 -->
		<div class="introduce">
			<!-- 关于我 开始 -->
			<div class="about">
				关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我关于我
			</div>
			<!-- 关于我 结束 -->
			<!-- 联系我 开始 -->
			<div class="contact">
				<p class="name">姓名：<?php echo $row['username'] ?></p>
				<p class="email">邮箱：<?php echo $row['email'] ?></p>
				<p class="address">地址：杭州市江干区东方电子商务园</p>
			</div>
			<!-- 联系我 结束 -->
			<div class="clear"></div>
		</div>
		<!-- 介绍 结束 -->
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
</body>
</html>