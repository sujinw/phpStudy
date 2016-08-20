<?php 
// 页面基本信息
$site_title 	  = '搜索留言';
$site_keywords 	  = '搜索留言';
$site_description = '搜索留言';
$site 			  = 'search';

// 引入头文件
include_once('head.php');
?>
<script type="text/javascript" src="js/search.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 搜索 开始 -->
		<div class="wrapper">
			<form class="chkform" action="view.php" method="post">
				<!-- 帐号 开始 -->
				<div class="row">
					<p class="row_name">留言主内容搜索：</p>
					<input type="text" name="content" value="" placeholder="请输入搜索关键词" datatype="*" nullmsg="请输入搜索关键词" />
					<p class="row_desc"></p>
				</div>
				<!-- 表单验证提示信息 -->
				<div>
					<div class="info">
						<span class="Validform_checktip">请输入搜索关键词</span>
						<span class="dec">
							<s class="dec1">&#9670;</s>
							<s class="dec2">&#9670;</s>
						</span>
					</div>
				</div>
				<!-- 帐号 结束 -->
				<!-- 密码 开始 -->
				<div class="row">
					<p class="row_name">留言时间段选择：</p>
					<select name="date">
						<option value="0">全部</option>
						<option value="1">一天内</option>
						<option value="2">一周内</option>
						<option value="3">一月内</option>
						<option value="4">一年内</option>
					</select>
					<p class="row_desc"></p>
				</div>
				<!-- 密码 结束 -->
				<!-- 操作按钮 开始 -->
				<div class="row">
					<p class="row_name"></p>
					<input class="opt" type="submit" value="搜 索" />
					<input class="opt" type="reset" value="重 置" />
				</div>
				<!-- 操作按钮 结束 -->
				<!-- 搜索标志 开始 -->
				<input type="hidden" name="search_flag" value="1" />
				<!-- 搜索标志 结束 -->
			</form>
		</div>
		<!-- 搜索 结束 -->
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
</body>
</html>