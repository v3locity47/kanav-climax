<?php $tbl='sy_product'; $img_tbl='sy_product_img'; $size_tbl='sy_product_qs';
$tit='Product';
$add='1';
$expo_key=array('pd_id','pd_cat_id','pd_brand','pd_nm','pd_order','pd_price_old','pd_price','pd_des');
$expo_nm=array('pd_id','Category','Brand','Product&nbsp;Name','Order',' Old Price','New Price','Description');
require('themes/uploader.class.php');
$path='../themes/upload/product/';$w=200;$h=200;
$siz_ary=array('28','30','32','34','36','38','40','42','44','46','48');
 ?>
<?php require('themes/top.php'); ?>
<?php if(isset($_GET['act'])) { 
 		echo sy_vw();
	//////////add 
if($act=='add' && isset($_POST['submit'])){ $rtq='';$rtq2='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';$rtq2.=' ,';};$rtq.= "'".$$val."'";$rtq2.= $val;}};mysql_query("insert into $tbl (".$rtq2.") VALUES (".$rtq.")");$last_id=mysql_insert_id();}
				
	/////////edit	
if($act=='edit'){if(isset($_POST['submit'])){$rtq='';foreach($expo_key as $key => $val){if($key!=0){if($key!=1){$rtq.=' ,';};$rtq.= $val."='".$$val."'";}};mysql_query("update $tbl set ".$rtq." where $expo_key[0]='$id'");$last_id=$id;}
				else {$query_ed= mysql_query("select * from $tbl where $expo_key[0]='$id'"); $q_ed=mysql_fetch_object($query_ed);};
		}
		
	///// query loop img
	if(isset($_POST['submit'])){ mysql_query("delete from $img_tbl where pd_img_id='$last_id'"); $tot=count($_POST['doc_nm']);
for($n=0;$n<$tot;$n++){if($_POST['doc_nm'][$n]!=''){mysql_query("insert into $img_tbl values('','$last_id','".$_POST['doc_nm'][$n]."')");
if($_POST['mk_thm'][$i]!=''){ $prv_id=mysql_insert_id(); mysql_query("update $tbl set pd_thumb='$prv_id' where pd_id='$last_id'");}
}};
mysql_query("delete from $size_tbl where qs_img_id='$last_id'");$siz_a_v='';$qs='$qs_';foreach($siz_ary as $val_va){$siz_a_v.=",'".${'qs_' . $val_va}."'";}
mysql_query("insert into $size_tbl values('','$last_id'$siz_a_v)");
echo $mov;}
      ///////delete
		if($act=='del'){mysql_query("delete from $tbl where $expo_key[0]='$id'"); mysql_query("delete from $img_tbl where pd_img_id='$id'");
						$del_img=mysql_query("select * from $img_tbl where pd_img_id='$id'"); while($del_q=mysql_fetch_object($del_img)){sy_del($del_q->pd_img,$path);}
		echo $mov;}?>
      <script type="text/javascript" src="themes/js/upload_files.js"></script>
   <form action="?act=<?=$_GET['act']?>" method="post" enctype="multipart/form-data" id="apc">
	<?php if(isset($q_ed)){?><input type="hidden" name="id" value="<?=$id?>"><?php }?>
    <table width="850" border="0" cellspacing="0" cellpadding="10" class="bo_tbl" >
   <tr>
           <td width="18"><?=$expo_nm[++$i]?></td>
           <td width="792"><select name="<?=$expo_key[$i]?>" class="required" <?php if(isset($q_ed)){?>title="<?=$q_ed->$expo_key[$i]?>"<?php }?>><?=menu_ls()?></select></td>
           <td width="792"><?=$expo_nm[++$i]?></td>
           <td width="792"><select name="<?=$expo_key[$i]?>" <?php if(isset($q_ed)){?>title="<?=$q_ed->$expo_key[$i]?>"<?php }?>><option value="0">None</option>
             <?php $qry=mysql_query("select * from sy_brand order by br_nm"); while($rgf=mysql_fetch_object($qry)){?>
             <option value="<?=$rgf->br_id?>"><?=$rgf->br_nm?></option><?php }?>
           </select></td>
         </tr>
   <tr>
           <td><?=$expo_nm[++$i]?></td>
           <td><input type="text" name="<?=$expo_key[$i]?>" class="required" <?php if(isset($q_ed)){?>value="<?=$q_ed->$expo_key[$i]?>"<?php }?>></td>
           <td><?=$expo_nm[++$i]?></td>
           <td><select name="<?=$expo_key[$i]?>" <?php if(isset($q_ed)){?>title="<?=$q_ed->$expo_key[$i]?>"<?php }?>>
             <?=order_ls()?>
           </select></td>
         </tr>
         
          <tr>
           <td><?=$expo_nm[++$i]?></td>
           <td><input type="text" name="<?=$expo_key[$i]?>" class="required number" <?php if(isset($q_ed)){?>value="<?=$q_ed->$expo_key[$i]?>"<?php }?>></td>
           <td><?=$expo_nm[++$i]?></td>
           <td><input type="text" name="<?=$expo_key[$i]?>" class="required number" <?php if(isset($q_ed)){?>value="<?=$q_ed->$expo_key[$i]?>"<?php }?>></td>
         </tr>
      
      <tr>
           <td><?=$expo_nm[++$i]?></td>
           <td><textarea name="<?=$expo_key[$i]?>" class="required"><?php if(isset($q_ed)){?><?=$q_ed->$expo_key[$i]?><?php }?></textarea></td>
           <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="2">
             <tr>
              <?php foreach($siz_ary as $val_ar){?><td align="center"><?=$val_ar?></td><?php }?>
             </tr>
             <tr>
               <?php if(isset($q_ed)){$sz_qry=mysql_query("select * from $size_tbl where qs_img_id='$id'"); $sz_obj=mysql_fetch_object($sz_qry);};
			   foreach($siz_ary as $val_ar){?><td align="center"><input <?php if(isset($q_ed)){?> value="<?=$sz_obj->{'qs_'.$val_ar}?>"<?php }?> type="text" name="qs_<?=$val_ar?>" style="width:25px"></td><?php }?>
             </tr>
             
       </table></td>
         </tr>
