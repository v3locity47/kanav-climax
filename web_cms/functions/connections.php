<?php 
ob_start();
// require_once '/home/climaxedu/public_html/vendor/autoload.php';
require_once 'C:\Users\vel\Downloads\climax\vendor\autoload.php';
session_start(); header('Cache-control: private');
define('SITEROOT','/');

//define('SITEROOT','/2015/climax/');
define("Root",SITEROOT."web_cms");

date_default_timezone_set('Asia/Kolkata');

define("SITE_NAME","Climax");

if(!isset($pg_log)){
if(isset($_GET['do']) or !isset($_SESSION['shop_user_id']) or !isset($_SESSION['shop_user_name']))
{
		unset($_SESSION['shop_user_id']);
		unset($_SESSION["shop_user_name"]);
 		
		?><script language="javascript"> window.location="<?=Root?>/index.php";</script>
		<?php
exit;}}
$mysql_connection=mysqli_connect("localhost","root","root", "climaxedu", 3306);
mysqli_select_db($mysql_connection, "climaxedu");
//mysqli_select_db("climax",mysqli_connect("localhost","root",""));



  $chl_str = array ('Ã¡','Ã‚','Ã¢','Ã†','Ã¦','Ã€','Ã ','Ã…','Ã¥','Ãƒ','Ã£','Ã"','Ã¤','Ã‡','Ã§','Ã‰','Ã©','ÃŠ','Ãª','Ãˆ','Ã»','Ã™','Ã¹','Ãœ','Ã¼','Ã','Ã½','Ã¿','Å¸','Ä›','Äš','Å¡','Å ','Ä','ÄŒ','Å™','Å˜','Å¾','Å½','Ã½','Ã','Ã¡','Ã','Ã­','Ã','Ã©','Ã‰','Ãº','Å¯','Å®','Ä','ÄŽ','Å¥','Å¤','Åˆ','Å‡','<html>','</html>','<title>','</title>','<body>','</body>','<head>','</head>','^',);

 
	foreach ($_POST as $key => $value) {
		//if (isset($$key)) continue;
		$$key=str_replace($chl_str,'',$value);
		$$key=mysqli_real_escape_string($$key);/*NEW*/
		//$$key = $value;
	}
	
foreach ($_GET as $a => $b) {
    //if (isset($$a)) continue;

    $$a = $b;
}

$i=0;
$mov="<script language='javascript'>window.location='".$_SERVER['PHP_SELF']."';</script>";


	
function menu_ls(){ global $menu_type; $fuqw=mysqli_query("select * from  sy_menu order by menu_nm"); while($rty=mysqli_fetch_object($fuqw)){?>
    	<option value="<?=$rty->menu_id?>"><?=$rty->menu_nm?></option>
	<?php } }


function order_ls(){?><option value="250">Default</option><?php for($i=0;$i<=20;$i++){?><option value="<?=$i?>"><?=$i?></option><?php } }
function menu_parent_ls($ttg){if($ttg==0){echo'Main Category';}else{$tg=mysqli_query("select menu_nm from sy_menu where menu_id='$ttg'");$tg=mysqli_fetch_object($tg);echo$tg->menu_nm;}}


$u_order= array(0=>'Male',1=>'Female');
$u_yn= array(0=>'Yes',1=>'No');
$u_cat_typ= array(0=>'None',1=>'Download',3=>'Photo Album',6=>'Feedback',7=>'News',8=>'Student',9=>'Faculty');

function sy_fary($arrfy,$slp){if(!isset($slp)){$slp='';};foreach($arrfy as $key => $val){?><option <?php if($slp==$key)echo'selected'?> value="<?=$key?>"><?=$val?></option><?php }}

function sy_vw(){ global $dom_ready;
if(!isset($dom_ready)){?><script>$(document).ready(function(){sel_slct();<?php }
if(isset($_GET['view'])){?>
sel_slct();$("#apc input:text, #apc textarea, #apc select").each(function(){
													if($(this).prop("type") == "select-one" ){$(this).before($(this).find("option:selected").text());} 
													else if($(this).attr("placeholder")){$(this).before("<strong>"+$(this).attr("placeholder")+"</strong> : "+$(this).val());}
													else{$(this).before($(this).val())}
													$(this).hide();
													});
										$("#apc input[type=submit],#apc input[type=file],input:checkbox,.del_pic").hide();
										
		<?php };
if(!isset($dom_ready)){?>})</script><?php }
}

