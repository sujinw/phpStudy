<?php 
// 页面基本信息
$site_title 	  = '查看留言';
$site_keywords 	  = '查看留言';
$site_description = '查看留言';
$site 			  = 'view';

// 引入头文件
include_once('head.php');

// 查询留言数据总数
$sqlTotal     = 'SELECT state FROM mb_comment_info WHERE state > 0';
$resultTotal  = mysql_query( $sqlTotal );
$numTotal 	  = mysql_num_rows( $resultTotal );
mysql_free_result( $resultTotal );
$limit 		  = '';
// 如果有留言数据
if ( $numTotal > 0 ) {
	$pageData = paging( $numTotal, 2 );
	$limit    = $pageData['limit'];
}

// 搜索条件
$whereContent = '';
$whereDate 	  = '';
if ( $_POST ) {
	if ( empty( $_POST ) ) {
		jsNotice( '参数错误' );
	} else {
		if ( $_POST['search_flag'] != 1 ) {
			jsNotice( '参数错误' );
		} elseif ( !isset( $_POST['content'] ) ) {
			jsNotice( '搜索关键词不能空' );
		} elseif ( !isset( $_POST['date'] ) ) {
			jsNotice( '参数错误' );
		} else {
			$search_content = $_POST['content'];
			$search_date	= $_POST['date'];
			$whereContent	= " AND content LIKE '%{$search_content}%' ";
			switch ( $search_date ) {
				case '1' :
				$whereDate = " AND ctime > UNIX_TIMESTAMP(DATE_SUB(NOW(),INTERVAL 1 DAY)) ";
				break;
				case '2' :
				$whereDate = " AND ctime > UNIX_TIMESTAMP(DATE_SUB(NOW(),INTERVAL 1 WEEK)) ";
				break;
				case '3' :
				$whereDate = " AND ctime > UNIX_TIMESTAMP(DATE_SUB(NOW(),INTERVAL 1 MONTH)) ";
				break;
				case '4' :
				$whereDate = " AND ctime > UNIX_TIMESTAMP(DATE_SUB(NOW(),INTERVAL 1 YEAR)) ";
				break;
				default  :
				break;
			}
		}
	}
}
$whereString = $whereContent.$whereDate;

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
mysql_free_result( $resultMaster );

