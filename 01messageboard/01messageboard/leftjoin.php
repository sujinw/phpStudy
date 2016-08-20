<?php 
// 页面基本信息
$site_title 	  = '查看留言';
$site_keywords 	  = '查看留言';
$site_description = '查看留言';
$site 			  = 'view';
$whereString ='';

// 引入头文件
include_once('head.php');

// 查询留言数据总数
$sqlTotal     = 'SELECT state FROM mb_comment_info WHERE state > 0';
$resultTotal  = mysql_query( $sqlTotal );
$numTotal 	  = mysql_num_rows( $resultTotal );
mysql_free_result( $resultTotal );


// SESSION
$username = [];
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

// 查询版主名称
$sqlMaster 	  = 'SELECT username,state FROM mb_admin_user WHERE state = 2';
$resultMaster = mysql_query( $sqlMaster );
$rowMaster 	  = mysql_fetch_assoc( $resultMaster );
$master 	  = $rowMaster['username'];

// 查询所有留言、回复
$sql 	= "SELECT c.id c_id,c.author c_author,c.content c_content,c.ip c_ip,c.portrait c_portrait,c.ctime c_ctime,c.state c_state,r.id r_id,r.pid r_pid,r.author r_author,r.content r_content,r.ip r_ip,r.ctime r_ctime,r.state r_state,r.who r_who FROM mb_comment_info c LEFT JOIN mb_reply_info r ON c.id = r.pid AND c.state > 0 AND r.state > 0 ORDER BY c.ctime DESC,r.ctime DESC";
$result = mysql_query( $sql );
$num 	= mysql_num_rows( $result );
$i 		= 0;
$j 		= 0;
$list	= [];
if ( $num > 0 ) {
	while ( $row = mysql_fetch_assoc( $result ) ) {
		if ( empty( $list[$row['c_id']] ) ) {
			$list[$row['c_id']]['c_id'] 	  = $row['c_id'];
			$list[$row['c_id']]['c_author']   = $row['c_author'];
			$list[$row['c_id']]['c_content']  = $row['c_content'];
			$list[$row['c_id']]['c_ip'] 	  = $row['c_ip'];
			$list[$row['c_id']]['c_portrait'] = $row['c_portrait'];
			$list[$row['c_id']]['c_ctime'] 	  = $row['c_ctime'];
			$list[$row['c_id']]['c_state'] 	  = $row['c_state'];
			$list[$row['c_id']]['reply'] 	  = [];

			if ( $row['r_id'] ) {
				$list[$row['c_id']]['reply'][$row['r_id']]['r_id'] 	  	= $row['r_id'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_pid'] 	= $row['r_pid'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_author']  = $row['r_author'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_content'] = $row['r_content'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_ip'] 	    = $row['r_ip'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_ctime'] 	= $row['r_ctime'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_state'] 	= $row['r_state'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_who']	 	= $row['r_who'];
			}
		} else {
			if ( $row['r_id'] ) {
				$list[$row['c_id']]['reply'][$row['r_id']]['r_id'] 	  	= $row['r_id'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_pid'] 	= $row['r_pid'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_author']  = $row['r_author'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_content'] = $row['r_content'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_ip'] 	    = $row['r_ip'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_ctime'] 	= $row['r_ctime'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_state'] 	= $row['r_state'];
				$list[$row['c_id']]['reply'][$row['r_id']]['r_who']	 	= $row['r_who'];
			}
		}
	}
}
?>
<link rel="stylesheet" type="text/css" href="css/view.css" />
<script type="text/javascript" src="js/view.js"></script>
</head>
<body>
	<!-- 主体内容 开始 -->
	<div class="base_wrapper">
		<!-- 导航 开始 -->
		<?php include('nav.php'); ?>
		<!-- 导航 结束 -->
		<!-- 留言列表 开始 -->
		<div class="comment_list">
			<?php if ( $num == 0 ) { ?>
			<!-- 留言列表为空时 开始 -->
			<div class="comment_empty"><?php if ( $whereString ) { echo '抱歉，没有找到相关留言'; } else { echo '暂无留言信息'; } ?></div>
			<!-- 留言列表为空时 结束 -->
			<?php 
		} else {
			foreach ( $list as $k => $v ) {
				?>
				<!-- 一条留言 开始 -->
				<div class="comment_row">
					<!-- 留言左侧 开始 -->
					<div class="comment_left">
						<!-- 用户头像 -->
						<img class="comment_portrait" src="<?php echo $v['c_portrait'] ? $v['c_portrait'] : 'images/default_user.png'; ?>" width="110" />
						<!-- 用户名称 -->
						<?php if ( $v['c_author'] == $master ) { ?>
						<p class="comment_author orange"><?php echo $v['c_author']; ?></p>
						<?php } elseif ( $v['c_author'] == $username['name'] ) { ?>
						<p class="comment_author green"><?php echo $v['c_author']; ?></p>
						<?php } else { ?>
						<p class="comment_author"><?php echo $v['c_author']; ?></p>
						<?php } ?>
						<!-- 用户IP -->
						<p class="comment_ip">用户IP地址：<?php echo $v['c_ip'] ? $v['c_ip'] : '未知IP地址'; ?></p>
					</div>
					<!-- 留言左侧 结束 -->
					<!-- 留言右侧 开始 -->
					<div class="comment_right">
						<!-- 留言操作 开始 -->
						<div class="comment_opt">
							<span><?php echo date( 'Y-m-d H:i:s', $v['c_ctime'] ); ?></span>
							<a class="reply_btn" href="javascript:void(0);" data-id="<?php echo $v['c_id']; ?>" data-name="<?php echo $v['c_author']; ?>"><?php if ( $v['c_author'] == $username['name'] ) { echo '追加'; } else { echo '回复'; } ?></a>
							<?php if ( $username['state'] == 1 or $v['c_author'] == $username['name'] ) { ?>
							<a class="comment_del" href="javascript:void(0);" data-id="<?php echo $v['c_id']; ?>">删除</a>
							<?php } ?>
						</div>
						<!-- 留言操作 结束 -->
						<!-- 留言内容 开始 -->
						<div class="comment_content"><?php echo $v['c_content']; ?></div>
						<!-- 留言内容 结束 -->
						<!-- 回复列表 开始 -->
						<div class="reply_list">
							<?php 
							foreach ( $v['reply'] as $key => $value ) {
								// 判断回复作者名字颜色
								if ( $value['r_author'] == $master ) {
									$colorAuthor = 'red';
								} elseif ( $value['r_author'] == $username['name'] ) {
									$colorAuthor = 'green';
								} else {
									$colorAuthor = 'blue';
								}

								// 判断回复对象名字颜色
								if ( $value['r_who'] == $master ) {
									$colorWho = 'red';
								} elseif ( $value['r_who'] == $username['name'] ) {
									$colorWho = 'green';
								} else {
									$colorWho = 'blue';
								}
								?>
								<!-- 一条回复 开始 -->
								<div class="reply_row">
									<!-- 回复内容 -->
									<div class="reply_content">
										<?php if ( $v['c_author'] == $value['r_author'] && $v['c_author'] == $value['r_who'] ) { ?>
										<span class="<?php echo $colorAuthor; ?>"><?php echo $value['r_author']; ?></span>：<?php echo $value['r_content']; ?>
										<?php } else { ?>
										<span class="<?php echo $colorAuthor; ?>"><?php echo $value['r_author']; ?></span> 回复 <span class="<?php echo $colorWho; ?>"><?php echo $value['r_who']; ?></span>：<?php echo $value['r_content']; ?>
										<?php } ?>
									</div>
									<!-- 回复操作、时间 -->
									<div class="reply_opt">
										<span>来自：<?php echo $value['r_ip'] ? $value['r_ip'] : '未知IP地址'; ?></span>
										<span><?php echo date( 'Y-m-d H:i:s', $value['r_ctime'] ); ?></span>
										<?php if ( $value['r_who'] == $v['c_author'] && $v['c_author'] != $value['r_author'] ) { ?>
										<a class="reply_btn" href="javascript:void(0);" data-id="<?php echo $v['c_id']; ?>" data-name="<?php echo $value['r_author']; ?>">回复</a>
										<?php } ?>
										<?php if ( $username['state'] == 1 or $value['r_author'] == $username['name'] ) { ?>
										<a class="reply_del" href="javascript:void(0);" data-id="<?php echo $value['r_id']; ?>">删除</a>
										<?php } ?>
									</div>
								</div>
								<!-- 一条回复 结束 -->
								<?php } ?>
							</div>
							<!-- 回复列表 结束 -->
						</div>
						<!-- 留言右侧 结束 -->
					</div>
					<!-- 一条留言 结束 -->
					<?php 
				}
			}
			?>
		</div>
		<!-- 留言列表 结束 -->
		<?php if ( $numTotal > 0 && !$whereString ) { ?>
		<!-- 分页 开始 -->
		<div class="page">
			<?php echo $pageData['pageHtml']; ?>
		</div>
		<!-- 分页 结束 -->
		<?php } ?>
		<!-- 底部 开始 -->
		<?php include('footer.php'); ?>
		<!-- 底部 结束 -->
	</div>
	<!-- 主体内容 结束 -->
	<!-- 回复回复弹窗 开始 -->
	<div class="reply_window">
		<form action="" method="post">
			<input <?php if ( $username['state'] != 0 ) { echo 'id="ban"'; } ?> class="reply_input" type="text" name="reply_name" value="<?php echo $username['name']; ?>" placeholder="请输入姓名" <?php if ( $username['state'] != 0 ) { echo 'readonly="readonly"'; } ?> />
			<textarea class="reply_textarea" name="reply_content"></textarea>
			<input type="hidden" name="reply_pid" value="" />
		</form>
	</div>
	<!-- 回复回复弹窗 结束 -->
</body>
</html>