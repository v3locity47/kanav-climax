<?php
$tbl='sy_res_cat';
$tit='Resource Center Category';
$add='1';
?>
<?php require('themes/top.php'); ?>

	
	<?php $query=mysql_query("show COLUMNS from $tbl"); while($record = mysql_fetch_array($query)){ $expo_key[] = $record['0'];}
  if(isset($_GET['act'])) { 
	
	echo sy_vw();
	//////////add 
if($act=='add'){if(isset($_POST['submit'])){ $rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= "'".$$val."'";}};mysql_query("insert into $tbl VALUES ('',".$rtq.")"); echo $mov;}}
				
	/////////edit	
if($act=='edit'){if(isset($_POST['submit'])){$rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= $val."='".$$val."'";}};mysql_query("update $tbl set ".$rtq." where $expo_key[0]='$id'");echo $mov;}
				else {$query_ed= mysql_query("select * from $tbl where $expo_key[0]='$id'"); $q_ed=mysql_fetch_object($query_ed);};
		}
				
      ///////delete
		if($act=='del'){mysql_query("delete from $tbl where $expo_key[0]='$id'"); echo $mov;}?>    
    <form action="?act=<?=$_GET['act']?>" method="post">
	<?php if(isset($q_ed)){?><input type="hidden" name="id" value="<?=$id?>"><?php }?>
    <table width="400" border="0" cellspacing="0" cellpadding="10" class="bo_tbl">
         <tr>
           <td><?=$tit?></td>
           <td><input type="text" name="res_cat_nm" class="required" <?php if(isset($q_ed)){?>value="<?=$q_ed->$expo_key[1]?>"<?php }?>></td>
         </tr>
        <tr><td colspan="2" bgcolor="#eeeeee"><input type="submit" name="submit" value="Submit"></td>
        </table></form>
        
<? }/*act ok*/ else {?>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td width="3%">S.No.</td>
     <td width="78%"><?=$tit?></td>
    <td width="13%">Action</td>
  </tr>
  <?php $qw= "select * from $tbl ".$per_limit; $qw2= mysql_query($qw); while($row_par = mysql_fetch_object($qw2)) { ?>
  <tr>
    <td><?=++$i?></td>
     <td><?=$row_par->$expo_key[1]?></td>
    <td><a name="Edit" title="Edit <?=$row_par->$expo_key[1]?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>">Edit</a>
    <a name="Delete" title="Delete <?=$row_par->$expo_key[1]?>"  href="?act=del&&id=<?=$row_par->$expo_key[0]?>">Delete</a></td>
  </tr><?php }?>
</table>




<?php } ?>
<?php require('themes/bot.php'); ?>