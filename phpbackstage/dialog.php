<?php
	header('Content-Type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	$book_id = $_POST['id'];
	$nick = $_POST['nick'];
	$leave_time = date('Y-m-d H:i:s');
	$gust_message = $_POST['gust_message'];
	$u_id = $_POST['u_id'];
	$u_message = $_POST['message_num'];
	$u_message = $u_message+1;
		// 获取数据库信息
	$userInfo = require_once('./sqlconfig.php');
	require_once('./sqlQuery.php');
	// 连接数据库
	$link = connect($userInfo['host'],$userInfo['user'],$userInfo['pass'],$userInfo['basename'],$userInfo['port']);
	$sql_insert = "INSERT INTO gust_book(book_id,gust_message,leave_time,nick,user_id) 
					VALUES('{$book_id}','{$gust_message}','{$leave_time}','{$nick}','{$u_id}')";
	$result = query($link,$sql_insert);
	if($result && mysqli_affected_rows($link)>0) {
		// 更新用户数据表
		$user_select = "UPDATE user SET message_num='{$u_message}' WHERE id='{$u_id}'";
		$u_res = query($link,$user_select);
		if($u_res && mysqli_affected_rows($link)>=0) {
			// 查询本篇文章所有留言
			$sql_select = "SELECT * FROM gust_book WHERE book_id='{$book_id}'";
			$res = queryAll($link,$sql_select);
			if($res && mysqli_affected_rows($link)>0) {
				$u_select = "SELECT message_num FROM user WHERE id='{$u_id}'";
				$u_res_message = query($link,$u_select);
				if($u_res_message && mysqli_affected_rows($link)) {
					$message_num = mysqli_fetch_assoc($u_res_message)['message_num'];
					$res['message_num'] = $message_num;
					echo json_encode($res);
				}else {
					echo -1;
				}
			}else {
				echo -1;
			}
		}
	}else {
		echo -1;
	}
?>