// 获取留言信息及其回复信息数组
if ( $whereString ) {
	$limit = '';
}
$sql    = 'SELECT id,author,content,ip,portrait,ctime,state FROM mb_comment_info WHERE state > 0 ' . $whereString . 'ORDER BY ctime DESC' . $limit;
$result = mysql_query( $sql );
$num 	= mysql_num_rows( $result );
$list 	= [];
$i 		= 0;
$j 		= 0;
if ( $num > 0 ) {
	while ( $row = mysql_fetch_assoc( $result ) ) {
		// 留言信息
		$list[$i]['id'] 	  = $row['id'];
		$list[$i]['author']   = $row['author'];
		$list[$i]['content']  = $row['content'];
		$list[$i]['ip'] 	  = $row['ip'];
		$list[$i]['portrait'] = $row['portrait'];
		$list[$i]['ctime'] 	  = $row['ctime'];
		$list[$i]['reply'] 	  = [];

		// 回复信息
		$sqlReply 	 = "SELECT id,pid,author,ip,content,state,ctime,who FROM mb_reply_info WHERE pid = {$row['id']} AND state > 0 ORDER BY ctime DESC";
		$resultReply = mysql_query( $sqlReply );
		while ( $rowReply = mysql_fetch_assoc( $resultReply ) ) {
			$list[$i]['reply'][$j]['id'] = $rowReply['id'];
			$list[$i]['reply'][$j]['pid'] = $rowReply['pid'];
			$list[$i]['reply'][$j]['author'] = $rowReply['author'];
			$list[$i]['reply'][$j]['ip'] = $rowReply['ip'];
			$list[$i]['reply'][$j]['content'] = $rowReply['content'];
			$list[$i]['reply'][$j]['ctime'] = $rowReply['ctime'];
			$list[$i]['reply'][$j]['who'] = $rowReply['who'];
			$j ++;
		}
		$i ++;
	}
	mysql_free_result( $resultReply );
}
mysql_free_result( $result );
mysql_close();
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
						<img class="comment_portrait" src="<?php echo $v['portrait'] ? $v['portrait'] : 'images/default_user.png'; ?>" width="110" />
						<!-- 用户名称 -->
						<?php if ( $v['author'] == $master ) { ?>
						<p class="comment_author orange"><?php echo $v['author']; ?></p>
						<?php } elseif ( $v['author'] == $username['name'] ) { ?>
						<p class="comment_author green"><?php echo $v['author']; ?></p>
						<?php } else { ?>
						<p class="comment_author"><?php echo $v['author']; ?></p>
						<?php } ?>
						<!-- 用户IP -->
						<p class="comment_ip">用户IP地址：<?php echo $v['ip'] ? $v['ip'] : '未知IP地址'; ?></p>
					</div>
					<!-- 留言左侧 结束 -->
					<!-- 留言右侧 开始 -->
					<div class="comment_right">
						<!-- 留言操作 开始 -->
						<div class="comment_opt">
							<span><?php echo date( 'Y-m-d H:i:s', $v['ctime'] ); ?></span>
							<a class="reply_btn" href="javascript:void(0);" data-id="<?php echo $v['id']; ?>" data-name="<?php echo $v['author']; ?>"><?php if ( $v['author'] == $username['name'] ) { echo '追加'; } else { echo '回复'; } ?></a>
							<?php if ( $username['state'] == 1 or $v['author'] == $username['name'] ) { ?>
							<a class="comment_del" href="javascript:void(0);" data-id="<?php echo $v['id']; ?>">删除</a>
							<?php } ?>
						</div>
						<!-- 留言操作 结束 -->
						<!-- 留言内容 开始 -->
						<div class="comment_content"><?php echo $v['content']; ?></div>
						<!-- 留言内容 结束 -->
						<!-- 回复列表 开始 -->
						<div class="reply_list">
							<?php 
							foreach ( $v['reply'] as $key => $value ) {
								// 判断回复作者名字颜色
								if ( $value['author'] == $master ) {
									$colorAuthor = 'red';
								} elseif ( $value['author'] == $username['name'] ) {
									$colorAuthor = 'green';
								} else {
									$colorAuthor = 'blue';
								}

								// 判断回复对象名字颜色
								if ( $value['who'] == $master ) {
									$colorWho = 'red';
								} elseif ( $value['who'] == $username['name'] ) {
									$colorWho = 'green';
								} else {
									$colorWho = 'blue';
								}
								?>
								<!-- 一条回复 开始 -->
								<div class="reply_row">
									<!-- 回复内容 -->
									<div class="reply_content">
										<?php if ( $v['author'] == $value['author'] && $v['author'] == $value['who'] ) { ?>
										<span class="<?php echo $colorAuthor; ?>"><?php echo $value['author']; ?></span>：<?php echo $value['content']; ?>
										<?php } else { ?>
										<span class="<?php echo $colorAuthor; ?>"><?php echo $value['author']; ?></span> 回复 <span class="<?php echo $colorWho; ?>"><?php echo $value['who']; ?></span>：<?php echo $value['content']; ?>
										<?php } ?>
									</div>
									<!-- 回复操作、时间 -->
									<div class="reply_opt">
										<span>来自：<?php echo $value['ip'] ? $value['ip'] : '未知IP地址'; ?></span>
										<span><?php echo date( 'Y-m-d H:i:s', $value['ctime'] ); ?></span>
										<?php if ( $value['who'] == $v['author'] && $v['author'] != $value['author'] ) { ?>
										<a class="reply_btn" href="javascript:void(0);" data-id="<?php echo $v['id']; ?>" data-name="<?php echo $value['author']; ?>">回复</a>
										<?php } ?>
										<?php if ( $username['state'] == 1 or $value['author'] == $username['name'] ) { ?>
										<a class="reply_del" href="javascript:void(0);" data-id="<?php echo $value['id']; ?>">删除</a>
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