<tr>
            <td colspan="4">
            <div id="ajax_img">
            <input id="doc_nm[]" multiple type="file" class="uploadfiles" alt="<?=$path?>">
            <?php if(isset($q_ed)){$ed_img=mysql_query("select * from $img_tbl where pd_img_id='$id'"); while($ed_q=mysql_fetch_object($ed_img)){?>
            <span><?php if(!isset($_GET['view'])){?><b>Default Thumbnal<input type="checkbox" name="mk_thm[]" <?php if($ed_q->img_id==$q_ed->pd_thumb)echo'checked'?>></b><a class="del_pic">Delete</a><?php }?><img src="<?=$path.$ed_q->pd_img?>" title=""><input type="hidden" value="<?=$ed_q->pd_img?>" name="doc_nm[]"></span><?php }}?>
            </div>
            </td>
      </tr>


        <tr><td colspan="4" bgcolor="#eeeeee"><input type="submit" name="submit" value="Submit"></td>
  </table></form>
     
<? }/*act ok*/ else {?>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td width="2%">S.r.</td>
    <td width="16%"><?=$expo_nm[1]?></td>
        <td width="23%"><?=$expo_nm[2]?></td>
        <td width="31%"><?=$expo_nm[3]?></td>
<td width="8%"><?=$expo_nm[6]?></td>
    <td width="20%">Action</td>
  </tr>
  <?php $qw= "select * from $tbl order by $expo_key[0] desc ".$per_limit;
   $qw2= mysql_query($qw); while($row_par = mysql_fetch_object($qw2)) { ?>
  <tr>
    <td><?=++$i?></td>
    <td><?=menu_parent_ls($row_par->$expo_key[1])?></td>
    <td><?=$row_par->$expo_key[2]?></td>
    <td><?=$row_par->$expo_key[3]?></td>
    <td><?=$row_par->$expo_key[6]?></td>
    <td>
    <a name="Edit" title="Edit <?=$row_par->$expo_key[3]?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>">Edit</a>
    <a name="Edit" title="View <?=$row_par->$expo_key[3]?>"  href="?act=edit&&id=<?=$row_par->$expo_key[0]?>&&view">View</a>
    <a name="Delete" title="Delete <?=$row_par->$expo_key[3]?>"  href="?act=del&&id=<?=$row_par->$expo_key[0]?>">Delete</a></td>
  </tr><?php }?>
</table>




<?php } ?>
<?php require('themes/bot.php'); ?>