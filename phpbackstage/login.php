<?php
	header('Content-Type:application/json;charset=utf8');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	// 用户传递数据
	$username = $_POST['username'];
	$password = $_POST['password'];
	// 用户登录IP
	$ip = $_SERVER['REMOTE_ADDR'] === '::1'?'127.0.0.1':$_SERVER['REMOTE_ADDR'];
	$login_ip = ip2long($ip);
	// 用户登录时间
	$login_at = date('Y-m-d H:i:s');
	// 判断用户传输信息受否完整
	if(empty($username) || empty($password)) {
		echo '用户信息不完整';
		exit;
	}
	// 获取数据库信息
	$userInfo = require_once('./sqlconfig.php');
	require_once('./sqlQuery.php');
	$md5_password = encrypt($password);
	// 连接数据库
	$link = connect($userInfo['host'],$userInfo['user'],$userInfo['pass'],$userInfo['basename'],$userInfo['port']);
	// 查询用户信息
	$sql_select = "SELECT id,username,nick,login_at,login_ip,message_num,user_level,user_pic FROM user WHERE `username`='$username'AND`password`='$md5_password'";
	$result = query($link,$sql_select);
	$detail_result = mysqli_fetch_assoc($result);
	$detail_result['login_ip'] = long2ip($detail_result['login_ip']);
	$id = $detail_result['id'];
	if(is_null($detail_result['user_pic'])) {
		$file = file_get_contents('uploads_img/default.jpeg',true);
		$type = getimagesizefromstring($file)['mime'];
		$base_64 = 'data:'.$type.';base64,'.chunk_split(base64_encode($file));
		$detail_result['user_pic'] = $base_64;
	}else {
		$file = file_get_contents($detail_result['user_pic'],true);
		$type = getimagesizefromstring($file)['mime'];
		$base_64 = 'data:'.$type.';base64,'.chunk_split(base64_encode($file));
	}
	if($result && mysqli_affected_rows($link)>0) {
		$detail_result['user_pic'] = $base_64;
		echo json_encode($detail_result);
	}else {
		echo -1;
	}
	$sql_update = "UPDATE user SET `login_at`='$login_at',`login_ip` = '$login_ip' WHERE `id`= '$id'";
	$update_result = query($link,$sql_update);
	if(!$result && !mysqli_affected_rows($result)) {
		die('服务器错误');
	}
?>