<?php
	header('Content-Type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	$userInfo = require_once('./sqlconfig.php');
	require_once('./sqlQuery.php');
	// 连接数据库
	$link = connect($userInfo['host'],$userInfo['user'],$userInfo['pass'],$userInfo['basename'],$userInfo['port']);
	$book_id = $_GET['id'];
	$sql_select = "SELECT * FROM gust_book WHERE book_id='{$book_id}'";
	$result = queryAll($link,$sql_select);
	if($result && mysqli_affected_rows($link)>0) {
		echo json_encode($result);
	}else {
		echo -1;
	}
?>