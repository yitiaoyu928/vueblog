<?php
	function connect(string $host,string $name,string $pass,string $database,int $port) {
		$link = mysqli_connect($host,$name,$pass,$database,$port) or die('数据库连接错误');
		if(mysqli_connect_error()) {
			exit('数据库连接错误:'.mysqli_connect_errno().mysqli_connect_error());
		}
		mysqli_set_charset($link,'utf-8');
		return $link;
	}
	function query($link,$sql) {
		$result = mysqli_query($link,$sql);
		return $result;
	}
	function encrypt($str) {
		return md5(md5($str));
	}
	function queryAll($link,$sql) {
		$result = mysqli_query($link,$sql);
		$real_data = mysqli_fetch_all($result,MYSQLI_ASSOC);
		return $real_data;
	}
?>