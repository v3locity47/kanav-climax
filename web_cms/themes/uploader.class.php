<?php
function generate_resized_image($kc,$up_path,$w_f,$h_f){
	
$max_dimension = $w_f; // Max new width or height, can not exceed this value.
//$dir = "../../themes/upload/"; // Directory to save resized image. (Include a trailing slash - /)
$dir =$up_path;
// Collect the post variables.
$postvars = array(
"image"    => trim($_FILES[$kc]["name"]),
"image_tmp"    => $_FILES[$kc]["tmp_name"],
"image_size"    => (int)$_FILES[$kc]["size"],

"image_max_width"    => (int)$w_f,
"image_max_height"   => (int)$h_f
);
// Array of valid extensions.
$valid_exts = array("jpg","jpeg","gif","png");
// Select the extension from the file.
//$ext = end(explode(".",strtolower(trim($_FILES[$kc]["name"]))));
//$yutp=strtolower($_FILES[$kc]["name"]);
$ext = pathinfo(strtolower($_FILES[$kc]["name"]), PATHINFO_EXTENSION);


// Check not larger than 175kb.
if($postvars["image_size"] <= 17920000){
// Check is valid extension.
if(in_array($ext,$valid_exts)){
if($ext == "jpeg" || $ext == "jpg"){
 $image = imagecreatefromjpeg($postvars["image_tmp"]);
}
 if($ext == "gif"){
 $image = imagecreatefromgif($postvars["image_tmp"]);
}
 if($ext == "png"){
 $image = imagecreatefrompng($postvars["image_tmp"]);
}
 $image;
// Grab the width and height of the image.
list($width,$height) = getimagesize($postvars["image_tmp"]);
// If the max width input is greater than max height we base the new image off of that, otherwise we
// use the max height input.
// We get the other dimension by multiplying the quotient of the new width or height divided by
// the old width or height.
if($postvars["image_max_width"] > $postvars["image_max_height"]){
if($postvars["image_max_width"] > $max_dimension){
$newwidth = $max_dimension;
} else {
$newwidth = $postvars["image_max_width"];
}
$newheight = ($newwidth / $width) * $height;
} else {
if($postvars["image_max_height"] > $max_dimension){
$newheight = $max_dimension;
} else {
$newheight = $postvars["image_max_height"];
}
 $newwidth = ($newheight / $height) * $width;
}
// Create temporary image file.
 $tmp = imagecreatetruecolor($newwidth,$newheight);
// Copy the image to one with the new width and height.
imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height);
// Create random 4 digit number for filename.
//$rand = rand(1000,9999);
$photo = rand(100,999999999).'.'.$ext; 
$filename = $dir.$photo;

// Create image file with 100% quality.
imagejpeg($tmp,$filename,60);

//return $ext;
imagedestroy($image);
imagedestroy($tmp);
return $photo;
} else {
return "error";
}
} else {
return "error";
}
}

?>