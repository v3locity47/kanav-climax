<?php $tbl='sy_user_upload';
$tit='Application Form';
 require('themes/uploader.class.php');
$path='../themes/upload/user_doc/';?>
<?php require('themes/top.php'); ?>
<?php
$query=mysql_query("show COLUMNS from $tbl"); while($record = mysql_fetch_array($query)){ $expo_key[] = $record['0'];} 

 if(isset($_GET['act'])) { 
 		echo sy_vw();
 	//if(isset($_POST['submit'])){ $$expo_key[2]=sy_msg_img($path,$expo_key[2]);}
	
 
	
	//////////add 
       ///////delete
		if($act=='del'){mysql_query("delete from $tbl where $expo_key[0]='$id'"); sy_del($path,$del_msg_img); echo $mov;}?>
  <form action="?act=<?=$_GET['act']?>" method="post" enctype="multipart/form-data" id="apc">
	<?php if(isset($q_ed)){?><input type="hidden" name="id" value="<?=$id?>"><?php }?>
    <table width="700" border="0" cellspacing="0" cellpadding="10" class="bo_tbl" >
<tr>
  <td>Heading</td>
  <td><input type="text" name="msg_head" class="required" <?php if(isset($q_ed)){?>value="<?=$q_ed->msg_head?>"<?php }?>></td>
</tr>
<tr>
        <td width="106">Message</td>
        <td width="304"><textarea name="msg_tx" class="required"> <?php if(isset($q_ed)){echo $q_ed->msg_tx;}?></textarea></td></tr>
        <tr>
        <td>Photo</td>
        <td><input type="file" name="msg_img" ><?php if(isset($q_ed)){?><input type="hidden" name="old_msg_img" value="<?=$q_ed->msg_img?>"><img src="<?=$path.$q_ed->msg_img?>" width="100"><?php }?></td>
      </tr>
        <tr><td colspan="4" bgcolor="#eeeeee"><input type="submit" name="submit" value="Submit"></td></tr>
        </table></form>
     
<? }/*act ok*/ else {?>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td width="4%">S.No.</td>
    <td width="16%">Name</td>
    <td width="41%">Description</td>
 <td width="11%">Application Form</td>
    <td width="28%">Action</td>
  </tr>
  <?php $qw= "select * from $tbl order by $expo_key[0] desc ".$per_limit;
   $qw2= mysql_query($qw); while($row_par = mysql_fetch_object($qw2)) { ?>
  <tr>
    <td><?=++$i?></td>
    <td><?=$row_par->up_name?></td>
    <td><?=$row_par->up_description?></td>
    <td><a target="_blank" href="<?=$path?><?=$row_par->up_file?>">View Form</a></td>
     <td><a name="Edit" title="Edit <?=$row_par->$expo_key[1]?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>">Edit</a>
    <a name="Edit" title="View <?=$row_par->$expo_key[1]?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>&&view">View</a>
     <a name="Delete" title="Delete <?=$row_par->$expo_key[1]?>"  href="?act=del&&id=<?=$row_par->$expo_key[0]?>&&del_msg_img=<?=$row_par->$expo_key[3]?>">Delete</a></td>
  </tr><?php }?>
</table>




<?php } ?>
<?php require('themes/bot.php'); ?>