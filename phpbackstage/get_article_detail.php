<?php
	header('Content-Type:text/html;charset=utf8');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	$userInfo = require_once('./sqlconfig.php');
	require_once('./sqlQuery.php');
	// 连接数据库
	$link = connect($userInfo['host'],$userInfo['user'],$userInfo['pass'],$userInfo['basename'],$userInfo['port']);
	$id=$_GET['articleId'];
	$sql_select = "SELECT * FROM article_content WHERE article_id='{$id}'";
	$result = query($link,$sql_select);
	if($result && mysqli_affected_rows($link)>0) {
		$res = mysqli_fetch_assoc($result);
		echo json_encode($res);
		mysqli_close($link);
	}
?>