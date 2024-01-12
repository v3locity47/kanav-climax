

<div class="row">
      
      
   <?php 
$stf_qry=mysql_query("select * from sy_gallery where gal_menu_id='$prd_d->menu_id' order by gal_id desc"); while($stf_ro=mysql_fetch_object($stf_qry)){?>
      <div class="col-xs-6 col-md-3">
        <a class="thumbnail fancybox" rel="prettyPhoto" href="themes/upload/gallery/<?=$stf_ro->gal_img?>">
          <div style="background:url(themes/upload/gallery/<?=$stf_ro->gal_img?>); background-size:cover; height:150px"></div>
           <?=$stf_ro->gal_des?>&nbsp;
        </a>
      </div>
<?php }?>   
</div>