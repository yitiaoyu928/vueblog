<?php
    header('Content-Type:application/json;charset=utf8');
    header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods:*');
    header('Access-Control-Allow-Headers:x-requested-with,content-type');
    $userID = $_POST['id'];
    $imgSrc = file_upload($_FILES['file']);
    $imgSrc = addslashes($imgSrc);
    if(!is_null($imgSrc) && !empty($userID)) {
        $sql_updata = "UPDATE user SET
                        user_pic='{$imgSrc}' WHERE id='{$userID}'
        ";
        require_once('./sqlQuery.php');
        $admin = require_once('./sqlconfig.php');
        $link = connect($admin['host'],$admin['user'],$admin['pass'],$admin['basename'],$admin['port']);
        $result = query($link,$sql_updata);
        if($result && mysqli_affected_rows($link)>0) {
            $sql_select = "SELECT * FROM user WHERE id='{$userID}'";
            $res = query($link,$sql_select);
            $data = mysqli_fetch_assoc($res);
            $data['user_pic'] = imageBase64($data['user_pic']);
            echo json_encode($data);
        }else {
            echo -1;
        }
    }





















    function imageBase64(string $imgSrc = './uploads_img/default.jpg') {
        $file = file_get_contents($imgSrc,true);
        $type = getimagesizefromstring($file)['mime'];
        $base_64 = 'data:'.$type.';base64,'.chunk_split(base64_encode($file));
        return $base_64;
    };
    function file_upload(array $fileInfo,string $storeDir='./uploads_img',array $allowExt = array('jpg','png','bmp','gif','jpeg'),$maxsize=2097152,$isImg = true) {
        define('UPLOAD_ERRS',[
            'no_allow_type'=>'不被允许的上传文件',
            'no_upload_file_select'=>'没有接收到文件',
            'lllegal_upload_file'=>'非法上传的文件',
            'move_error'=>'移动图片失败',
            'upload_system_error'=>'系统错误',
            'sham_image'=>'非真实图片',
            'exceed_max_size'=>'超出上传限制',
            'execcd_max_size_form'=>'超出HTML表单大小限制',
            'upload_file_fail'=>'部分文件上传失败'
        ]);
        if($fileInfo['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathInfo($fileInfo['name'],PATHINFO_EXTENSION));
            if(!in_array($ext,$allowExt)) {
                return UPLOAD_ERRS['no_allow_type'];
            }
            if($fileInfo['size']>$maxsize) {
                return UPLOAD_ERRS['exceed_max_size'];
            }
            if($isImg) {
                if(@!getimagesize($fileInfo['tmp_name'])) {
                    return UPLOAD_ERRS['sham_image'];
                }
            }
            if(!is_uploaded_file($fileInfo['tmp_name'])) {
                return UPLOAD_ERRS['lllegal_upload_file'];
            }
            if(!is_dir($storeDir)) {
                mkdir($storeDir,0777,true);
            }
            // 生成唯一ID
            $uniqID = md5(uniqid(time(),true));
            // 获取文件扩展名
            $dest = $storeDir.DIRECTORY_SEPARATOR.$uniqID.'.'.$ext;
            if(@!move_uploaded_file($fileInfo['tmp_name'], $dest)) {
                return UPLOAD_ERRS['move_error'];
            }
            return $dest;
        }else {
            switch($fileInfo['error']) {
                case 1:
                    $msg = UPLOAD_ERRS['exceed_max_size'];
                    break;
                case 2:
                    $msg = UPLOAD_ERRS['execcd_max_size_form'];
                    break;
                case 3:
                    $msg = UPLOAD_ERRS['upload_file_fail'];
                    break;
                case 4:
                    $msg = UPLOAD_ERRS['no_upload_file_select'];
                    break;
                case 6:
                case 7:
                case 8:
                    $msg = UPLOAD_ERRS['upload_system_error'];
                    break;
            }
            return $msg;
        }
    }
    // "array(1) {
    //     ["file"]=>
    //     array(5) {
    //       ["name"]=>
    //       string(29) "1_mk1-6aYaf_Bes1E3Imhc0A.jpeg"
    //       ["type"]=>
    //       string(10) "image/jpeg"
    //       ["tmp_name"]=>
    //       string(22) "C:\Windows\phpF4AE.tmp"
    //       ["error"]=>
    //       int(0)
    //       ["size"]=>
    //       int(193302)
    //     }
    //   }
    //   "
?>