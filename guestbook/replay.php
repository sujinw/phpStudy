<?php
$siteInfo = array(
	"site"	=> "发表留言"
);
include_once "base.php";
include_once "head.php";
//print_r($_SESSION);
?>
<script>

function commit(){
	if(is_login == 0){
		alert("请先登录或者注册，再给留言！");
		openlogin();
		return false;
	}
}
</script>
<section class="container">
	<div class="info-box box">
		<form action="action.php?act=commit&back=index.php" method="post" onSubmit="commit()">
			<div class="input-form">
				<label for="name">昵称:</label>
				<input type="text" name="username" disabled id="name" placeholder="<?php echo $_SESSION['username'];?>" />
			</div>
			<div class="input-form">
				<label for="email">邮箱:</label>
				<input type="text" name="email" id="email" placeholder="请输入邮箱" />
			</div>
			<div class="input-form">
				<label for="name">选择头像:</label>
				<ul class="face-list" id="face-list">
					<li class="select"><a href="javascript:;"><img src="images/1.jpg" width="100" height="100" alt="face"></a></li>
					<li><a href="javascript:;"><img src="images/2.jpg" width="100" height="100" alt="face"></a></li>
					<li><a href="javascript:;"><img src="images/3.jpg" width="100" height="100" alt="face"></a></li>
					<li><a href="javascript:;"><img src="images/4.jpg" width="100" height="100" alt="face"></a></li>
					<li><a href="javascript:;"><img src="images/5.jpg" width="100" height="100" alt="face"></a></li>
					<li><a href="javascript:;"><img src="images/6.jpg" width="100" height="100" alt="face"></a></li>
				</ul>
				<input type="hidden" id="user-img" name="user_img" value="images/1.jpg" />
			</div>
			<div class="input-form" style="clear: both;float:none">
				<label for="contents">内容:</label>
				<textarea name="contents" id="contents" placeholder="输入内容"></textarea> 
			</div>
			<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']?>" />
			<button type="submit" name="sub" class="btn-submit">提  交</button>
		</form>
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
	<form action="action.php?act=login&back=replay.php" method="post">
		<div class="model-title">
		<h3 id="title">用户登录</h3>
		<span class="close" id="closelogin">X</span>
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
		<input type="submit" id="login-sub" class="login-sub" value="登录" />
		<a href="javascript:;" onclick="showRegister()">还没有账号？马上注册>></a>
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
		<input type="submit" class="login-sub" value="注 册" />
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
	var face	= document.getElementById("face-list");
	var faceLi  = face.getElementsByTagName("li");

	for(var i=0; i<faceLi.length; i++){
		faceLi[i].onclick = function(){
			for(var j=0; j<faceLi.length; j++){
				faceLi[j].className = "";
			}
			this.className += "select";
			document.getElementById('user-img').value = this.firstChild.firstChild.src;
		}
	}

</script>