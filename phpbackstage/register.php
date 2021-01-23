<?php
	header('Content-Type:application/json;charset=utf8');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	require_once('./sqlQuery.php');

	$username = $_POST['username'];
	$password = encrypt($_POST['password']);
	$email = $_POST['email'];
	$nick = '鱼'.mt_rand();
	$regist_at = date('Y-m-d H:i:s');
	$login_at = date('Y-m-d H:i:s');
	$ip = $_SERVER['REMOTE_ADDR']==='::1'?'127.0.0.1':$_SERVER['REMOTE_ADDR'];
	$login_ip = ip2long($ip);
	$admin = require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'sqlconfig.php');
	$link = connect($admin['host'],$admin['user'],$admin['pass'],$admin['basename'],$admin['port']);
	$sql_insert = "INSERT INTO user(username,password,email,nick,login_at,login_ip,regist_at) VALUES('$username','$password','$email','$nick','$login_at','$login_ip','$regist_at')";
	$result = query($link,$sql_insert);
	switch(mysqli_affected_rows($link)) {
		case 1:
			echo '注册成功，请前往登录页登录';
			exit;
		case -1;
			echo '注册失败，请联系管理员';
	}
	
?>