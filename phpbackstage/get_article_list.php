<?php
	header('Content-Type:text/html;charset=utf8');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	$userInfo = require_once('./sqlconfig.php');
	require_once('./sqlQuery.php');
	// 连接数据库
	$link = connect($userInfo['host'],$userInfo['user'],$userInfo['pass'],$userInfo['basename'],$userInfo['port']);
	$classify = $_GET['classify'];
	if($classify === '/home') {
		$sql_select = "SELECT * FROM article_list";
		$res = queryAll($link,$sql_select);
		echo json_encode($res);
	}
?>