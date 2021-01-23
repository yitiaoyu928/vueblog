<?php
  header('Content-Type:text/html;charset=utf8');
			// 获取数据库信息
	$userInfo = require_once('./sqlconfig.php');
	require_once('./sqlQuery.php');
	// 连接数据库
	$link = connect($userInfo['host'],$userInfo['user'],$userInfo['pass'],$userInfo['basename'],$userInfo['port']);
	$sql_select = "SELECT * FROM gust_book WHERE book_id='1'";
	$res = queryAll($link,$sql_select);
	var_dump($res);
?>