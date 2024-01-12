<?php require("../functions/connections.php");
if(isset($_POST['w_to'])) {$ap=$_POST['v_nm'];
if($_FILES[$ap]["name"]!='') {
	require('uploader.class.php');
	echo sy_img('../'.$path,$ap,800,800);
	}
	}
if(isset($_POST['dl_ok'])) {
	sy_del('../',$_POST['dl_ok']);
	echo $_POST['dl_ok'];
	}?>