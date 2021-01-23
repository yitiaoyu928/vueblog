<?php
	header('Content-Type:text/html');
	$sql_host='localhost';
	$sql_user = 'root';
	$sql_pass='wsyya';
	$sql_base = 'qgy_user';
	$sql_port = 3306;
	return [
		'host'=>$sql_host,
		'user'=>$sql_user,
		'pass'=>$sql_pass,
		'basename'=>$sql_base,
		'port'=>$sql_port
	];
?>
