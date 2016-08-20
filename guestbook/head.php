<?php
session_start();
//连接数据库
$con = @mysql_connect("localhost","root","zhcm1993");
if ($con){
	mysql_select_db( 'gressbook' ,$con );
	mysql_query( 'SET names utf8' ); 

}else{
  die('Could not connect: ' . mysql_error());
  }
header("Content-type:text/html,charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>P0508-guestbook-<?php echo $siteInfo['site']; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/scripts.js"></script>
	<script>
	var is_login = <?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])){echo 1;}else{echo 0;}?>;

	function GetQueryString(name){
		var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if(r!=null)return  unescape(r[2]); return null;
	}
	</script>
</head>
<body>
<header class="header">
	<div class="head-left">
		<span class="logo"><h2>GuestBook</h2></span>
	</div>
	<div class="head-right">
		<ul>
			<li><?php if(isset($_SESSION['adminUser']) && $_SESSION['adminUser'] == $adminInfo['adminuser']){ ?><a href="index.php"><?php echo $adminInfo['adminuser']?></a><?php }else{ ?><a href="javascript:;" onclick="openlogin()"><?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])){echo $_SESSION['username'];}else{echo "登录/注册";}?></a><?php }?></li>
			<li><a href="#" onclick="openModel({'title':'下载提示','content':'<a href='+'>点击链接下载</a>'})">源码下载</a></li>
			<li><a href="#" onclick="openModel({'title':'联系slade','content':'email:sujinw@qq.com'})">联系slade</a></li>
			<li><a href="#" onclick="openModel({'title':'关于gusetbook','content':'本留言本采用php+txt形式开发'})">关于此留言本</a></li>
		</ul>
	</div>
</header>