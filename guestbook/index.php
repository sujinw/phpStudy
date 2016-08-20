<?php
/**
 * guestbook
 * author slade
 * mysql + php;
 */
include 'base.php';
$siteInfo = array(
	"site"	=> "查看留言"
);
include_once "head.php";
$message = false;
$pageSize = 15;
$p = isset($_GET['p']) ? $_GET['p'] : 1;
$index = ($p-1)*$pageSize;
$sql = " select u.uid,u.username,a.gid,a.email,a.user_img,a.content,a.creat_time,a.send_ip from content as a,user as u where a.uid=u.uid and a.is_display=1 and a.is_delete=0 limit {$index},{$pageSize}";
//echo $sql;
$result = mysql_query( $sql );
$res = array();
while($row = mysql_fetch_array($result)){
	$res[] = $row;
}
$sql = "SELECT count(*) FROM content";
$result = mysql_query( $sql );
if(mysql_num_rows( $result)){
     
   $rs=mysql_fetch_array($result);
    
   //统计结果
   $count=$rs[0];
    
}else{
     
    $count=0;
}
?>
<section class="container">
	<div class="content-list box">
		<div class="content-title">
			<h2>留言内容</h2>
		</div>
		<ul class="con-list">
			<?php
			// var_dump($message);
				if(!$res) {
					echo '<li style="line-height: 90px;text-align:center;">
							没有留言~~~~
						</li>';
				}else{
					foreach ($res as $k => $v) {
			?>

						<li>
							<div class="head">
								<img width="60" height="60" src="<?php echo $v['user_img']?>" />
								<span class="nickname"><?php echo $v['username']?></span>
							</div>
							<div class="cont">
								<div class="con"><?php echo $v['content']?></div>
								<div class="tool">
									<span class="time"><?php echo date('Y/m/d',$v['creat_time']);?></span>
								</div>
							</div>
						</li>
			<?php
					}
				}
			?>
			
		</ul>
		<div class="page">
			<ul>
				<li>
					<a href='index.php?p=1' title='首页'>首页</a>
				</li>
				<li>
					<a href='index.php?p=1' id="pre" title='后一页'>上一页</a>
				</li>
				<li>
					<a href='index.php?p=1' id="next" title='后一页'>下一页</a>
				</li>
				<li>
					<a href='index.php?p=1' id="total" title='最后一页'>最后一页</a>
				</li>
			</ul>
		</div>
	</div>
</section>
<div id="shade" class="shade"></div>
<div id="model" class="model">
	<div class="model-title">
		<h3 id="title">模态标题</h3>
		<span class="close" id="close">X</span>
	</div>
	<div class="model-content" id="content">
		model内容
	</div>
</div>
<!-- 登录 -->
<div id="login" class="login model">
	<form action="index.php?act=login" method="post">
		<div class="model-title">
		<h3 id="title">管理登录</h3>
		<span class="close" id="closelogin">X</span>
	</div>
	<div class="model-content">
		<div class="login-inpt">
			<label for="adminuser">管理员账户</label>
			<input type="text" id="adminuser" name="adminuser" placeholder="请输入管理员账号" />
		</div>
		<div class="login-inpt">
			<label for="pass">管理员账户</label>
			<input type="password" id="pass" name="password" />
		</div>
		<input type="submit" id="login-sub" class="login-sub" value="登录" />
	</div>
	</form>
</div>
<!-- 注册 -->
<div id="register" class="login model">
	<form action="action.php?act=regigster&back=replay.php" method="post">
		<div class="model-title">
		<h3 id="title">用户注册</h3>
		<span class="close" id="closeResigster">X</span>
	</div>
	<div class="model-content">
		<div class="login-inpt">
			<label for="adminuser">用户名</label>
			<input type="text" id="adminuser" name="adminuser" placeholder="请输入管理员账号" />
		</div>
		<div class="login-inpt">
			<label for="pass">密码</label>
			<input type="password" id="pass" name="password" />
		</div>
		<div class="login-inpt">
			<label for="pass">确认密码</label>
			<input type="password" id="passConfirm" name="password" />
		</div>
		<input type="submit" class="login-sub" value="登录" />
		<a href="javascript:;" onclick="openlogin()">已经拥有账号？马上登录>></a>
	</div>
	</form>
</div>
<script>
//openlogin
if(document.getElementById("pass").value != document.getElementById("passConfirm").value){
	alert("两次密码不一致！");
}

if(is_login == 0){
	alert("请先登录或者注册，再给留言！");
	openlogin();
}
window.onload = function(){
	var num = GetQueryString('p');
	num = num ? num : 0;
	console.log(num)
	document.getElementById('pre').href="index.php?p="+(num+1);
	document.getElementById('next').href="index.php?p="+(num == 0 || num == 1? 1 : num-1);
	document.getElementById('total').href="index.php?p="+<?php echo $count/$pageSize < 1 ? 1 : $count/$pageSize; ?>;
}

</script>
</body>
</html>