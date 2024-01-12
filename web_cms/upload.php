<?php $tbl='sy_dow';
$tit='Upload File';
$add='1';
$expo_key=array('dow_id','dow_nm','dow_file','dow_cat_id');
$expo_nm=array('Id','File Name','Upload File','Category');
//require('themes/uploader.class.php');
$path='../themes/upload/files/';
 ?>
<?php require('themes/top.php'); ?>
<?php if(isset($_GET['act'])) { 
 		echo sy_vw();
 	if(isset($_POST['submit'])){ $$expo_key[2]=sy_img($path,$expo_key[2]);}

	
	//////////add 
if($act=='add'){if(isset($_POST['submit'])){ $rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= "'".$$val."'";}};mysql_query("insert into $tbl VALUES ('',".$rtq.")"); echo $mov;}}
				
	/////////edit	
if($act=='edit'){if(isset($_POST['submit'])){$rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= $val."='".$$val."'";}};mysql_query("update $tbl set ".$rtq." where $expo_key[0]='$id'");echo $mov;}
				else {$query_ed= mysql_query("select * from $tbl where $expo_key[0]='$id'"); $q_ed=mysql_fetch_object($query_ed);};
		}
				
      ///////delete
		if($act=='del'){mysql_query("delete from $tbl where $expo_key[0]='$id'"); sy_del($path,$del_img); echo $mov;}?>
  <form action="?act=<?=$_GET['act']?>" method="post" enctype="multipart/form-data" id="apc">
	<?php if(isset($q_ed)){?><input type="hidden" name="id" value="<?=$id?>"><?php }?>
    <table width="500" border="0" cellspacing="0" cellpadding="10" class="bo_tbl" >
   <tr>
   <tr>
           <td><?=$expo_nm[++$i]?></td>
           <td><input type="text" name="<?=$expo_key[$i]?>" class="required" <?php if(isset($q_ed)){?>value="<?=$q_ed->$expo_key[$i]?>"<?php }?>></td>
         </tr>
   <tr>
           <td>Category</td>
           <td>
           <select  name="dow_cat_id"<?php if(isset($q_ed)){?> title="<?=$q_ed->dow_cat_id?>"<?php }?> >
           	<?php $fuqw=mysql_query("select * from  sy_menu where menu_cat_type=1 order by menu_nm"); while($rty=mysql_fetch_object($fuqw)){?>
    	<option value="<?=$rty->menu_id?>"><?=$rty->menu_nm?></option>
		<?php } ?>
           </select>
           </td>
         </tr>
 	<tr>
           <td><?=$expo_nm[2]?></td>
           <td><input type="file" name="dow_file" >
           <?php if(isset($q_ed)){?><input type="hidden" name="olddow_file" value="<?=$q_ed->dow_file?>">
           <?php if($q_ed->dow_file!=''){?><a target="_blank" href="<?=$path.$q_ed->dow_file?>">View File</a><?php }}?>
           </td>
         </tr>
        <tr><td colspan="2" bgcolor="#eeeeee"><input type="submit" name="submit" value="Submit"></td></tr>
        </table></form>
     
<? }/*act ok*/ else {?>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td width="3%">S.No.</td>
    <td width="67%"><?=$expo_nm[1]?></td>
 
    <td width="30%">Action</td>
  </tr>
  <?php $qw= "select * from $tbl order by $expo_key[0] desc ".$per_limit;
   $qw2= mysql_query($qw); while($row_par = mysql_fetch_object($qw2)) { ?>
  <tr>
    <td><?=++$i?></td>
    <td><?=$row_par->$expo_key[1]?></td>
     <td><a name="Edit" title="Edit <?=$row_par->$expo_key[1]?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>">Edit</a>
    <a name="Edit" title="View <?=$row_par->$expo_key[1]?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>&&view">View</a>
     <a name="Delete" title="Delete <?=$row_par->$expo_key[1]?>"  href="?act=del&&id=<?=$row_par->$expo_key[0]?>&&del_img=<?=$row_par->$expo_key[2]?>">Delete</a></td>
  </tr><?php }?>
</table>




<?php } ?>
<?php require('themes/bot.php'); ?>