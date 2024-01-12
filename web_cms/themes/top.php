<?php if(!isset($db_con)){require('functions/connections.php');} if(!isset($_GET['act'])){?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=SITE_NAME?> > <?=$tit?></title>
<link href="<?=Root?>/themes/admin_av.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=Root?>/themes/js/jq1.8.2.js"></script>
<script type="text/javascript" src="<?=Root?>/themes/js/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?=Root?>/themes/js/validate.js"></script>
<script type="text/javascript" src="<?=Root?>/themes/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link href="<?=Root?>/themes/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css">

 
<script type="text/javascript" src="<?=Root?>/themes/js/user.js"></script>
<link href="<?=Root?>/themes/jq_css_cupertino/jquery-ui-1.10.2.custom.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="themes/editor/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="themes/editor/jquery.cleditor.table.min.js"></script>
<link href="themes/editor/jquery.cleditor.css" rel="stylesheet" type="text/css">

   
<body>
<div id="top" class="w_fix">
	<logo>ADMIN PANEL <small><i>( <?=SITE_NAME?> )</i></small></logo>
    <line></line>
    <nav>
    	<ul>
        <!-- master-->
        	<li><a href="">≡ Menu</a>
            	<ul>
                    <li><a href="<?=Root?>/menu.php">Pages</a></li>
                    <li><a href="<?=Root?>/gallery.php">Photo Gallery (Add Images)</a></li>
                    <li><a href="<?=Root?>/upload.php">Upload Document</a></li>
                     <li><a href="<?=Root?>/students.php">Add Students</a></li>
                     <?php /*<li><a href="<?=Root?>/user_doc.php">View Application Form</a></li>*/?>
                    <li><a href="<?=Root?>/news.php">News</a></li>
                   <?php /* <li><a href="<?=Root?>/testimonial.php">Testimonials</a></li>
                    <li><a href="<?=Root?>/faculty.php">Faculty</a></li>*/?>
                    <li><a href="?do">Signout</a></li>
                </ul>
		</ul>
     </nav>
     <line></line><pname><?=$tit?></pname>
	<!--<?php if(isset($add)){?><a class="addnew" href="<?=$_SERVER['PHP_SELF']?>?act=add">Add New Entry</a><? } ?>
    <?php if(isset($n_add)){?><a class="addnew" href="<?=$_SERVER['PHP_SELF']?>?act=search"><?=$n_add?></a><? } ?>-->
        <?php if(isset($add)){?><addnew><a href="<?=$_SERVER['PHP_SELF']?>?act=add">Add New Entry</a></addnew><? } ?>
    <?php if(isset($n_add)){?><addnew><a href="<?=$_SERVER['PHP_SELF']?>?act=search"><?=$n_add?></a></addnew><? } ?>


	<!--<a class="logout" href="?do">Signout</a>-->
    
       
    
</div>

<div class="w_fix" id="page">
<? $per_limit=''; if(!isset($nav)){$per_pg=50; if(!isset($page)){$q_limit=0;}else{$q_limit=$page; $i=($per_pg*$page);} $per_limit="limit ".($q_limit*$per_pg).' , '.$per_pg; }}?>
