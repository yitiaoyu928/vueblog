<?php
	header('Content-Type:application/json;charset=utf8');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	require_once('./sqlQuery.php');
	$nick=$_POST['nick'];
	if(empty($nick)) {
		echo -1;
		exit;
	}
	$id = $_POST['id'];
	$admin = require_once('./sqlconfig.php');
	$link = connect($admin['host'],$admin['user'],$admin['pass'],$admin['basename'],$admin['port']);
	$sql_update = "UPDATE user SET `nick`='$nick' WHERE `id`='$id'";
	$result = query($link,$sql_update);
	if($result && mysqli_affected_rows($link)) {
		$sql_select = "SELECT id,username,nick,login_at,login_ip,message_num,user_level,user_pic FROM user WHERE `id`='$id'";
		$new_result = query($link,$sql_select);
		$detail_result = mysqli_fetch_assoc($new_result);
		$detail_result['user_pic'] = imageBase64($detail_result['user_pic']);
		$detail_result['login_ip'] = long2ip($detail_result['login_ip']);
		echo json_encode($detail_result);
	}


	function imageBase64(string $imgSrc = './uploads_img/default.jpg') {
        $file = file_get_contents($imgSrc,true);
        $type = getimagesizefromstring($file)['mime'];
        $base_64 = 'data:'.$type.';base64,'.chunk_split(base64_encode($file));
        return $base_64;
    };
?>