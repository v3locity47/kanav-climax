<?php $hn=0; $tit=$_GET['cat_nm'];?>
<?php require('themes/header.php')?>

<?php 
$prd_q=mysql_query("select * from sy_menu where menu_id='$cat_id'"); $prd_d=mysql_fetch_object($prd_q);?>


 <div align="center"> <br>               
            <h1 style="color:rgba(0,0,0,0.8)"><?=$prd_d->menu_nm?></h1>
        </div>
 
<hr style="clear:both">
<?php 
$ffgv=mysql_query("select * from sy_menu where menu_id='$prd_d->menu_parent' and sub_menu_status=1  order by menu_order");

 if(mysql_num_rows($ffgv)>0){
$kkpl=mysql_fetch_object($ffgv);
 $gt_qru=mysql_query("select * from sy_menu where menu_parent='$prd_d->menu_parent'  order by menu_order");?>
 
 

<?php }?>


<?php

 if($prd_d->menu_img!='' && $prd_d->menu_cat_type!=3){?>
<img class="pic" src="themes/upload/pages/<?=$prd_d->menu_img?>" alt="<?=$tit?>">
<?php }?><?=$prd_d->menu_txt?>

<?php if($prd_d->menu_cat_type==1){ require('tpl/download.php');}?>


<?php if($prd_d->menu_cat_type==2){?><div id="small_pro"><?php 
$stf_qry=mysql_query("select * from sy_menu where menu_parent='$prd_d->menu_id'  order by menu_order"); while($stf_ro=mysql_fetch_object($stf_qry)){?>
	<?php if(strlen($stf_ro->menu_txt)>10){?><div><a href="<?=$_SERVER['PHP_SELF']?>?cat_nm=<?=$stf_ro->menu_nm?>&&p_cat=<?=$stf_ro->menu_parent?>&&cat_id=<?=$stf_ro->menu_id?>">[read more...]</a><h2><?=$stf_ro->menu_nm?></h2><?=$stf_ro->menu_txt?><?php } ?>    	    
    
    </div>
<?php }?>
</div>
<?php }?>


<?php if($prd_d->menu_cat_type==3){ require('tpl/gallery.php'); }?>

<?php $ffgv=mysql_query("select * from sy_menu where menu_parent='$prd_d->menu_id' and menu_cat_type=3 order by menu_order");
if(mysql_num_rows($ffgv)>0){?><div id="gallery_cover"><?php
	$gal_q=mysql_query("select * from sy_menu where menu_cat_type=3"); while($cvt=mysql_fetch_object($gal_q)){ $tim=$cvt->menu_img;if($cvt->menu_img==''){$tim='no_img.jpg';}?>
	<a href="<?=$_SERVER['PHP_SELF']?>?cat_nm=<?=$cvt->menu_nm?>&&p_cat=<?=$cvt->menu_parent?>&&cat_id=<?=$cvt->menu_id?>" style="background: url(themes/upload/pages/<?=$tim?>) no-repeat center center; background-size:cover"><span><?=$cvt->menu_nm?></span></a>
	<?php }?>
    </div>
	<?php }
?>


 
 

<?php if($prd_d->menu_cat_type==6){ ?>
<br style="clear:both"><form action="?m_sub=Feedback&&ur=<?=basename($_SERVER['PHP_SELF'])?>&&cat_nm=<?=$_GET['cat_nm']?>&&p_cat=<?=$_GET['p_cat']?>&&cat_id=<?=$_GET['cat_id']?>" method="post">
 <table width="100%" border="0" align="left" cellpadding="10" cellspacing="0" class="tbl">
  <tr>
    <td width="114">Student Name</td>
    <td width="454"><input type="text" name="Name" id="Name" class="required"></td>
  </tr>
    <tr>
    <td width="114">Location</td>
    <td width="454"><input type="text" name="Location" id="Location" class="required"></td>
  </tr>

  <tr>
    <td>Email</td>
    <td><input type="text" name="Email" id="Email" class="required email"></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input type="text" name="Phone" id="Phone" class="required"></td>
  </tr>
  <tr>
    <td>Present Class of Studying * </td>
    <td><textarea name="Studying" id="Studying"></textarea></td>
  </tr>
    <tr>
    <td>Details</td>
    <td><textarea name="Details" id="Details"></textarea></td>
  </tr>

  <tr>
    <td bgcolor="#e4dac6">&nbsp;</td>
    <td bgcolor="#e4dac6"><input type="submit" id="button" value="Submit"></td>
    </tr>
</table>
</form>
<?php }?>

<?php if($prd_d->menu_cat_type==5){?><div id="clients"><?php 
$stf_qry=mysql_query("select * from sy_clients where cl_menu_type='$prd_d->menu_id'"); while($stf_ro=mysql_fetch_object($stf_qry)){//print_r($stf_ro); ?>
	<div><img src="themes/upload/clients/<?=$stf_ro->cl_img?>" alt="Logo">
   <?php if($stf_ro->client_name!='' || $stf_ro->description!='' || $stf_ro->client_wesite!=''){?><span><b><?=$stf_ro->client_name?></b><p><?=$stf_ro->description?></p><?php if($stf_ro->client_wesite){?><a href="<?=$stf_ro->client_wesite?>" target="_blank">Website</a></span><?php }}?>
    </div>
<?php }?>
</div>

<?php }?>



<?php if($prd_d->menu_cat_type==7){require('tpl/news.php'); }?>



<?php if($prd_d->menu_cat_type==8){require('tpl/students.php');}?>



<?php if($prd_d->menu_cat_type==9){?><div id="faculty"><?php 
$stf_qry=mysql_query("select * from sy_faculty where msg_menu_id='$prd_d->menu_id' order by msg_id desc"); while($ro=mysql_fetch_object($stf_qry)){?>
<div class="faculty"><big><?=$ro->msg_head?></big>
<?php if($ro->msg_img!='' && file_exists('themes/upload/faculty/'.$ro->msg_img)):?>
<img  src="themes/upload/faculty/<?=$ro->msg_img?>" alt="<?=$ro->msg_tx?>">';<?php endif?>
<?=$ro->msg_tx?>
</div>
 <?php }?>
</div>
<?php }?>

<?php require("themes/footer.php");?>