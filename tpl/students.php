
<div class="row">
      
      
   <?php 
$stf_qry=mysql_query("select * from sy_students where msg_menu_id='$prd_d->menu_id' order by msg_id desc"); while($ro=mysql_fetch_object($stf_qry)){?>
      <div class="col-xs-6 col-md-3" align="center">
     	<div class="thumbnail"> <big><?=$ro->msg_head?></big>
           <img style="display: block; max-width:100%; max-height:200px" src="themes/upload/students/<?=$ro->msg_img?>" alt="<?=$ro->msg_tx?>" data-holder-rendered="true">
          <?=$ro->msg_tx?>
          </div>
       </div>
<?php }?>   
</div>