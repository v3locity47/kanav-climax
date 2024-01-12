<?php // session_start(); header('Cache-control: private');
$pg_log=1; require('functions/connections.php'); $rt='<br>'?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Login</title>

<link href="themes/admin_av.css" rel="stylesheet" type="text/css">
<style type="text/css">
#login { width:500px; margin:15% auto 0 auto; background:#efefef; border:1px solid #d6d6d6; box-shadow:0px 0px 50px #c6c6c6; padding:30px 40px 40px 40px; border-radius:8px; }
#login input{ padding:5px; width:200px;} #login select{ padding:4px 5px; width:210px; }
#login div { font:27px Arial, Helvetica, sans-serif; color:#969696; padding:0; }
#login img {
	float: right;
	margin-top: 20px;
	opacity: 0.4;
}
</style>
<script type="text/javascript" src="themes/js/jq1.8.2.js"></script>
<script type="text/javascript" src="themes/js/validate.js"></script>
</head>

<body>
<?php
if(isset($_POST['btn_sub'])){

$rt='Error In Login Process';
$query="select * from sy_login where username='$user_nm' AND password='$user_ps' LIMIT 1";
	$result = mysql_query($query);
	if($result === FALSE) {
    die(mysql_error()); $move; 
	}else {
	$row=mysql_fetch_row($result);
   if($row['1']==$user_nm and $row['2']==$user_ps and $_POST['user_nm']!='' and $_POST['user_ps']!='') 
   { 
   $_SESSION['shop_user_id'] = $row['0'];
	$_SESSION["shop_user_name"]= $row['1'];
	?><script language="javascript">window.location="welcome.php";</script><?php
   }
   }

} ?>
<script type="text/javascript" src="themes/js/user.js"></script>
<form method="post" action="" name="log" id="login_frm">
<div id="login">
<div>Admin Login</div><img src="themes/img/logo.png" alt="Logo" width="140" height="135"><br><br>

<br>
<input type="text" name="user_nm" id="user_nm" placeholder="Username" class="required" autocomplete="off">
<br>
<br>
<input type="password" name="user_ps" id="user_ps" placeholder="Password" class="required" autocomplete="off">
<br><br><br>
<input name="btn_sub" id="btn_sub" type="submit" value="Login">
<span style="float:right; text-align:right; clear:right"><?=$rt?></span>
</div>
</form>
</body>
</html>
