<?php $tbl='sy_menu';
$tit='Pages';
$add='1';
$expo_key=array('menu_id','menu_parent','menu_nm','menu_order','menu_txt','menu_img','sub_menu_status','menu_cat_type');
$expo_nm=array('Id','Category','Name','Order','Text','Image','Sub Menu');
require('themes/uploader.class.php');
$path='../themes/upload/pages/';$w=200;$h=200;
 ?>
<?php require('themes/top.php'); ?>
<?php if(isset($_GET['act'])) { 
 		echo sy_vw();
	
	if(isset($_POST['submit'])){ $menu_img='';
					if($_FILES['menu_img']["name"]!=''){$menu_img=generate_resized_image('menu_img',$path,$w,$h); if(isset($old_menu_img)){unlink($path.DIRECTORY_SEPARATOR.$old_menu_img);}}else{if(isset($old_menu_img)){$menu_img=$old_menu_img;}};
	}

	
	//////////add 
if($act=='add'){if(isset($_POST['submit'])){ $rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= "'".$$val."'";}};mysql_query("insert into $tbl VALUES ('',".$rtq.")"); echo $mov;}}
				
	/////////edit	
if($act=='edit'){if(isset($_POST['submit'])){$rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= $val."='".$$val."'";}};mysql_query("update $tbl set ".$rtq." where $expo_key[0]='$id'");echo $mov;}
				else {$query_ed= mysql_query("select * from $tbl where $expo_key[0]='$id'"); $q_ed=mysql_fetch_object($query_ed);};
		}
				
      ///////delete
		if($act=='del'){mysql_query("delete from $tbl where $expo_key[0]='$id'"); echo $mov;}?>
  <form action="?act=<?=$_GET['act']?>" method="post" enctype="multipart/form-data" id="apc">
	<?php if(isset($q_ed)){?><input type="hidden" name="id" value="<?=$id?>"><?php }?>
     
    <table width="850px" border="0" cellspacing="0" cellpadding="10" class="bo_tbl" >
   <tr>
           <td>Category</td>
           <td><select name="menu_parent" class="required" <?php if(isset($q_ed)){?>title="<?=$q_ed->menu_parent?>"<?php }?>><option value="0">Main Category</option><?=menu_ls()?></select></td>
           <td>Name</td>
           <td><input type="text" name="menu_nm" class="required" <?php if(isset($q_ed)){?>value="<?=$q_ed->menu_nm?>"<?php }?>></td>
           <td>Type</td>
           <td><select name="menu_cat_type" <?php if(isset($q_ed)){?>title="<?=$q_ed->menu_cat_type?>"<?php }?>>
             <?=sy_fary($u_cat_typ)?>
           </select></td>
         </tr>


   <tr>
           <td colspan="6"><textarea style="height:400px" name="menu_txt" class="editor"><?php if(isset($q_ed)){?><?=$q_ed->menu_txt?><?php }?></textarea></td>
         </tr>
   <tr>
           <td>Photo</td>
           <td><input type="file" name="menu_img" ><?php if(isset($q_ed)){?><input type="hidden" name="old_menu_img" value="<?=$q_ed->menu_img?>"><img src="<?=$path.$q_ed->menu_img?>"><?php }?></td>
           <td>Order</td>
           <td><select name="menu_order" <?php if(isset($q_ed)){?>title="<?=$q_ed->menu_order?>"<?php }?>>
             <?=order_ls()?>
           </select></td>
           <td>Sub&nbsp;Menu</td>
           <td><select name="sub_menu_status" <?php if(isset($q_ed)){?> title="<?=$q_ed->sub_menu_status?>"<?php }?>>
             <?=sy_fary($u_yn)?>
           </select></td>
         </tr>



        <tr><td colspan="6" bgcolor="#eeeeee"><input type="submit" name="submit" value="Submit"></td>
        </table></form>
        
       

     
<?php }/*act ok*/ else {?>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td width="5%">S.No.</td>
    <td width="25%"><?=$expo_nm[1]?></td>
        <td width="40%"><?=$expo_nm[2]?></td>

    <td width="30%">Action</td>
  </tr>
  <?php $qw= "select * from $tbl order by $expo_key[0] desc ".$per_limit;
   $qw2= mysql_query($qw); while($row_par = mysql_fetch_object($qw2)) { ?>
  <tr>
    <td><?=++$i?></td>
    <td><?=menu_parent_ls($row_par->$expo_key[1])?></td>
    <td><?=$row_par->{$expo_key[2]}?></td>
    <td><a name="Edit" title="Edit <?=$row_par->{$expo_key[2]}?>"  href="?act=edit&&id=<?=$row_par->{$expo_key[0]}?>">Edit</a>
    <a name="Edit" title="View <?=$row_par->{$expo_key[2]}?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>&&view">View</a>
     <a name="Delete" title="Delete <?=$row_par->{$expo_key[2]}?>"  href="?act=del&&id=<?=$row_par->{$expo_key[0]}?>">Delete</a></td>
  </tr><?php }?>
</table>




<?php } ?>
<?php require('themes/bot.php'); ?>