function sy_dt($sy_ndt){
	$sy_a='-';
	if($sy_ndt!=''){
	if(strpos($sy_ndt, '/')){$sy_ndt = str_replace('/', '-', $sy_ndt);$sy_a='/';}
	$sy_cdk=substr($sy_ndt, 0, 4); $sy_cdk2=(int)$sy_cdk;
	if((string)$sy_cdk==(string)$sy_cdk2){$sy_ndt=date('d'.$sy_a.'m'.$sy_a.'Y', strtotime($sy_ndt));
	if((string)$sy_ndt==(string)'01-01-1970'){$sy_ndt='00'.$sy_a.'00'.$sy_a.'0000';}
	}
	else {$sy_ndt=date('Y-m-d', strtotime($sy_ndt));
			if((string)$sy_ndt==(string)'1970-01-01'){
				$neup = DateTime::createFromFormat('m/d/Y', $dt, new DateTimeZone('Europe/Warsaw'));
				$sy_ndt= date_format($neup, 'Y-m-d');
				}
	
	}
	}else{$sy_ndt=date('d-m-Y');}
	return $sy_ndt;
}

function sy_encode($action, $string) {
   $output = false;
   $key = 'lsdgfsv lsfgsdlh lksdjgs lghsdh kjsdfhgkl sdhflkgh klsdhgjkh kdjf';
   $iv = md5(md5($key));

   if( $action == 'e' ) {
       $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
       $output = base64_encode($output);
   }
   else if( $action == 'd' ){
       $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
       $output = rtrim($output);
   }
   return $output;
}
function sy_del($npath,$nfile){if(file_exists($npath.DIRECTORY_SEPARATOR.$nfile) and $nfile!=''){unlink($npath.DIRECTORY_SEPARATOR.$nfile);}}
function sy_img($path,$nm){ $file=$nm;
	if($_FILES[$nm]["name"]!=''){
			$ext = pathinfo(strtolower($_FILES[$nm]["name"]), PATHINFO_EXTENSION);
			$rand=rand(100000,999999);
			$col_file=$rand.'.'.$ext;
			move_uploaded_file($_FILES[$nm]["tmp_name"], $path.$col_file);
			$nm=$col_file;
			
		if(isset($_POST['old'.$file])){sy_del($path,$_POST['old'.$file]);}
	}else{$nm=$_POST['old'.$file];} return $nm;
}
// Get Menu List
function sy_menu_w($j,$re,$attr=NULL){
	$qry=mysqli_query($GLOBALS['mysql_connection'],"select * from sy_menu where menu_parent='$j'order by menu_order");
if(mysqli_num_rows($qry)>0){
	
	
	
	echo'<ul '.$attr.'>';$j='</ul>';}

while($gh=mysqli_fetch_object($qry)){
	 
		?> 
<li><a  title="<?=$gh->menu_nm?>" <?php if(strlen($gh->menu_txt)>10 || $gh->menu_cat_type!=0 || $gh->sub_menu_status==1){
	
	?>
href="
<?php if($gh->menu_id==1){echo'index.php';}else{echo menu_url($gh->menu_id); }?>
"<?php } ?>><?=$gh->menu_nm?></a><?php if($re==1 && $gh->sub_menu_status!=1){sy_menu_w($gh->menu_id,$re,'class="dropdown-menu"');}?></li><?php 
}
if($j=='</ul>'){echo $j;}
};

//Get Parent Menu
 
function menu_url($id){
	$sql=mysqli_query("select * from sy_menu where menu_id='$id'");
	$ro=mysqli_fetch_object($sql);
	return preg_replace('/[^a-zA-Z0-9\s]/', '', $ro->menu_nm).'/'.$ro->menu_id; 
}

 
function sy_gt_parents($gh,$hj,$synm){  
if($gh!=0){ 
	$nqry=mysqli_query("select * from sy_menu where menu_id='$gh'"); $dtro=mysqli_fetch_object($nqry);if($hj!=0){ echo  "<span>".$dtro->menu_nm.$synm."</span>";}else{echo $dtro->menu_nm; }
	 if($hj!=0){sy_gt_parents($dtro->menu_parent,$hj,$synm);}
	 }
 
}

$u_country =array ( 0 => "Afghanistan", 1 => "Albania", 2 => "Algeria", 3 => "American Samoa", 4 => "Andorra", 5 => "Angola", 6 => "Anguilla", 7 => "Antarctica", 8 => "Antigua and/or Barbuda", 9 => "Argentina", 10 => "Armenia", 11 => "Aruba", 12 => "Australia", 13 => "Austria", 14 => "Azerbaijan", 15 => "Bahamas", 16 => "Bahrain", 17 => "Bangladesh", 18 => "Barbados", 19 => "Belarus", 20 => "Belgium", 21 => "Belize", 22 => "Benin", 23 => "Bermuda", 24 => "Bhutan", 25 => "Bolivia", 26 => "Bosnia and Herzegovina", 27 => "Botswana", 28 => "Bouvet Island", 29 => "Brazil", 30 => "British lndian Ocean Territory", 31 => "Brunei Darussalam", 32 => "Bulgaria", 33 => "Burkina Faso", 34 => "Burundi", 35 => "Cambodia", 36 => "Cameroon", 37 => "Canada", 38 => "Cape Verde", 39 => "Cayman Islands", 40 => "Central African Republic", 41 => "Chad", 42 => "Chile", 43 => "China", 44 => "Christmas Island", 45 => "Cocos (Keeling) Islands", 46 => "Colombia", 47 => "Comoros", 48 => "Congo", 49 => "Cook Islands", 50 => "Costa Rica", 51 => "Croatia (Hrvatska)", 52 => "Cuba", 53 => "Cyprus", 54 => "Czech Republic", 55 => "Denmark", 56 => "Djibouti", 57 => "Dominica", 58 => "Dominican Republic", 59 => "East Timor", 60 => "Ecudaor", 61 => "Egypt", 62 => "El Salvador", 63 => "Equatorial Guinea", 64 => "Eritrea", 65 => "Estonia", 66 => "Ethiopia", 67 => "Falkland Islands (Malvinas)", 68 => "Faroe Islands", 69 => "Fiji", 70 => "Finland", 71 => "France", 72 => "France, Metropolitan", 73 => "French Guiana", 74 => "French Polynesia", 75 => "French Southern Territories", 76 => "Gabon", 77 => "Gambia", 78 => "Georgia", 79 => "Germany", 80 => "Ghana", 81 => "Gibraltar", 82 => "Greece", 83 => "Greenland", 84 => "Grenada", 85 => "Guadeloupe", 86 => "Guam", 87 => "Guatemala", 88 => "Guinea", 89 => "Guinea-Bissau", 90 => "Guyana", 91 => "Haiti", 92 => "Heard and Mc Donald Islands", 93 => "Honduras", 94 => "Hong Kong", 95 => "Hungary", 96 => "Iceland", 97 => "India", 98 => "Indonesia", 99 => "Iran (Islamic Republic of)", 100 => "Iraq", 101 => "Ireland", 102 => "Israel", 103 => "Italy", 104 => "Ivory Coast", 105 => "Jamaica", 106 => "Japan", 107 => "Jordan", 108 => "Kazakhstan", 109 => "Kenya", 110 => "Kiribati", 111 => "kjljl", 112 => "Korea, Democratic People's Republic of", 113 => "Korea, Republic of", 114 => "Kuwait", 115 => "Kyrgyzstan", 116 => "Lao People's Democratic Republic", 117 => "Latvia", 118 => "Lebanon", 119 => "Lesotho", 120 => "Liberia", 121 => "Libyan Arab Jamahiriya", 122 => "Liechtenstein", 123 => "Lithuania", 124 => "Luxembourg", 125 => "Macau", 126 => "Macedonia", 127 => "Madagascar", 128 => "Malawi", 129 => "Malaysia", 130 => "Maldives", 131 => "Mali", 132 => "Malta", 133 => "Marshall Islands", 134 => "Martinique", 135 => "Mauritania", 136 => "Mauritius", 137 => "Mayotte", 138 => "Mexico", 139 => "Micronesia, Federated States of", 140 => "Moldova, Republic of", 141 => "Monaco", 142 => "Mongolia", 143 => "Montserrat", 144 => "Morocco", 145 => "Mozambique", 146 => "Myanmar", 147 => "Namibia", 148 => "Nauru", 149 => "Nepal", 150 => "Netherlands", 151 => "Netherlands Antilles", 152 => "New Caledonia", 153 => "New Zealand", 154 => "Nicaragua", 155 => "Niger", 156 => "Nigeria", 157 => "Niue", 158 => "Norfork Island", 159 => "Northern Mariana Islands", 160 => "Norway", 161 => "Oman", 162 => "Pakistan", 163 => "Palau", 164 => "Panama", 165 => "Papua New Guinea", 166 => "Paraguay", 167 => "Peru", 168 => "Philippines", 169 => "Pitcairn", 170 => "Poland", 171 => "Portugal", 172 => "Puerto Rico", 173 => "Qatar", 174 => "Reunion", 175 => "Romania", 176 => "Russian Federation", 177 => "Rwanda", 178 => "Saint Kitts and Nevis", 179 => "Saint Lucia", 180 => "Saint Vincent and the Grenadines", 181 => "Samoa", 182 => "San Marino", 183 => "Sao Tome and Principe", 184 => "Saudi Arabia", 185 => "Senegal", 186 => "Seychelles", 187 => "Sierra Leone", 188 => "Singapore", 189 => "Slovakia", 190 => "Slovenia", 191 => "Solomon Islands", 192 => "Somalia", 193 => "South Africa", 194 => "South Georgia South Sandwich Islands", 195 => "Spain", 196 => "Sri Lanka", 197 => "St. Helena", 198 => "St. Pierre and Miquelon", 199 => "Sudan", 200 => "Suriname", 201 => "Svalbarn and Jan Mayen Islands", 202 => "Swaziland", 203 => "Sweden", 204 => "Switzerland", 205 => "Syrian Arab Republic", 206 => "Taiwan", 207 => "Tajikistan", 208 => "Tanzania, United Republic of", 209 => "Thailand", 210 => "Togo", 211 => "Tokelau", 212 => "Tonga", 213 => "Trinidad and Tobago", 214 => "Tunisia", 215 => "Turkey", 216 => "Turkmenistan", 217 => "Turks and Caicos Islands", 218 => "Tuvalu", 219 => "Uganda", 220 => "Ukraine", 221 => "United Arab Emirates", 222 => "United Kingdom", 223 => "United States", 224 => "United States minor outlying islands", 225 => "Uruguay", 226 => "Uzbekistan", 227 => "Vanuatu", 228 => "Vatican City State", 229 => "Venezuela", 230 => "Vietnam", 231 => "Virgin Islands (U.S.)", 232 => "Virigan Islands (British)", 233 => "Wallis and Futuna Islands", 234 => "Western Sahara", 235 => "Yemen", 236 => "Yugoslavia", 237 => "Zaire", 238 => "Zambia", 239 => "Zimbabwe");

// mail function
if(isset($_GET['m_sub'])) {

$message="";foreach ($_POST as $key => $value) {if(isset($$key)){$message .=$key.":-<B>".$value."</B> <br><br>";}}
$RecepientName = 'avinashsaini37gmail.com';//reciver
  
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "To: ".$RecepientName."\r\n";
$headers .= "From: ". $_POST['Email'] ."\r\n";
mail($_GET['Name'] , $_GET['m_sub'].' ('.SITE_NAME.')' , $message , $headers) ; 
 
?><script type="text/javascript">alert("Your details is Successfully send.!"); window.location='<?=$_GET['ur']?>'; </script><?php 
}

$db_con='yes';
?>