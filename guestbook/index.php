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
//获取留言内容
$sql = " select u.uid,u.username,a.gid,a.email,a.user_img,a.content,a.creat_time,a.send_ip from content as a,user as u where a.uid=u.uid and a.is_display=1 and a.is_delete=0 order by a.creat_time desc limit {$index},{$pageSize}";
//echo $sql;
$result = mysql_query( $sql );
$res = array();
while($row = mysql_fetch_array( $result ,MYSQL_ASSOC  )){
	$res[] = $row;
}
print_r($res);

//获取回复内容
$sql = "SELECT u.uid,u.username,r.user_img,r.rid,r.gid,r.content,r.create_time,r.reply_ip FROM reply as r,user as u WHERE r.uid=u.uid AND r.is_display=1 AND r.is_delete=0 order by r.create_time desc";
//echo $sql;
$replyResult = mysql_query( $sql );
$reply=array();
while($r = mysql_fetch_array( $replyResult , MYSQL_ASSOC )){
	$reply[] = $r;
}
//print_r($reply);

//处理回复和留言的数据
$data = array();
foreach($res as $key=>$value){
	foreach($reply as $k=>$v){
		if($value['gid'] == $v['gid']){
			$value['replay'][] = $v;
		}
	}
	$data[]=$value;
}
//print_r($data);
$sql = "SELECT count(*) FROM content";
$result = mysql_query( $sql );
if(mysql_num_rows( $result)){
     
   $rs=mysql_fetch_array($result );
    
   //统计结果
   $count=$rs[0];
    
}else{
     
    $count=0;
}
?>
<script>
	
</script>
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
					foreach ($data as $k => $v) {
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
									<?php if(isset($_SESSION['is_admin']) && !empty($_SESSION['is_admin'])) {?><span class="shenhe"><a href="javascript:;" onclick="del(<?php echo $v['gid']?>)">删除</a></span><?php }?>
									<?php if(isset($_SESSION['is_admin']) && !empty($_SESSION['is_admin'])) {?><span class="shenhe"><a href="javascript:;" onclick="replay(<?php echo $v['gid']?>)">回复</a></span><?php }?>
								</div>
							</div>
							<?php 
								if(isset($v['replay'])){
									foreach($v['replay'] as $key=>$value){
							
							?>
							<div class="replay">
								<div class="head">
									<img width="60" height="60" src="<?php echo $value['user_img']?>" />
									<span class="nickname"><?php echo $value['username']?></span>
								</div>
								<div class="cont">
									<div class="con"><?php echo $value['content']?></div>
									<div class="tool">
										<span class="time"><?php echo date('Y/m/d',$value['create_time']);?></span>
										<?php if(isset($_SESSION['is_admin']) && !empty($_SESSION['is_admin'])) {?><span class="shenhe"><a href="javascript:;" onclick="delReplay(<?php echo $value['rid']?>)">删除</a></span><?php }?>
									</div>
								</div>
							</div>
							<?php 
								}
							}
							?>
						</li>
			<?php
					}
				}
			?>
			
		</ul>
		<?php if($count > $pageSize){ ?>
		<div class="page" id="page">
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
		<?php } ?>
	</div>
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
<!--删除留言 -->
<div id="del" class="model">
	<div class="model-title">
		<h3 id="title">删除操作</h3>
		<span class="close" id="closeDel">X</span>
	</div>
	<div class="model-content" id="contentDel">
		您确定要删除这条数据吗？？
	</div>
	<form action="action.php?act=delCommit&back=index.php" method="post">
		<input type="hidden" value="" id="commitId"/>
		<input type="submit" class="login-sub" value="删 除" />
	</form>
</div>
<!--删除回复 -->
<div id="delReply" class="model">
	<div class="model-title">
		<h3 id="title">删除操作</h3>
		<span class="close" id="closeDelReply">X</span>
	</div>
	<div class="model-content" id="contentDelRepl">
		您确定要删除这条数据吗？？
	</div>
	<form action="action.php?act=delReply&back=index.php" method="post">
		<input type="hidden" name="rid" value="" id="replyId"/>
		<input type="submit" class="login-sub" value="删 除" />
	</form>
</div>
<!-- 回复 -->
<div id="replay" class="login model" style="display:none">
		<div class="model-title">
		<h3 id="title">回复本条留言</h3>
		<span class="close" id="closereplay">X</span>
	</div>
	<div class="model-content">
		<form action="action.php?act=reply&back=index.php" method="post" id="replayForm">
		<div class="login-inpt">
			<label for="name">昵称:</label>
				<input type="text" name="username" disabled id="name" placeholder="<?php echo $_SESSION['username'];?>" />
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
				<textarea name="contents" id="contents" style="width:360px" placeholder="输入内容"></textarea>
		</div>
		<input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['uid']?>" />
		<input type="hidden" name="gid" value="" id="gid" />
		<input type="button" id="login-sub" class="login-sub" value="回 复" />
	</div>
	</form>
</div>
<!-- 登录 -->
<div id="login" class="login model">
	<form action="action.php?act=login&back=index.php" method="post">
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
		<a href="javascript:;" onclick="showRegister()">还没有账号？马上进行注册>></a>
	</div>
	</form>
</div>
<!-- 注册 -->
<div id="register" class="login model">
	<form action="action.php?act=regigster&back=index.php" method="post">
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
</section>

<script>
//openlogin
if(document.getElementById("pass").value != document.getElementById("passConfirm").value){
	alert("两次密码不一致！");
}

if(is_login == 0){
	alert("请先登录或者注册，再给留言！");
	openlogin();
}
var num = GetQueryString('p');
num = num ? num*1 : 1;
console.log(num)
if(document.getElementById('page')){
	document.getElementById('pre').href="index.php?p="+( num == 1 ? 1 : num-1);
	document.getElementById('next').href="index.php?p="+( num == 1 ? 1 : num+1);
	document.getElementById('total').href="index.php?p=<?php echo $count/$pageSize < 1 ? 1 : $count/$pageSize; ?>";
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
function replay(id){
	
	document.getElementById("replay").style.display = "block";
	document.getElementById("shade").style.display = "block";
	document.getElementById("gid").value=id;
	
	document.getElementById('login-sub').onclick = function(){
		document.getElementById("replayForm").submit();
	}

}
function delReplay(id){
	document.getElementById('replyId').value = id;
	
	document.getElementById("delReply").style.display = "block";
	document.getElementById("shade").style.display = "block";

}


</script>
</body>
</html>