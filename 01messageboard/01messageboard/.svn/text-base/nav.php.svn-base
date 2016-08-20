<div class="nav">
	<a class="home <?php if ( $site == 'home' ) { echo 'hover'; }?>" href="index.php">首页</a>
	<a class="comment <?php if ( $site == 'comment' ) { echo 'hover'; }?>" href="comment.php">给我留言</a>
	<a class="view <?php if ( $site == 'view' ) { echo 'hover'; }?>" href="view.php">查看留言</a>
	<a class="search <?php if ( $site == 'search' ) { echo 'hover'; }?>" href="search.php">搜索留言</a>
	<?php
	// 管理员登陆
	if ( $site == 'user' ) {
		if ( isset( $_SESSION['username'] ) ) {
			echo '<a class="user hover" href="user.php">您好，'.$_SESSION['username'].'</a>';
		} else {
			echo '<a class="user hover" href="login.php">管理员登陆</a>';
		}
	} else {
		if ( isset( $_SESSION['username'] ) ) {
			echo '<a class="user" href="user.php">您好，'.$_SESSION['username'].'</a>';
		} else {
			echo '<a class="user" href="login.php">管理员登陆</a>';
		}
	}
	?>
</div>