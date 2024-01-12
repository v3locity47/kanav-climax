<?php if(!isset($_GET['act'])){?>

<?php if(isset($_GET['page'])){$currpg=$_GET['page'];}else{$currpg=0;}?>

<?php if(isset($qw) and !isset($nav)){?>
<div id="page_nav"><?php $qw=substr($qw, 0, strpos($qw,'limit')); $query_bill= mysql_query($qw); $nav_mx=mysql_num_rows($query_bill);
if(!isset($nav)){
$i=0; $nav_val=$nav_mx;
if(isset($page)){if($page>4){$nav_mx2=$per_pg*7; $page-=4;$nav_val=$nav_mx2;?>
<a href="<?=$_SERVER['PHP_SELF'].'?page='.$_GET['page']-=1?>">« Previous</a>
<a href="<?=$_SERVER['PHP_SELF'].'?page=1'?>">1</a>
<a class="sl">...</a>
<? }else{$page=-1;}}else{$page=0;}

for($page;$nav_val>=0;$nav_val-=$per_pg){
	 ++$i; ++$page; 
	 if($i>7 or $nav_val>$nav_mx or $page>$nav_mx/$per_pg){break;}?>
<a href="<?=$_SERVER['PHP_SELF'].'?page='.$page?>"><?=($page+1)?></a>
<?php } if($q_limit<(int)($nav_mx/$per_pg) and $page<=(int)($nav_mx/$per_pg)){?>
<a class="sl">...</a>
<a href="<?=$_SERVER['PHP_SELF'].'?page='.(int)($nav_mx/$per_pg)?>"><?=(int)($nav_mx/$per_pg)?></a>
<a href="<?=$_SERVER['PHP_SELF'].'?page='.$currpg+=1?>">Next »</a><?php }?>
</div>
<?php }}?>

</div>
<div id="bot" class="w_fix"> <sym><a href="">Developed by Symphonyinfotech</a></sym></div>
<div id="wait">Please Wait...</div>
</body>
</html>
<?php } ?>