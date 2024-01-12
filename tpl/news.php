<?php 
$sql=mysql_query("select * from sy_news where news_menu='$cat_id' order by news_dt desc"); while($ro=mysql_fetch_object($sql)){?>

        
        
        	
    <div class="well well-sm"><i><?=sy_dt($ro->news_dt)?></i>
    <p><?=$ro->news_tx?></p>
    <?php if (file_exists('themes/upload/news/'.$ro->news_file) && $ro->news_file!=''){?><a class="btn btn-default btn-xs" target="_blank" href="themes/upload/news/<?=$ro->news_file?>"><samp class="glyphicon glyphicon-download-alt" aria-hidden="true"> </samp> Download File</a><?php }?>
    </div>
<?php }?>
  
 
      
      
 


 