<?php $tbl='sy_gallery';
$tit='Photo Gallery';
$add='1';
require('themes/uploader.class.php');
$path='../themes/upload/gallery/';$w=1000;$h=800; ?>
<?php require('themes/top.php'); ?>
<?php
$query=mysql_query("show COLUMNS from $tbl"); while($record = mysql_fetch_array($query)){ $expo_key[] = $record['0'];} 

 if(isset($_GET['act'])) { 
 		echo sy_vw();
 	//if(isset($_POST['submit'])){ $$expo_key[2]=sy_gal_img($path,$expo_key[2]);}
	
if(isset($_POST['submit'])){ $gal_img='';
					if($_FILES['gal_img']["name"]!=''){$gal_img=generate_resized_image('gal_img',$path,$w,$h); if(isset($old_gal_img)){unlink($path.DIRECTORY_SEPARATOR.$old_gal_img);}}else{if(isset($old_gal_img)){$gal_img=$old_gal_img;}};
	}
	
	//////////add 
if($act=='add'){if(isset($_POST['submit'])){ $rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= "'".$$val."'";}};mysql_query("insert into $tbl VALUES ('',".$rtq.")"); echo $mov;}}
				
	/////////edit	
if($act=='edit'){if(isset($_POST['submit'])){$rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= $val."='".$$val."'";}};mysql_query("update $tbl set ".$rtq." where $expo_key[0]='$id'");echo $mov;}
				else {$query_ed= mysql_query("select * from $tbl where $expo_key[0]='$id'"); $q_ed=mysql_fetch_object($query_ed);};
		}
				
      ///////delete
		if($act=='del'){mysql_query("delete from $tbl where $expo_key[0]='$id'"); sy_del($path,$del_gal_img); echo $mov;}?>
  <form action="?act=<?=$_GET['act']?>" method="post" enctype="multipart/form-data" id="apc">
	<?php if(isset($q_ed)){?><input type="hidden" name="id" value="<?=$id?>"><?php }?>
    <table width="700" border="0" cellspacing="0" cellpadding="10" class="bo_tbl" >
      <tr>
        <td width="106">Photo Album</td>
        <td width="304"><select  name="gal_menu_id"<?php if(isset($q_ed)){?> title="<?=$q_ed->gal_menu_id?>"<?php }?> >
          <?php $fuqw=mysql_query("select * from  sy_menu where menu_cat_type=3 order by menu_nm"); while($rty=mysql_fetch_object($fuqw)){?>
          <option value="<?=$rty->menu_id?>">
            <?=$rty->menu_nm?>
            </option>
          <?php } ?>
        </select></td>
</tr>
<tr>
        <td>Description</td>
        <td><input type="text" name="gal_des" <?php if(isset($q_ed)){?>value="<?=$q_ed->gal_des?>"<?php }?>></td></tr>
        <tr>
        <td>Photo</td>
        <td><input type="file" name="gal_img" ><?php if(isset($q_ed)){?><input type="hidden" name="old_gal_img" value="<?=$q_ed->gal_img?>"><img height="350" src="<?=$path.$q_ed->gal_img?>"><?php }?></td>
      </tr>
        <tr><td colspan="4" bgcolor="#eeeeee"><input type="submit" name="submit" value="Submit"></td></tr>
        </table></form>
     
<? }/*act ok*/ else {?>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td width="4%">S.No.</td>
    <td width="22%">Album</td>
    <td width="34%">Description</td>
    <td width="20%">Photo</td>
 
    <td width="20%">Action</td>
  </tr>
  <?php $qw= "select * from $tbl,sy_menu where menu_id=gal_menu_id order by $expo_key[0] desc ".$per_limit;
   $qw2= mysql_query($qw); while($row_par = mysql_fetch_object($qw2)) { ?>
  <tr>
    <td><?=++$i?></td>
    <td><?=$row_par->menu_nm?></td>
    <td><?=$row_par->{$expo_key[3]}?></td>
    <td><img height="50" src="<?=$path.$row_par->gal_img?>"></td>
     <td><a name="Edit" title="Edit <?=$row_par->{$expo_key[1]}?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>">Edit</a>
    <a name="Edit" title="View <?=$row_par->{$expo_key[1]}?>"  href="?act=edit&&id=<?=$row_par->{$expo_key[0]}?>&&view">View</a>
     <a name="Delete" title="Delete <?=$row_par->{$expo_key[1]}?>"  href="?act=del&&id=<?=$row_par->{$expo_key[0]}?>&&del_gal_img=<?=$row_par->{$expo_key[2]}?>">Delete</a></td>
  </tr><?php }?>
</table>




<?php } ?>
<?php require('themes/bot.php'); ?>