<?php 
$dow_qry=mysql_query("select * from sy_dow where dow_cat_id='$prd_d->menu_id'"); while($dow_ro=mysql_fetch_object($dow_qry)){?>
	
    <div class="well well-sm"><?=$dow_ro->dow_nm?> 
     <a class="btn btn-default btn-xs" target="_blank" href="themes/upload/files/<?=$dow_ro->dow_file?>"> <samp class="glyphicon glyphicon-download-alt" aria-hidden="true"> </samp> Download</a>
    </div>
<?php }?>
  
 
      
      
 


 