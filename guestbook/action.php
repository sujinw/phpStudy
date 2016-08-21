<?php
$siteInfo = array(
	"site"	=> "操作提示"
);
include "base.php";
include "head.php";
$act = isset($_GET['act']) ? $_GET['act'] : "";
$back = isset($_GET['back']) ? $_GET['back'] : "";
if($act == "login"){
	$msg = login();
}else if($act == "regigster"){
	$msg = regigster();
}else if($act == "commit"){
	$msg = commit();
}else if($act == "reply"){
	$msg = reply();
}else if($act=='delReply'){
	$msg = delReply();
}






function post($data){
	return isset($_POST[$data]) ? $_POST[$data] : "";
}
//登录操作
function login(){
	$username = post('adminuser');
	$pwd	  = post('password');

	// 对比帐号密码
	$sql 	= 'SELECT uid,username,password,is_admin FROM user WHERE username = "' . $username . '" AND password = "' . $pwd . '" AND is_display=1 AND is_delete=0';
	$result = mysql_query( $sql );
	$msg = "";
	if ( mysql_num_rows( $result ) == 0 ) {
		$sqlUser 	= 'SELECT username,password,is_admin FROM user WHERE username = "' . $username . '"';
		$resultUser = mysql_query( $sqlUser );
		$rowUser 	= mysql_fetch_array( $resultUser );
		if ( mysql_num_rows( $resultUser ) == 0 ) {
			$msg =  '用户名不存在' ;
		} else {
			if ( $rowUser['state'] == 0 ) {
				$msg =  '帐号已被禁用' ;
			} elseif ( $rowUser['state'] == -1 ) {
				$msg =  '帐号已被删除' ;
			} else {
				$msg =  '密码错误' ;
			}
		}
		mysql_free_result( $resultUser );
	} else {
		$res=array();
		while($row = mysql_fetch_array($result)){
			$res[] = $row;
		}

		//print_r($res);
		$_SESSION['username'] = $res[0]['username'];
		$_SESSION['uid'] = $res[0]['uid'];
		$_SESSION['is_admin'] = $res[0]['is_admin'];
		$msg = array('登陆成功' );
		//die;
	}
	mysql_free_result( $result );
	mysql_close();

	return $msg;
}


//注册操作
function regigster(){
	$username = post('adminuser');
	$pwd	  = post('password');
	
	// 对比帐号密码
	$sql 	= 'SELECT username FROM user WHERE username = "' . $username.'"';
	$result = mysql_query( $sql );
	$msg = "";
	
	if ( mysql_num_rows( $result ) == 0 ) {
		$sql = "INSERT INTO user (`username`,`password`,`create_time`,`is_display`,`is_delete`,`is_admin`) VALUES('{$username}','{$pwd}','".time()."','1','0','0')";
		//echo $sql;die;
		if( mysql_query( $sql )){
			$msg = array("注册成功,请登录！！");
		}else{
			$msg = array("注册失败！");
		}
	}else{
		$msg = array("用户名已经存在！");
	}
	mysql_free_result( $result );
	mysql_close();
	return $msg;
}

//发布留言
function commit(){
	$username = post('username');
	$email    = post('email');
	$uid	  = post('uid');
	$user_img = post('user_img');
	$contents = post('contents');

	$sql = "INSERT INTO content (`uid`,`email`,`user_img`,`content`,`creat_time`,`send_ip`,`is_display`,`is_delete`) VALUES ({$uid},'{$email}','{$user_img}','{$contents}','".time()."','".getIP()."','1','0')";
	echo $sql;
	$result = mysql_query( $sql );
	if($result){
		$msg = array("发布留言成功");
	}else{
		$msg = array("留言失败");
	}
	@mysql_free_result( $result );
	mysql_close();
	return $msg;
}

//回复留言
function reply(){
	$uid = post('uid');
	$gid = post('gid');
	$content = post('contents');
	$user_img = post('user_img');
	
	$sql = "INSERT INTO reply (`gid`,`uid`,`user_img`,`content`,`create_time`,`is_display`,`is_delete`,`reply_ip`) VALUES ('{$gid}','{$uid}','{$user_img}','{$content}','".time()."',1,0,'".getIP()."')";
	
	echo $sql;
	//die;
	$result = mysql_query( $sql );
	if($result){
		$msg = array("回复成功");
	}else{
		$msg = array("回复失败");
	}
	@mysql_free_result( $result );
	mysql_close();
	return $msg;
}

//删除留言
function delReply(){
	
}
?>

<div style="width:320px;height:110px;margin:100px auto; border:1px solid #ddd; border-radius:5px;line-height:110px;padding:10px;"><span><?php echo $msg[0]?></span><span id="time">5</span>s秒后自动跳转..</div>
<script>
setInterval(function(){
	var time = document.getElementById("time").innerHTML;
	if(time > 0){
		document.getElementById("time").innerHTML = time-1;
	}else{
		document.getElementById("time").innerHTML = time;
		window.location.href="<?php echo $back;?>";
	}
},1000);
</script>