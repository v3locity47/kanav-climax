<?php $tbl='sy_news';
$tit='News';
$add='1';
$expo_nm=array('News ID','News','News Date','Upload File','Category');
$path='../themes/upload/news/';
?>
<?php require('themes/top.php'); ?>
<?php $query=mysql_query("show COLUMNS from $tbl"); while($record = mysql_fetch_array($query)){ $expo_key[] = $record['0'];} ?>

<?php if(isset($_GET['act'])) { 
if(isset($_POST['submit'])){$news_dt=sy_dt($news_dt);};
	
	echo sy_vw();
	if(isset($_POST['submit'])){ $$expo_key[3]=sy_img($path,$expo_key[3]);}
	//////////add 
if($act=='add'){if(isset($_POST['submit'])){ $rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= "'".$$val."'";}};mysql_query("insert into $tbl VALUES ('',".$rtq.")"); echo $mov;}}
				
	/////////edit	
if($act=='edit'){if(isset($_POST['submit'])){$rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= $val."='".$$val."'";}};mysql_query("update $tbl set ".$rtq." where $expo_key[0]='$id'");echo $mov;}
				else {$query_ed= mysql_query("select * from $tbl where $expo_key[0]='$id'"); $q_ed=mysql_fetch_object($query_ed);};
		}
				
      ///////delete
		if($act=='del'&& isset($del_img)){mysql_query("delete from $tbl where $expo_key[0]='$id'"); sy_del($path,$del_img); echo $mov;}?>
    
    <form action="?act=<?=$_GET['act']?>" method="post" enctype="multipart/form-data">
	<?php $q=0; if(isset($q_ed)){?><input type="hidden" name="id" value="<?=$id?>"><?php }?>
    <table width="800" border="0" cellspacing="0" cellpadding="10" class="bo_tbl" id="apc">
   <tr>
           <td><?=$expo_nm[++$q]?></td>
           <td><textarea name="<?=$expo_key[$q]?>" class="required"><?php if(isset($q_ed)){echo $q_ed->$expo_key[$q]; }?></textarea></td>
   </tr>
   <tr>
           <td><?=$expo_nm[++$q]?></td>
           <td><input type="text" name="<?=$expo_key[$q]?>" class="dt" <?php if(isset($q_ed)){?>value="<?php if($q_ed->$expo_key[$q]!='0000-00-00'){echo sy_dt($q_ed->$expo_key[$q]);}?>"<?php }?>></td>
   </tr>
   	<tr>
           <td><?=$expo_nm[++$q]?></td>
           <td><input type="file" name="<?=$expo_key[$q]?>" >
           <?php if(isset($q_ed)){?><input type="hidden" name="old<?=$expo_key[$q]?>" value="<?=$q_ed->$expo_key[$q]?>">
           <?php if($q_ed->$expo_key[$q]!=''){?><a target="_blank" href="<?=$path.$q_ed->$expo_key[$q]?>">View File</a><?php }}?>
           </td>
         </tr>
        <tr> 
         <td><?=$expo_nm[++$q]?></td>
           <td><select name="<?=$expo_key[$q]?>" <?php if(isset($q_ed)){?>title="<?=$q_ed->$expo_key[$q]?>"<?php }?>>
            <?php $sql=mysql_query("select * from sy_menu where menu_cat_type='7'"); while($ro=mysql_fetch_object($sql)){?>
           <option value="<?=$ro->menu_id?>"><?=$ro->menu_nm?></option>
		   <?php }?>
           </select></td>
         </tr>
        <tr><td colspan="2" bgcolor="#eeeeee"><input type="submit" name="submit" value="Submit"></td>
      </table></form>
     
<? }/*act ok*/ else {?>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td width="7%">S.No.</td>
    <td width="68%"><?=$expo_nm[1]?></td>
    <td width="25%">Action</td>
  </tr>
  <?php $qw= "select * from $tbl order by $expo_key[0] desc ".$per_limit;
   $qw2= mysql_query($qw); while($row_par = mysql_fetch_object($qw2)) { ?>
  <tr>
    <td><?=++$i?></td>
    <td><?=$row_par->{$expo_key[1]}?></td>
     <td><a name="Edit" title="Edit <?=$row_par->{$expo_key[1]}?>"  href="?act=edit&&id=<?=$row_par->{$expo_key[0]}?>">Edit</a>
       <a name="Edit" title="View <?=$row_par->{$expo_key[1]}?>"  href="?act=edit&&id=<?=$row_par->{$expo_key[0]}?>&&view">View</a>
      <a name="Delete" title="Delete <?=$row_par->{$expo_key[1]}?>"  href="?act=del&&id=<?=$row_par->{$expo_key[0]}?>&&del_img=<?=$row_par->news_file?>">Delete</a></td>
  </tr><?php }?>
</table>




<?php } ?>
<?php require('themes/bot.php'); ?>